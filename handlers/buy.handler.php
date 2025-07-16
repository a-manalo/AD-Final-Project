<?php
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

$host     = $pgConfig['host'];
$port     = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname   = $pgConfig['db'];

// Connect to Postgres
$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$userId = $_SESSION['user']['id'];
$itemId = $_POST['item_id']; // from product form
$quantity = 1;

$stmt = $pdo->prepare("SELECT price FROM items WHERE id = :item_id");
$stmt->execute([':item_id' => $itemId]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    exit("Item not found.");
}

$totalAmount = $item['price']; // for simplicity: single item * 1

// Create transaction
$stmt = $pdo->prepare("INSERT INTO transactions (user_id, total_amount) VALUES (:user_id, :total_amount) RETURNING id");
$stmt->execute([
    ':user_id' => $userId,
    ':total_amount' => $totalAmount
]);
$transactionId = $stmt->fetchColumn();

// Create blank payment row for this transaction
$stmt = $pdo->prepare("INSERT INTO payments (transaction_id) VALUES (:transaction_id)");
$stmt->execute([':transaction_id' => $transactionId]);

// Create transaction item
$stmt = $pdo->prepare("INSERT INTO transaction_items (transaction_id, item_id, quantity, unit_price) VALUES (:tid, :iid, :qty, :price)");
$stmt->execute([
    ':tid'   => $transactionId,
    ':iid'   => $itemId,
    ':qty'   => $quantity,
    ':price' => $item['price']
]);

// Redirect to payment page
header("Location: /pages/Payment/index.php?transaction_id=$transactionId&amount=$totalAmount");
exit;