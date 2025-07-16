<?php
declare(strict_types=1);

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/process_payment.util.php';

$transactionId   = $_POST['transaction_id'] ?? null;
$paymentMethod   = $_POST['payment_method'] ?? null;
$amountPaid      = $_POST['amount_paid'] ?? null;
$meetingDate     = $_POST['meeting_date'] ?? null;
$meetingTime     = $_POST['meeting_time'] ?? null;
$contactInfo     = $_POST['contact_info'] ?? null;
$location        = $_POST['meeting_location'] ?? null;
$additionalNotes = $_POST['meeting_notes'] ?? null;

if (!$transactionId || !$paymentMethod || !$amountPaid) {
    http_response_code(400);
    exit('Missing required fields.');
}

savePayment([
    'transaction_id'   => $transactionId,
    'payment_method'   => $paymentMethod,
    'amount_paid'      => $amountPaid,
    'meeting_date'     => $meetingDate,
    'meeting_time'     => $meetingTime,
    'contact_info'     => $contactInfo,
    'location'         => $location,
    'agreed_amount'    => $paymentMethod === 'In Person' ? $amountPaid : null,
    'additional_notes' => $paymentMethod === 'In Person' ? $additionalNotes : null,
    'payment_status'   => 'Paid'
], $pgConfig);

header("Location: /pages/user-profile/index.php?payment=success");
exit;
