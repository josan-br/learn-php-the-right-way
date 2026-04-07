<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\Router\Attributes\Get;
use App\Foundation\Router\Attributes\Post;
use App\Foundation\View;

use App\Responses\RedirectResponse;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class UserController
{
    public function __construct(
        protected MailerInterface $mailer
    ) {}

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

        $html = <<<HTMLBody
        <h1 style="text-align: center; color: blue;">Welcome!</h1>
        Hello $firstName,
        <br />
        Thank you for signing up!
        HTMLBody;

        $email = (new Email())
            ->from('support@example.com')
            ->to($_POST['email'])
            ->subject('Welcome!')
            ->text($text)
            ->html($html)
            ->attach('Hello Word!', 'welcome.txt');

        $this->mailer->send($email);

        return new RedirectResponse('/users/create');
    }
}
