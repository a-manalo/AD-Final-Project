<?php
declare(strict_types=1);

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';

function createPDO(): PDO {
    global $pgConfig;
    $host     = $pgConfig['host'];
    $port     = $pgConfig['port'];
    $dbname   = $pgConfig['db'];
    $username = $pgConfig['user'];
    $password = $pgConfig['pass'];

    $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
    return new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}

function getBuyerOrders(string $userId): array {
    $pdo = createPDO();

    $stmt = $pdo->prepare("
        SELECT id, total_amount, status, created_at
        FROM transactions
        WHERE user_id = :user_id
        ORDER BY created_at DESC
    ");
    $stmt->execute(['user_id' => $userId]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

function getItemsBySeller(string $sellerUsername): array {
    $pdo = createPDO();

    $stmt = $pdo->prepare("
        SELECT id, name, description, price, stock, seller, category, image_url, created_at
        FROM items 
        WHERE seller = :seller
        ORDER BY created_at DESC
    ");
    $stmt->execute(['seller' => $sellerUsername]);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}
