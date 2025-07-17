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

function getSellerTransactions(string $sellerUsername): array {
    $pdo = createPDO();

    $stmt = $pdo->prepare("
        SELECT 
            t.id as transaction_id,
            t.total_amount,
            t.status as transaction_status,
            t.created_at as transaction_date,
            u.username as buyer_username,
            u.email as buyer_email,
            i.name as item_name,
            ti.quantity,
            ti.unit_price,
            ti.subtotal,
            p.payment_method,
            p.payment_status,
            p.meeting_date,
            p.meeting_time,
            p.contact_info,
            p.location,
            p.agreed_amount,
            p.additional_notes
        FROM transactions t
        JOIN transaction_items ti ON t.id = ti.transaction_id
        JOIN items i ON ti.item_id = i.id
        JOIN users u ON t.user_id = u.id
        LEFT JOIN payments p ON t.id = p.transaction_id
        WHERE i.seller = :seller
        ORDER BY t.created_at DESC
    ");
    $stmt->execute(['seller' => $sellerUsername]);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}
