<?php
    declare(strict_types=1);

    require_once BASE_PATH . '/vendor/autoload.php';
    require_once UTILS_PATH . '/auth.util.php';
    require_once UTILS_PATH . '/refresh_user.util.php';

    Auth::init();

    if (!Auth::user()) {
        header('Location: /pages/Login/index.php');
        exit;
    }

    UserSessionRefresher::refresh();
    $user = $_SESSION['user']; // Always use refreshed data

    $role = $user['role'];

    require_once LAYOUTS_PATH . '/main.layout.php';


renderMainLayout(function () use ($role, $user) {
    ?>

    <div class="black-market-profile-page">
        <div class="profile-container">
            <div class="sidebar">
                <div class="sidebar-item active" data-section="profile">Profile</div>

                <?php if ($role === 'buyer'): ?>
                    <div class="sidebar-item" data-section="orders">Orders</div>
                <?php endif; ?>

                <?php if ($role === 'seller'): ?>
                    <div class="sidebar-item" data-section="transactions">Transactions</div>
                    <div class="sidebar-item" data-section="listings">Listings</div>
                <?php endif; ?>

                <?php if ($role === 'admin'): ?>
                    <div class="sidebar-item" data-section="user-manager">User Manager</div>
                <?php endif; ?>
            </div>

            <div class="content">
                <div class="content-header">
                    <h2>Profile</h2>
                </div>

                <div class="content-section" id="section-profile">
                    <div class="profile-details">
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
                                    <input type="text" id="joined" name="joined" value="<?= htmlspecialchars(date('Y-m-d', strtotime($user['created_at']))) ?>" readonly>
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
                                <?php if ($role === 'buyer'): ?>
                                    <?php if (($user['seller_request_status'] ?? null) === 'pending'): ?>
                                        <button class="save-button" disabled>Pending Request</button>
                                    <?php elseif (($user['seller_request_status'] ?? null) === 'rejected'): ?>
                                        <button class="save-button" disabled>Request Rejected</button>
                                    <?php else: ?>
                                        <form action="/handlers/request_seller.handler.php" method="POST" onsubmit="return confirm('Are you sure you want to register as a seller?');" style="display:inline;">
                                            <button type="submit" class="save-button">Register as Seller</button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <form action="/handlers/delete_user.handler.php" method="POST" onsubmit="return confirm('Are you absolutely sure you want to delete your account? This cannot be undone.');" style="display: inline;">
                                <button type="submit" class="save-button">Self-Destruct Profile</button>
                                </form>
                                <a href="/handlers/auth.handler.php?action=logout" class="save-button">Logout</a>
                            </div>
                    </div>
                </div>

                <?php if ($role === 'buyer'): ?>
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
                <?php endif; ?>

                <?php if ($role === 'admin'): ?>
                    <div class="content-section hidden" id="section-user-manager">
                        <?php require_once UTILS_PATH . '/seller_request.util.php'; ?>

                        <?php if (count($requests) > 0): ?>
                            <table class="table table-user-manager">
                                <thead>
                                    <tr><th>Username</th><th>Seller Role Request</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($requests as $req): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($req['username']) ?></td>
                                            <td>
                                                <form action="/handlers/seller_request.handler.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="user_id" value="<?= $req['id'] ?>">
                                                    <input type="hidden" name="action" value="approve">
                                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                </form>
                                                <form action="/handlers/seller_request.handler.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="user_id" value="<?= $req['id'] ?>">
                                                    <input type="hidden" name="action" value="reject">
                                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No pending seller requests.</p>
                        <?php endif; ?>
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
    <?php
},
    "Account",
    [
        'css' => [
            '/pages/user-profile/assets/css/user-profile.css',
            '/assets/css/main.css',
            '/assets/css/navbar.css',
            // '/assets/css/footer.css',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
        ],
        'js' => [
            '/pages/user-profile/assets/js/user-profile.js',
        ]
    ],
    true
);