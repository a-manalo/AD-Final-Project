<div class="site-disclaimer">
  ⚠️ <strong>Disclaimer:</strong> The market is but a vessel. The site holds no blame for dealings made in shadow.
</div>

<nav class="navbar">
  <div class="container">
    <a href="/" class="logo">
      <img src="/assets/img/website_logo.png" alt="">
    </a>
    <div class="brand-text">
      <a href="/" class="website-name">The Forbidden Codex</a>
      <p class="company-name">Cottonee Inc.</p>
    </div>

    <div class="navbar-menu">
      <ul class="navbar-links">
        <li><a href="/">Home</a></li>
        <li><a href="/pages/ProductPage/index.php">Products</a></li>
        <li><a href="/">Services</a></li>

        <?php if (isset($_SESSION['user'])): ?>
            <li><a href="/pages/" class = "login-btn">Account</a></li>
        <?php else: ?>
            <li><a href="/pages/Login/index.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
