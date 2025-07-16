<?php
declare(strict_types=1);

require_once UTILS_PATH . '/envSetter.util.php';

class UserSessionRefresher
{
    public static function refresh(): void
    {
        if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
            return;
        }

        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            return;
        }

        // Setup DB connection manually
        global $pgConfig;
        $host     = $pgConfig['host'];
        $port     = $pgConfig['port'];
        $dbname   = $pgConfig['db'];
        $username = $pgConfig['user'];
        $password = $pgConfig['pass'];

        $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        // Fetch fresh user data
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['user'] = $user;
        }
    }
}
