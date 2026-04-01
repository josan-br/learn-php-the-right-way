<?php

declare(strict_types=1);

namespace App\Foundation\Router\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Route
{
    public const GET = 'get';
    public const POST = 'post';

    public function __construct(
        public readonly string $path,
        public readonly string $method,
    ) {}
}
