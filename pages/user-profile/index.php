<?php
// PHP Logic and Includes - START
include LAYOUTS_PATH . "/main.layout.php";
// The original dummy.staticData.php might contain other site-wide static data.
// If your product data is separate, keep this include.
include STATICDATAS_PATH . "/dummies/items.staticData.php"; 

// ⚠️ TEMPORARY test only — remove this after confirming login works properly
$_SESSION['user'] = [
    'username' => 'shadowfox',
    'joined' => '2025-01-01',
    'preferred_comm' => 'Dead Drop',
    'role' => 'seller' // change this to 'customer' or 'admin' to test others
];
$user = $_SESSION['user'];

// Define role once
$role = $_SESSION['user']['role'] ?? 'guest';

// --- LOAD YOUR DUMMY PRODUCT DATA FROM EXTERNAL FILE ---
// Ensure STATICDATAS_PATH is correctly defined and points to the directory
// where you saved products.data.php.
// If you put it in a different folder (e.g., 'data'), adjust the path accordingly:
// require_once __DIR__ . '/data/products.data.php'; 
$allProducts = include STATICDATAS_PATH . "/dummies/items.staticData.php";

// Filter products based on the seller's role if needed, or assume all products
// are potentially user products for a seller's listing page.
// For this profile page, we assume 'seller' views all available products.
$userProducts = [];
if ($role === 'seller') {
    // In a real application, you'd fetch products specifically owned by the logged-in seller.
    // For dummy data, we'll just use a subset or all of them for display.
    // Here, we're using all the products loaded from the external file.
    $userProducts = $allProducts; 
}
// --- END OF EXTERNAL DUMMY DATA LOADING ---


// PHP Logic and Includes - END
?>

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
                    <?php if (!empty($updateMessage)): // Assuming $updateMessage might be set elsewhere ?>
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

<script>
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const contentSections = document.querySelectorAll('.content-section');

    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            // Remove 'active' class from all sidebar items
            sidebarItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');

            const sectionToShow = 'section-' + item.dataset.section;

            // Hide all sections
            contentSections.forEach(section => {
                section.classList.add('hidden');
            });

            // Show the selected section
            const activeSection = document.getElementById(sectionToShow);
            if (activeSection) activeSection.classList.remove('hidden');
        });
    });
</script>