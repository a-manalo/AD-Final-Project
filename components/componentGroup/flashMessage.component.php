<?php if (isset($_SESSION['success'])): ?>
    <div class="success">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php elseif (isset($_SESSION['error'])): ?>
    <div class="error">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>
