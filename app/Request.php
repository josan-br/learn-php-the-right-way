<?php

namespace App;

class Request
{
    public function __construct(private array $server) {}

    public function getUri(): string
    {
        return $this->server['REQUEST_URI'];
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }
}
