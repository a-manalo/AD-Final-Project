<?php
// Set up requirements
declare(strict_types=1);

require 'bootstrap.php';
require BASE_PATH . '/vendor/autoload.php';
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

// gets CLI argument if available (ex. `composer postgresql:seed -- users`)
$table = $argv[1] ?? 'all';

switch ($table) {
    case 'users':
        echo "Seeding users...\n";
        $data = require DUMMIES_PATH . '/users.staticData.php';

        foreach ($data as $u) {
            $columns = ['id', 'username', 'password'];
            $placeholders = [':id', ':username', ':password'];
            $params = [
                ':id'       => $u['id'],
                ':username' => $u['username'],
                ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
            ];

            if (isset($u['email'])) {
                $columns[] = 'email';
                $placeholders[] = ':email';
                $params[':email'] = $u['email'];
            }

            if (isset($u['role'])) {
                $columns[] = 'role';
                $placeholders[] = ':role';
                $params[':role'] = $u['role'];
            }

            if (isset($u['seller_request_status'])) {
                $columns[] = 'seller_request_status';
                $placeholders[] = ':seller_request_status';
                $params[':seller_request_status'] = $u['seller_request_status'];
            }

            $query = sprintf(
                "INSERT INTO users (%s) VALUES (%s)",
                implode(', ', $columns),
                implode(', ', $placeholders)
            );

            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }

        echo "Users seeded.\n";
        break;

    case 'items':
        echo "Seeding items...\n";
        $data = require DUMMIES_PATH . '/items.staticData.php';
        $stmt = $pdo->prepare("
            INSERT INTO items (id, name, description, price, stock, category, image_url, seller)
            VALUES (:id, :name, :description, :price, :stock, :category, :image_url, :seller)
        ");
        foreach ($data as $i) {
            $stmt->execute([
                ':id'          => $i['id'],
                ':name'        => $i['name'],
                ':description' => $i['description'],
                ':price'       => $i['price'],
                ':stock'       => $i['stock'],
                ':seller'      => $i['seller'],
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
            INSERT INTO payments (
                transaction_id, payment_method, amount_paid, payment_status,
                meeting_date, meeting_time, contact_info, location,
                agreed_amount, additional_notes
            ) VALUES (
                :transaction_id, :payment_method, :amount_paid, :payment_status,
                :meeting_date, :meeting_time, :contact_info, :location,
                :agreed_amount, :additional_notes
            )
        ");

        foreach ($data as $p) {
            $stmt->execute([
                ':transaction_id'   => $p['transaction_id'],
                ':payment_method'   => $p['payment_method'],
                ':amount_paid'      => $p['amount_paid'],
                ':payment_status'   => $p['payment_status'],

                // These may be null
                ':meeting_date'     => $p['meeting_date'] ?? null,
                ':meeting_time'     => $p['meeting_time'] ?? null,
                ':contact_info'     => $p['contact_info'] ?? null,
                ':location'         => $p['location'] ?? null,
                ':agreed_amount'    => $p['agreed_amount'] ?? null,
                ':additional_notes' => $p['additional_notes'] ?? null,
            ]);
        }

        echo "Payments seeded.\n";
        break;

    case 'transaction_items':
        echo "Seeding transaction_items...\n";
        $data = require DUMMIES_PATH . '/transaction_items.staticData.php';
        $stmt = $pdo->prepare("
            INSERT INTO transaction_items (id, transaction_id, item_id, quantity, unit_price)
            VALUES (:id, :transaction_id, :item_id, :quantity, :unit_price)
        ");
        foreach ($data as $ti) {
            $stmt->execute([
                ':id'             => $ti['id'],
                ':transaction_id' => $ti['transaction_id'],
                ':item_id'        => $ti['item_id'],
                ':quantity'       => $ti['quantity'],
                ':unit_price'     => $ti['unit_price'],
            ]);
        }
        echo "Transaction items seeded.\n";
        break;

    case 'all':
    // Seed users
    echo "Seeding users...\n";
    $data = require DUMMIES_PATH . '/users.staticData.php';

    foreach ($data as $u) {
        $columns = ['id', 'username', 'password'];
        $placeholders = [':id', ':username', ':password'];
        $params = [
            ':id'       => $u['id'],
            ':username' => $u['username'],
            ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
        ];

        if (isset($u['email'])) {
            $columns[] = 'email';
            $placeholders[] = ':email';
            $params[':email'] = $u['email'];
        }

        if (isset($u['role'])) {
            $columns[] = 'role';
            $placeholders[] = ':role';
            $params[':role'] = $u['role'];
        }

        if (isset($u['seller_request_status'])) {
            $columns[] = 'seller_request_status';
            $placeholders[] = ':seller_request_status';
            $params[':seller_request_status'] = $u['seller_request_status'];
        }

        $query = sprintf(
            "INSERT INTO users (%s) VALUES (%s)",
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
    }

    echo "Users seeded.\n";

    // Seed items
    echo "Seeding items...\n";
    $data = require DUMMIES_PATH . '/items.staticData.php';
    $stmt = $pdo->prepare("
        INSERT INTO items (id, name, description, price, stock, category, image_url, seller)
        VALUES (:id, :name, :description, :price, :stock, :category, :image_url, :seller)
    ");
    foreach ($data as $i) {
        $stmt->execute([
            ':id'          => $i['id'],
            ':name'        => $i['name'],
            ':description' => $i['description'],
            ':price'       => $i['price'],
            ':stock'       => $i['stock'],
            ':seller'      => $i['seller'],
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
        INSERT INTO payments (
            transaction_id, payment_method, amount_paid, payment_status,
            meeting_date, meeting_time, contact_info, location,
            agreed_amount, additional_notes
        ) VALUES (
            :transaction_id, :payment_method, :amount_paid, :payment_status,
            :meeting_date, :meeting_time, :contact_info, :location,
            :agreed_amount, :additional_notes
        )
    ");

    foreach ($data as $p) {
        $stmt->execute([
            ':transaction_id'   => $p['transaction_id'],
            ':payment_method'   => $p['payment_method'],
            ':amount_paid'      => $p['amount_paid'],
            ':payment_status'   => $p['payment_status'],

            // These may be null
            ':meeting_date'     => $p['meeting_date'] ?? null,
            ':meeting_time'     => $p['meeting_time'] ?? null,
            ':contact_info'     => $p['contact_info'] ?? null,
            ':location'         => $p['location'] ?? null,
            ':agreed_amount'    => $p['agreed_amount'] ?? null,
            ':additional_notes' => $p['additional_notes'] ?? null,
        ]);
    }

    echo "Payments seeded.\n";

    // Seed transaction_items
    echo "Seeding transaction_items...\n";
    $data = require DUMMIES_PATH . '/transaction_items.staticData.php';
    $stmt = $pdo->prepare("
        INSERT INTO transaction_items (id, transaction_id, item_id, quantity, unit_price)
        VALUES (:id, :transaction_id, :item_id, :quantity, :unit_price)
    ");
    foreach ($data as $ti) {
        $stmt->execute([
            ':id'             => $ti['id'],
            ':transaction_id' => $ti['transaction_id'],
            ':item_id'        => $ti['item_id'],
            ':quantity'       => $ti['quantity'],
            ':unit_price'     => $ti['unit_price'],
        ]);
    }
    echo "Transaction items seeded.\n";
    break;

    default:
        echo "No seeder found for '{$table}'. Skipping.\n";
}
