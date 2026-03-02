<?php
/**
 * @var array<int, mixed> $transactions
 * @var array{income: float, expense: float, net: float} $totals
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Transactions</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                <tr>
                    <td>
                        <?= date_create($transaction[0])->format("M, j, Y") ?>
                    </td>
                    <td>
                        <?= $transaction[1] ?>
                    </td>
                    <td>
                        <?= $transaction[2] ?>
                    </td>
                    <td style="color: <?= $transaction[3] > 0
                        ? "green"
                        : "red" ?>">
                        <?= format_currency($transaction[3]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= format_currency($totals["income"]) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= format_currency($totals["expense"]) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= format_currency($totals["net"]) ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>
