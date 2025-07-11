<?php
// Set up requirements
declare(strict_types=1);

require 'vendor/autoload.php';
require 'bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';

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
            INSERT INTO users (id, username, password, email, role)
            VALUES (:id, :username, :password, :email, :role)
        ");
        foreach ($data as $u) {
            $stmt->execute([
                ':id'       => $u['id'],
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
            INSERT INTO items (id, name, description, price, stock, category, image_url)
            VALUES (:id, :name, :description, :price, :stock, :category, :image_url)
        ");
        foreach ($data as $i) {
            $stmt->execute([
                ':id'          => $i['id'],
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
                ':id'           => $t['id'],
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
    // Seed users
    echo "Seeding users...\n";
    $data = require DUMMIES_PATH . '/users.staticData.php';
    $stmt = $pdo->prepare("
        INSERT INTO users (id, username, password, email, role)
        VALUES (:id, :username, :password, :email, :role)
    ");
    foreach ($data as $u) {
        $stmt->execute([
            ':id'       => $u['id'],
            ':username' => $u['username'],
            ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
            ':email'    => $u['email'],
            ':role'     => $u['role'],
        ]);
    }
    echo "Users seeded.\n";

    // Seed items
    echo "Seeding items...\n";
    $data = require DUMMIES_PATH . '/items.staticData.php';
    $stmt = $pdo->prepare("
        INSERT INTO items (id, name, description, price, stock, category, image_url)
        VALUES (:id, :name, :description, :price, :stock, :category, :image_url)
    ");
    foreach ($data as $i) {
        $stmt->execute([
            ':id'          => $i['id'],
            ':name'        => $i['name'],
            ':description' => $i['description'],
            ':price'       => $i['price'],
            ':stock'       => $i['stock'],
            ':category'    => $i['category'],
            ':image_url'   => $i['image_url'],
        ]);
    }
    echo "Items seeded.\n";

    // Seed transactions
    echo "Seeding transactions...\n";
    $data = require DUMMIES_PATH . '/transactions.staticData.php';
    $stmt = $pdo->prepare("
        INSERT INTO transactions (id, user_id, total_amount, status)
        VALUES (:id, :user_id, :total_amount, :status)
    ");
    foreach ($data as $t) {
        $stmt->execute([
            ':id'           => $t['id'],
            ':user_id'      => $t['user_id'],
            ':total_amount' => $t['total_amount'],
            ':status'       => $t['status'],
        ]);
    }
    echo "Transactions seeded.\n";

    // Seed payments
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

    default:
        echo "No seeder found for '{$table}'. Skipping.\n";
}
