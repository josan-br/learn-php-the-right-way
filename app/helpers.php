<?php

declare(strict_types=1);

function formatDate(string $date)
{
    return date('M, j, Y', strtotime($date));
}

function formatDollarAmount(float $amount): string
{
    return ($amount < 0 ? "-" : "") . '$' . number_format(abs($amount), 2);
}
