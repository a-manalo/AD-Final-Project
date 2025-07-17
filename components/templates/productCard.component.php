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
  <?php
    require_once UTILS_PATH . '/auth.util.php';
    $user = Auth::user();
    if ($user) {
      if ($user['role'] === 'buyer') {
  ?>
    <form action="/handlers/buy.handler.php" method="POST" style="display: inline;">
      <input type="hidden" name="item_id" value="<?= htmlspecialchars($product['id']) ?>">
      <input type="hidden" name="quantity" value="1">
      <button type="submit" class="blackmarket-btn">Buy</button>
    </form>
  <?php
      } elseif ($user['role'] === 'seller') {
  ?>
    <form action="/handlers/sell.handler.php" method="POST" style="display: inline;">
      <input type="hidden" name="item_id" value="<?= htmlspecialchars($product['id']) ?>">
      <input type="hidden" name="quantity" value="1">
      <button type="submit" class="blackmarket-btn">Sell</button>
    </form>
  <?php
      }
    }
  ?>
</div>
<?php endif; ?>
