<?php

declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define("APP_PATH", $root . "app" . DIRECTORY_SEPARATOR);
define("FILES_PATH", $root . "transaction_files" . DIRECTORY_SEPARATOR);
define("VIEWS_PATH", $root . "views" . DIRECTORY_SEPARATOR);

$transactionsFile = FILES_PATH . "/sample_1.csv";

$transactions = [];
$totals = ["income" => 0, "expense" => 0, "net" => 0];

function format_currency(float $amount): string
{
    $formatted = number_format($amount, 2, ".", ",");
    return str_starts_with($formatted, "-")
        ? str_replace("-", "-$", $formatted)
        : "\${$formatted}";
}

if (file_exists($transactionsFile)) {
    $resource = fopen($transactionsFile, "r");

    $get_csv_line = fn() => fgetcsv(
        stream: $resource,
        separator: ",",
        enclosure: '"',
        escape: "",
    );

    $get_csv_line(); // Skip header

    while (!!($row = $get_csv_line())) {
        $row[3] = (float) str_replace(["$", ","], "", $row[3]);

        if ($row[3] > 0) {
            $totals["income"] += $row[3];
        } else {
            $totals["expense"] += $row[3];
        }

        $transactions[] = $row;
    }

    $totals["net"] = $totals["income"] + $totals["expense"];
}

include VIEWS_PATH . "/transactions.php";
