<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

$user = Auth::user();

if (!$user || $user['role'] !== 'buyer') {
    http_response_code(403);
    exit('Unauthorized');
}

// Setup DB
$host     = $pgConfig['host'];
$port     = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname   = $pgConfig['db'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$stmt = $pdo->prepare("UPDATE users SET seller_request_status = 'pending' WHERE id = :id");
$stmt->execute([':id' => $user['id']]);

header('Location: /pages/user-profile/index.php?requested=1');
exit;