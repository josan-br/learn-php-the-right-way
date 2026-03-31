<?php

declare(strict_types=1);

namespace App\Foundation;

use App\Exceptions\RouteNotFoundException;

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
