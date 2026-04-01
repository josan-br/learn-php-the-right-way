<?php

namespace App\Foundation\Router;

enum HttpMethod: string
{
    case Get = 'get';
    case Post = 'post';
    case Put = 'put';
    case Delete = 'delete';
}
