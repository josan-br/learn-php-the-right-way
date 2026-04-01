<?php

declare(strict_types=1);

namespace App\Foundation\Router;

use App\Exceptions\RouteNotFoundException;

use App\Foundation\Container;
use App\Foundation\Router\Attributes\Route as RouteAttribute;

final class Router
{
    private array $routes = [];

    public function __construct(
        protected Container $container
    ) {}

    public function get(string $route, callable|array $action): self
    {
        return $this->register('GET', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('POST', $route, $action);
    }

    public function resolve(string $requestUri, string $requestMethod): mixed
    {
        $route = explode('?', $requestUri)[0];
        $requestMethod = strtoupper($requestMethod);

        $action = $this->routes[$requestMethod][$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$controller, $method] = $action;

            if (! class_exists($controller)) {
                throw new RouteNotFoundException();
            }

            $instance = $this->container->get($controller);

            if (! method_exists($instance, $method)) {
                throw new RouteNotFoundException();
            }

            return call_user_func_array([$instance, $method], []);
        }

        throw new RouteNotFoundException();
    }

    public function registerRoutesFromControllerAttributes(array $controllers)
    {
        foreach ($controllers as $controller) {
            $methods = (new \ReflectionClass($controller))->getMethods(\ReflectionMethod::IS_PUBLIC);

            foreach ($methods as $method) {
                $routeAttributes = $method->getAttributes(RouteAttribute::class, \ReflectionAttribute::IS_INSTANCEOF);

                foreach ($routeAttributes as $routeAttribute) {
                    /** @var RouteAttribute */
                    $route = $routeAttribute->newInstance();

                    $this->register($route->method->value, $route->path, [$controller, $method->getName()]);
                }
            }
        }
    }

    public function toArray(): array
    {
        return $this->routes;
    }

    protected function register(string $method, string $name, callable|array $action): self
    {
        $method = strtoupper($method);

        $this->routes[$method][$name] = $action;

        return $this;
    }
}
