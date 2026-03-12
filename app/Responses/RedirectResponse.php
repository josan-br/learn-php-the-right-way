<?php

declare(strict_types=1);

namespace App\Responses;

class RedirectResponse
{
    public function __construct(
        protected string $to,
        protected bool $replace = true,
        protected int $statusCode = 301
    ) {
        header("Location: {$this->to}", $this->replace, $this->statusCode);
    }

    public function __destruct()
    {
        exit;
    }
}
