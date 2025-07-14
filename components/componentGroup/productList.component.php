<?php require_once STATICDATAS_PATH . "/product.staticData.php"?>

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <?php include TEMPLATES_PATH . "/productCard.component.php";?>
    <?php endforeach; ?>
</div>
