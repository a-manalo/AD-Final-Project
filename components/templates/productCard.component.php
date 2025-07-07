<?php if (isset($product)): ?>
<div class="product-card">
    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    <h3><?= htmlspecialchars($product['name']) ?></h3>
    <p>₱<?= number_format($product['price'], 2) ?></p>
    <button>Add to Cart</button>
</div>
<?php endif; ?>
