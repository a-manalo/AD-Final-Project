<?php require_once __DIR__ . '/../../staticDatas/product.staticData.php'?>

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <?php include __DIR__ . '/../../components/templates/productCard.component.php'; ?>
    <?php endforeach; ?>
</div>
