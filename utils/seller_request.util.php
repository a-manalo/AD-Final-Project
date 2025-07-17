<?php
declare(strict_types=1);

include_once UTILS_PATH . "/envSetter.util.php";

// Connect to DB
global $pgConfig;
$host     = $pgConfig['host'];
$port     = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname   = $pgConfig['db'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$stmt = $pdo->query("
    SELECT id, username, seller_request_status
    FROM users
    WHERE role = 'buyer' AND seller_request_status = 'pending'
");

$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
