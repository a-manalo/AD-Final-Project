<?php

declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.util.php';

Auth::init();

// Check if user is logged in and is a seller
$user = Auth::user();
if (!$user || $user['role'] !== 'seller') {
    http_response_code(403);
    exit('Unauthorized. Only sellers can remove items from their listings.');
}

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

$itemId = $_POST['item_id'] ?? null;

if (!$itemId) {
    http_response_code(400);
    exit('Item ID is required.');
}

try {
    // Check if the item belongs to the current seller
    $stmt = $pdo->prepare("SELECT id FROM items WHERE id = :item_id AND seller = :seller");
    $stmt->execute([
        ':item_id' => $itemId,
        ':seller' => $user['username']
    ]);
    
    if (!$stmt->fetch()) {
        http_response_code(404);
        exit('Item not found or you do not have permission to remove it.');
    }
    
    // Remove the item from the seller's listings
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = :item_id AND seller = :seller");
    $stmt->execute([
        ':item_id' => $itemId,
        ':seller' => $user['username']
    ]);
    
    // Redirect back to user profile with success message
    header('Location: /pages/user-profile/index.php?message=Item%20removed%20from%20your%20listings%20successfully');
    exit;
} catch (PDOException $e) {
    error_log('[remove_item.handler] PDOException: ' . $e->getMessage());
    http_response_code(500);
    exit('Server error occurred while removing item from listings.');
} 