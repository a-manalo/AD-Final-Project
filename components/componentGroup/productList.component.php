<?php
require_once __DIR__ . '/../staticData/products.staticdata.php';
?>

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <?php include __DIR__ . '/templates/productCard.component.php'; ?>
    <?php endforeach; ?>
</div>
