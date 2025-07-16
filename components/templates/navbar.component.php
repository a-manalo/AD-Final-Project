<?php
declare(strict_types=1);
require_once UTILS_PATH . "/htmlEscape.util.php";

function navHeader(?array $user): void
{
    ?>
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

        <!-- Hamburger menu button -->
        <button class="hamburger" id="hamburger-btn">
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
        </button>

        <div class="navbar-menu" id="navbar-menu">
          <ul class="navbar-links">
            <li><a href="/">Home</a></li>
            <li><a href="/pages/product/index.php">Products</a></li>
            <?php if ($user): ?>
              <li><a href="/pages/user-profile/index.php">Account</a></li>
              <li><a href="/handlers/auth.handler.php?action=logout" class="login-btn">Logout</a></li>
            <?php else: ?>
              <li><a href="/pages/Login/index.php" class="login-btn">Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
    <script src="/assets/js/navbar.js"></script>
<?php
}