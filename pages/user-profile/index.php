<?php include LAYOUTS_PATH . "/main.layout.php"?>

<link rel="stylesheet" href="/pages/user-profile/assets/css/user-profile.css">

<div class="black-market-profile-page">
    <div class="profile-container">
        <div class="sidebar">
            <div class="sidebar-item active" data-section="profile">Profile</div>

            <?php if ($role === 'customer'): ?>
                <div class="sidebar-item" data-section="orders">Orders</div>
            <?php endif; ?>

            <?php if ($role === 'seller'): ?>
                <div class="sidebar-item" data-section="transactions">Transactions</div>
                <div class="sidebar-item" data-section="listings">Listings</div>
            <?php endif; ?>
        </div>

        <div class="content">
            <div class="content-header">
                <h2>Profile</h2>
            </div>

            <div class="content-section" id="section-profile">
                <div class="profile-details">
                    <?php if (!empty($updateMessage)):?>
                        <p style="color: var(--saffron); font-weight: bold;"><?= $updateMessage ?></p>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="avatar">
                            <img src="/assets/img/Website_Logo.png" alt="User Avatar">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="username">Alias</label>
                                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="joined">Joined the Network</label>
                                <input type="text" id="joined" name="joined" value="<?= htmlspecialchars($user['joined']) ?>" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group full-width">
                                <label for="preferred-comm">Preferred Comms</label>
                                <select id="preferred-comm" name="preferred_comm">
                                    <option value="Dead Drop" <?= ($user['preferred_comm'] ?? '') === "Dead Drop" ? 'selected' : '' ?>>Dead Drop</option>
                                    <option value="One-Time Pad" <?= ($user['preferred_comm'] ?? '') === "One-Time Pad" ? 'selected' : '' ?>>One-Time Pad</option>
                                </select>
                            </div>
                        </div>
                        <div class="save-button-container">
                            <a href="/self-destruct.php" class="save-button">Self-Destruct Profile</a>
                            <a href="/self-destruct.php" class="save-button">Logout</a>
                        </div>
                    </form>
                </div>
            </div>

            <?php if ($role === 'customer'): ?>
                <div class="content-section hidden" id="section-orders">
                    <h2>Your Orders</h2>
                    <p>[Orders content here]</p>
                </div>
            <?php endif; ?>

            <?php if ($role === 'seller'): ?>
                <div class="content-section hidden" id="section-transactions">
                    <h2>Your Transactions</h2>
                    <p>[Transactions content here]</p>
                </div>

                <div class="content-section hidden" id="section-listings">
                    <h2>Your Listings</h2>
                    <div class="seller-listings">
                        <div class="listings-header">
                            <button class="add-product-btn">+ Add New Product</button>
                        </div>

                        <?php if (!empty($userProducts)): ?>
                            <div class="listings-grid">
                                <?php foreach ($userProducts as $product): ?>
                                    <div class="listing-card">
                                        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="listing-image">
                                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                                        <p class="price">₱<?= number_format($product['price'], 2) ?></p>
                                        <p class="category">Category: <?= ucfirst($product['category']) ?></p>
                                        <p class="description"><?= htmlspecialchars($product['description']) ?></p>
                                        <div class="actions">
                                            <button class="edit-btn">Edit</button>
                                            <button class="delete-btn">Remove</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>You haven’t listed any products yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="/pages/user-profile/assets/js/user-profile.js"></script>
