<?php
// Set up requirements
declare(strict_types=1);

require 'vendor/autoload.php';
require 'bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';

define('DUMMIES_PATH', 'staticData/dummies');

$host     = $pgConfig['host'];
$port     = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname   = $pgConfig['db'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$table = $argv[1] ?? 'all';

switch ($table) {
    case 'users':
        echo "Seeding users...\n";
        $data = require DUMMIES_PATH . '/users.staticData.php';
        $stmt = $pdo->prepare("
            INSERT INTO users (username, password, email, role)
            VALUES (:username, :password, :email, :role)
        ");
        foreach ($data as $u) {
            $stmt->execute([
                ':username' => $u['username'],
                ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
                ':email'    => $u['email'],
                ':role'     => $u['role'],
            ]);
        }
        echo "Users seeded.\n";
        break;

    case 'items':
        echo "Seeding items...\n";
        $data = require DUMMIES_PATH . '/items.staticData.php';
        $stmt = $pdo->prepare("
            INSERT INTO items (name, description, price, stock, category, image_url)
            VALUES (:name, :description, :price, :stock, :category, :image_url)
        ");
        foreach ($data as $i) {
            $stmt->execute([
                ':name'        => $i['name'],
                ':description' => $i['description'],
                ':price'       => $i['price'],
                ':stock'       => $i['stock'],
                ':category'    => $i['category'],
                ':image_url'   => $i['image_url'],
            ]);
        }
        echo "Items seeded.\n";
        break;

    case 'transactions':
        echo "Seeding transactions...\n";
        $data = require DUMMIES_PATH . '/transactions.staticData.php';
        $stmt = $pdo->prepare("
            INSERT INTO transactions (user_id, total_amount, status)
            VALUES (:user_id, :total_amount, :status)
        ");
        foreach ($data as $t) {
            $stmt->execute([
                ':user_id'      => $t['user_id'],
                ':total_amount' => $t['total_amount'],
                ':status'       => $t['status'],
            ]);
        }
        echo "Transactions seeded.\n";
        break;

    case 'payments':
        echo "Seeding payments...\n";
        $data = require DUMMIES_PATH . '/payments.staticData.php';
        $stmt = $pdo->prepare("
            INSERT INTO payments (transaction_id, payment_method, amount_paid, payment_status)
            VALUES (:transaction_id, :payment_method, :amount_paid, :payment_status)
        ");
        foreach ($data as $p) {
            $stmt->execute([
                ':transaction_id' => $p['transaction_id'],
                ':payment_method' => $p['payment_method'],
                ':amount_paid'    => $p['amount_paid'],
                ':payment_status' => $p['payment_status'],
            ]);
        }
        echo "Payments seeded.\n";
        break;

    case 'all':
        $argv[1] = 'users';       require __FILE__;
        $argv[1] = 'items';       require __FILE__;
        $argv[1] = 'transactions';require __FILE__;
        $argv[1] = 'payments';    require __FILE__;
        break;

    default:
        echo "No seeder found for '{$table}'. Skipping.\n";
} 
