<?php

declare(strict_types=1);

function getTransactionFiles(string $directory): array
{
    return array_reduce(
        scandir($directory),
        function ($files, $file) use ($directory) {
            if (!is_dir($file)) {
                $files[] = $directory . $file;
            }

            return $files;
        },
        [],
    );
}

/**
 * @param resource $csv
 *
 * @return array|false
 */
function getCsvLine(mixed $csv)
{
    return fgetcsv(stream: $csv, separator: ',', enclosure: '"', escape: '');
}

function getTransactions(string $filePath, callable $transactionsHandler): array
{
    if (!file_exists($filePath)) {
        trigger_error("File '{$filePath}' does not exists.", E_USER_ERROR);
    }

    $transactions = [];

    $file = fopen($filePath, 'r');

    getCsvLine($file); // Skip header

    while (!!($transaction = getCsvLine($file))) {
        $transactions[] = $transactionsHandler($transaction);
    }

    return $transactions;
}

function formatTransaction(array $transaction): array
{
    [$date, $checkNumber, $description, $amount] = $transaction;

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => (float) str_replace(['$', ','], '', $amount),
    ];
}

function calculateTotals(array $transactions)
{
    return array_reduce(
        $transactions,
        function ($totals, $transaction) {
            $totals['net'] += $transaction['amount'];

            if ($transaction['amount'] >= 0) {
                $totals['income'] += $transaction['amount'];
            } else {
                $totals['expense'] += $transaction['amount'];
            }

            return $totals;
        },
        ['income' => 0, 'expense' => 0, 'net' => 0],
    );
}
