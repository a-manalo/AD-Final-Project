<?php
// Set up requirements
declare(strict_types=1);

require '/vendor/autoload.php';
require '/bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';

// Adding the database host and connecting
$host     = $pgConfig['host'];
$port     = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname   = $pgConfig['db'];

// Connect to PostgreSQL
$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
$pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// Automatically generate the database tables
$dbFiles = [
    'users.model.sql',
    'transactions.model.sql',
    'payments.model.sql',
    'items.model.sql'
];

foreach ($dbFiles as $dbFile) {
    // Indicator if it was working
    echo "Applying schema from database/{$dbFile}…\n";
    $sql = file_get_contents("database/{$dbFile}");

    // Another indicator but for failed creation
    if ($sql === false) {
        throw new RuntimeException("Could not read database/{$dbFile}");
    }

    // If your model.sql contains a working command it will be executed
    $pdo->exec($sql);
    echo "Creation success from the {$dbFile}\n";
}

// Clean the tables
echo "Truncating tables…\n";
foreach (['users', 'transactions', 'payments', 'items'] as $table) {
    $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
}
echo "Tables successfully truncated.\n";

?>