<?php if (isset($product)): ?>
<div class="product-card" data-category="<?= strtolower(htmlspecialchars($product['category'] ?? 'uncategorized')) ?>">
  <div class="product-info">
    <?php if (!empty($product['image_url'])): ?>
      <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    <?php endif; ?>

    <h3><?= htmlspecialchars($product['name'] ?? 'Unnamed Product') ?></h3>
    <p class="product-price">₱<?= number_format($product['price'] ?? 0, 2) ?></p>

    <?php if (!empty($product['description'])): ?>
      <p class="product-meta"><?= htmlspecialchars($product['description']) ?></p>
    <?php endif; ?>

    <?php if (!empty($product['seller'])): ?>
      <p class="product-seller">Seller: <?= htmlspecialchars($product['seller']) ?></p>
    <?php endif; ?>
  </div>

  <button class="blackmarket-btn">Buy</button>
</div>
<?php endif; ?>
