<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

$user = Auth::user();
if (!$user || $user['role'] !== 'seller') {
    http_response_code(403);
    exit('Unauthorized. Only sellers can add items to their listings.');
}

$host     = $pgConfig['host'];
$port     = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname   = $pgConfig['db'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$itemId = $_POST['item_id'] ?? null;
$quantity = (int)($_POST['quantity'] ?? 1);

if (!$itemId) {
    http_response_code(400);
    exit('Item ID is required.');
}

try {
    $products = require DUMMIES_PATH . '/items.staticData.php';
    $originalItem = null;
    foreach ($products as $product) {
        if ($product['id'] === $itemId) {
            $originalItem = $product;
            break;
        }
    }
    if (!$originalItem) {
        http_response_code(404);
        exit('Item not found in catalog.');
    }
    // check if seller already has this item in their listings
    $stmt = $pdo->prepare("SELECT id FROM items WHERE seller = :seller AND name = :name");
    $stmt->execute([
        ':seller' => $user['username'],
        ':name' => $originalItem['name']
    ]);
    if ($stmt->fetch()) {
        // item already exists in seller's listings, update stock
        $stmt = $pdo->prepare("UPDATE items SET stock = stock + :quantity WHERE seller = :seller AND name = :name");
        $stmt->execute([
            ':quantity' => $quantity,
            ':seller' => $user['username'],
            ':name' => $originalItem['name']
        ]);
    } else {
        // add new item to seller's listings
        $stmt = $pdo->prepare("
            INSERT INTO items (name, description, price, stock, seller, category, image_url) 
            VALUES (:name, :description, :price, :stock, :seller, :category, :image_url)
        ");
        $stmt->execute([
            ':name' => $originalItem['name'],
            ':description' => $originalItem['description'],
            ':price' => $originalItem['price'],
            ':stock' => $quantity,
            ':seller' => $user['username'],
            ':category' => $originalItem['category'],
            ':image_url' => $originalItem['image_url']
        ]);
    }
    // redirect back to products page with success message
    header('Location: /pages/product/index.php?message=Item%20added%20to%20your%20listings%20successfully');
    exit;
} catch (PDOException $e) {
    error_log('[sell.handler] PDOException: ' . $e->getMessage());
    http_response_code(500);
    exit('Server error occurred while adding item to listings.');
}