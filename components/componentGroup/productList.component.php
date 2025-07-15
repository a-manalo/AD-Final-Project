<?php require_once STATICDATAS_PATH . "/product.staticData.php"; ?>

<?php
$groupedProducts = [];

foreach ($products as $product) {
    $category = $product['category'] ?? 'uncategorized';
    $groupedProducts[$category][] = $product;
}
?>

<?php foreach ($groupedProducts as $category => $categoryProducts): ?>
    <section class="product-section" data-category="<?= htmlspecialchars($category) ?>">
        <h2 class="category-heading"><?= ucfirst($category) ?></h2>
        <div class="product-grid">
            <?php foreach ($categoryProducts as $product): ?>
                <?php include TEMPLATES_PATH . "/productCard.component.php"; ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>
