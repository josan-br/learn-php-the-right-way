<?php

declare(strict_types=1);

define("BASE_PATH", dirname(__DIR__));

require BASE_PATH . "/vendor/autoload.php";

$app = (new \App\App)->bootCommand();

$app->make(\App\Services\EmailServiceInterface::class)->sendQueuedEmails();
