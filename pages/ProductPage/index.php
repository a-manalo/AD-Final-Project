<?php
require_once __DIR__ . '/../../layout/main.layout.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop</title>
    <link rel="stylesheet" href="assets/css/products.css">
</head>
<body>
    <main>
        <h1 style="text-align:center;">Our Products</h1>
        <?php include __DIR__ . '/../../components/productList.component.php'; ?>
    </main>
</body>
</html>
