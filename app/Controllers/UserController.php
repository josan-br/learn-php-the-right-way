<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\Router\Attributes\Get;
use App\Foundation\Router\Attributes\Post;
use App\Foundation\View;

use App\Responses\RedirectResponse;

use Symfony\Component\Mime\Address;

final class UserController
{
    #[Get('/users/create')]
    public function create(): View
    {
        return View::make('users/create', [
            'title' => 'Register user'
        ]);
    }

    #[Post('/users')]
    public function store(): RedirectResponse
    {
        [$firstName] = explode(' ', $_POST['name']);

        $text = <<<Body
        Hello $firstName

        Thank you for signing up!
        Body;

        $html = <<<HTML
        <body>
            <h1 style="text-align: center; color: blue;">Welcome!</h1>
            Hello $firstName,
            <br />
            Thank you for signing up!
        </body>
        HTML;

        (new \App\Models\Email)->queue(
            new Address($_POST['email']),
            new Address('support@example.com'),
            'Welcome!',
            $html,
            $text
        );

        return new RedirectResponse('/users/create');
    }
}
