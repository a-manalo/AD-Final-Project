<?php
declare(strict_types=1);

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.util.php';
require_once UTILS_PATH . '/refresh_user.util.php';
require_once UTILS_PATH . '/orders.util.php';

Auth::init();

if (!Auth::user()) {
    header('Location: /pages/Login/index.php');
    exit;
}

// Refresh session and extract user data
UserSessionRefresher::refresh();
$user = $_SESSION['user'];
$role = $user['role'];

// Prepare data depending on role
$userTransactions = [];
$userListings = [];
$sellerTransactions = [];

if ($role === 'buyer') {
    $userTransactions = getBuyerOrders($user['id']);
}

if ($role === 'seller') {
    $userListings = getItemsBySeller($user['username']);
    $sellerTransactions = getSellerTransactions($user['username']);
}

// Render the layout
require_once LAYOUTS_PATH . '/main.layout.php';

renderMainLayout(function () use ($role, $user, $userTransactions, $userListings, $sellerTransactions) {
    ?>

    <div class="black-market-profile-page">
        <div class="profile-container">
            <div class="sidebar">
                <div class="sidebar-item active" data-section="profile">Profile</div>

                <?php if ($role === 'buyer'): ?>
                    <div class="sidebar-item" data-section="orders">Orders (<?= count($userTransactions) ?>)</div>
                <?php endif; ?>

                <?php if ($role === 'seller'): ?>
                    <div class="sidebar-item" data-section="listings">Listings (<?= count($userListings) ?>)</div>
                    <div class="sidebar-item" data-section="transactions">Transactions (<?= count($sellerTransactions) ?>)</div>
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
                        <?php if (!empty($userTransactions)): ?>
                            <div class="orders-list">
                                <?php foreach ($userTransactions as $txn): ?>
                                    <div class="order-card">
                                        <p><strong>Order ID:</strong> <?= htmlspecialchars($txn['id']) ?></p>
                                        <p><strong>Total Amount:</strong> ₱<?= number_format((float)$txn['total_amount'], 2) ?></p>
                                        <p><strong>Status:</strong> <?= htmlspecialchars($txn['status']) ?></p>
                                        <p><strong>Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($txn['created_at']))) ?></p>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>You have no orders yet.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($role === 'seller'): ?>
                    <div class="content-section hidden" id="section-listings">
                        <h2>Your Listings</h2>

                        <?php if (!empty($userListings)): ?>
                            <div class="listings-grid">
                                <?php foreach ($userListings as $item): ?>
                                    <div class="listing-card">
                                        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="listing-img">
                                        <h4><?= htmlspecialchars($item['name']) ?></h4>
                                        <p><?= htmlspecialchars($item['description']) ?></p>
                                        <p><strong>₱<?= number_format((float)$item['price'], 2) ?></strong></p>
                                        <p>Stock: <?= (int)$item['stock'] ?></p>
                                        <p>Category: <?= htmlspecialchars($item['category']) ?></p>
                                        <p><small>Listed on <?= date('F j, Y', strtotime($item['created_at'])) ?></small></p>
                                        <form action="/handlers/remove_item.handler.php" method="POST" onsubmit="return confirm('Are you sure you want to remove this item from your listings?');" style="margin-top: 0.5rem;">
                                            <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['id']) ?>">
                                            <button type="submit" class="delete-btn">Delete</button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>You have no listings yet.</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($role === 'seller'): ?>
                    <div class="content-section hidden" id="section-transactions">
                        <h2>Your Transactions</h2>
                        <?php if (!empty($sellerTransactions)): ?>
                            <div class="transactions-list">
                                <?php foreach ($sellerTransactions as $txn): ?>
                                    <div class="transaction-card">
                                        <div class="transaction-header">
                                            <h4>Order #<?= htmlspecialchars(substr($txn['transaction_id'], 0, 8)) ?></h4>
                                            <span class="status-badge status-<?= strtolower($txn['transaction_status']) ?>">
                                                <?= htmlspecialchars($txn['transaction_status']) ?>
                                            </span>
                                        </div>
                                        <div class="transaction-details">
                                            <p><strong>Item:</strong> <?= htmlspecialchars($txn['item_name']) ?></p>
                                            <p><strong>Quantity:</strong> <?= (int)$txn['quantity'] ?></p>
                                            <p><strong>Unit Price:</strong> ₱<?= number_format((float)$txn['unit_price'], 2) ?></p>
                                            <p><strong>Subtotal:</strong> ₱<?= number_format((float)$txn['subtotal'], 2) ?></p>
                                            <p><strong>Total Order:</strong> ₱<?= number_format((float)$txn['total_amount'], 2) ?></p>
                                            <p><strong>Buyer:</strong> <?= htmlspecialchars($txn['buyer_username']) ?></p>
                                            <p><strong>Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($txn['transaction_date']))) ?></p>
                                            
                                            <?php if ($txn['payment_method']): ?>
                                                <div class="payment-info">
                                                    <h5>Payment Details</h5>
                                                    <p><strong>Method:</strong> <?= htmlspecialchars($txn['payment_method']) ?></p>
                                                    <p><strong>Status:</strong> <?= htmlspecialchars($txn['payment_status']) ?></p>
                                                    
                                                    <?php if ($txn['payment_method'] === 'In-Person'): ?>
                                                        <?php if ($txn['meeting_date']): ?>
                                                            <p><strong>Meeting Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($txn['meeting_date']))) ?></p>
                                                        <?php endif; ?>
                                                        <?php if ($txn['meeting_time']): ?>
                                                            <p><strong>Meeting Time:</strong> <?= htmlspecialchars($txn['meeting_time']) ?></p>
                                                        <?php endif; ?>
                                                        <?php if ($txn['location']): ?>
                                                            <p><strong>Location:</strong> <?= htmlspecialchars($txn['location']) ?></p>
                                                        <?php endif; ?>
                                                        <?php if ($txn['contact_info']): ?>
                                                            <p><strong>Contact:</strong> <?= htmlspecialchars($txn['contact_info']) ?></p>
                                                        <?php endif; ?>
                                                        <?php if ($txn['agreed_amount']): ?>
                                                            <p><strong>Agreed Amount:</strong> ₱<?= number_format((float)$txn['agreed_amount'], 2) ?></p>
                                                        <?php endif; ?>
                                                        <?php if ($txn['additional_notes']): ?>
                                                            <p><strong>Notes:</strong> <?= htmlspecialchars($txn['additional_notes']) ?></p>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>You have no transactions yet.</p>
                        <?php endif; ?>
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
            '/assets/css/footer.css',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
        ],
        'js' => [
            '/pages/user-profile/assets/js/user-profile.js',
        ]
    ],
    true
);