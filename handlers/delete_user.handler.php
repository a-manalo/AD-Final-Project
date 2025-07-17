<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/envSetter.util.php';
require_once UTILS_PATH . '/auth.util.php';
require_once UTILS_PATH . '/delete_user.util.php';

Auth::init();

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

// Ensure POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /pages/Account/index.php');
    exit;
}

// Ensure user is logged in
$user = Auth::user();
if (!$user) {
    http_response_code(403);
    exit('Unauthorized.');
}
$userId = $user['id'];

// Attempt deletion
try {
    $deleted = DeleteUser::deleteById($pdo, $userId);

    if ($deleted) {
        session_destroy();
        header('Location: /index.php');
        exit;
    } else {
        $_SESSION['account_errors'] = ['Failed to delete your account. Please try again.'];
        header('Location: /pages/Account/index.php');
        exit;
    }

} catch (PDOException $e) {
    error_log('[delete_user.handler] PDOException: ' . $e->getMessage());
    http_response_code(500);
    exit('Server error.');
}