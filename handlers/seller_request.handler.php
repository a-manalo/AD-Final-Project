<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

$admin = Auth::user();

if (!$admin || $admin['role'] !== 'admin') {
    http_response_code(403);
    exit('Unauthorized');
}

$userId = $_POST['user_id'] ?? null;
$action = $_POST['action'] ?? null;

if (!$userId || !in_array($action, ['approve', 'reject'])) {
    http_response_code(400);
    exit('Invalid request');
}

// Connect to DB
$host     = $pgConfig['host'];
$port     = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname   = $pgConfig['db'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

if ($action === 'approve') {
    $pdo->prepare("UPDATE users SET role = 'seller', seller_request_status = NULL WHERE id = :id")
        ->execute([':id' => $userId]);
} elseif ($action === 'reject') {
    $pdo->prepare("UPDATE users SET seller_request_status = 'rejected' WHERE id = :id")
        ->execute([':id' => $userId]);
}

header('Location: /pages/user-profile/index.php');
exit;