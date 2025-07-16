<?php
declare(strict_types=1);

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';

function savePayment(array $data, array $pgConfig): void
{
    $pdo = new PDO(
        "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}",
        $pgConfig['user'],
        $pgConfig['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $pdo->prepare("
        UPDATE payments SET
            payment_method = :payment_method,
            amount_paid = :amount_paid,
            payment_status = :payment_status,
            meeting_date = :meeting_date,
            meeting_time = :meeting_time,
            contact_info = :contact_info,
            location = :location,
            agreed_amount = :agreed_amount,
            additional_notes = :additional_notes
        WHERE transaction_id = :transaction_id
    ");

    $stmt->execute([
        ':transaction_id'   => $data['transaction_id'],
        ':payment_method'   => $data['payment_method'],
        ':amount_paid'      => $data['amount_paid'],
        ':payment_status'   => $data['payment_status'] ?? 'Unpaid',
        ':meeting_date'     => $data['meeting_date'],
        ':meeting_time'     => $data['meeting_time'],
        ':contact_info'     => $data['contact_info'],
        ':location'         => $data['location'],
        ':agreed_amount'    => $data['agreed_amount'],
        ':additional_notes' => $data['additional_notes'],
    ]);

    $pdo->prepare("UPDATE transactions SET status = 'Completed' WHERE id = :id")
        ->execute([':id' => $data['transaction_id']]);
}