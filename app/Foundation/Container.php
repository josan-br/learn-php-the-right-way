<?php

declare(strict_types=1);

namespace App\Foundation;

use App\Exceptions\ContainerException;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private $entries = [];

    public function get(string $id)
    {
        if (! $this->has($id)) {
            return $this->resolve($id);
        }

        $entry = $this->entries[$id];

        if (is_callable($entry)) {
            return $entry($this);
        }

        return $this->resolve($entry);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete): static
    {
        $this->entries[$id] = $concrete;

        return $this;
    }

    public function resolve(string $id)
    {
        $reflactionClass = new \ReflectionClass($id);

        if (! $reflactionClass->isInstantiable()) {
            throw new ContainerException("Class '{$id}' is not instantiable");
        }

        $constructor = $reflactionClass->getConstructor();
        $parameters = $constructor?->getParameters();

        if ($constructor === null || empty($parameters)) {
            return $reflactionClass->newInstance();
        }

        $dependencies = array_map(function (\ReflectionParameter $param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve class '{$id}' because param '{$name}' is missing a type hint");
            }

            if ($type instanceof \ReflectionUnionType) {
                throw new ContainerException("Failed to resolve class '{$id}' because of union type for param '{$name}'");
            }

            if ($type instanceof \ReflectionNamedType && ! $type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException("Failed to resolve class '{$id}' because invalid param '{$name}'");
        }, $parameters);

        return $reflactionClass->newInstanceArgs($dependencies);
    }
}
