<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$service = new App\DebitCollectionService();

echo $service->collectDebit(new App\CollectionAgency()) . PHP_EOL;
