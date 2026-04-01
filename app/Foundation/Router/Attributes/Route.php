<?php

declare(strict_types=1);

namespace App\Foundation\Router\Attributes;

use App\Foundation\Router\HttpMethod;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Route
{
    public function __construct(
        public readonly string $path,
        public readonly HttpMethod $method,
    ) {}
}
