<?php
require_once LAYOUTS_PATH . '/main.layout.php';

renderMainLayout(function () {
    $transactionId = $_GET['transaction_id'] ?? '';
    $amountDue = $_GET['amount'] ?? '0.00';
?>
<section class="payment-section">
    <div class="payment-right">
        <div class="payment-form">
            <h1 class="payment-title enriqueta-bold">Initiate Secure Transfer</h1>
            <p class="payment-subtitle enriqueta-regular">Choose your protocol and proceed. This cannot be undone.</p>

            <!-- Transaction Summary -->
            <div class="payment-summary">
                <h3>Transaction Details</h3>
                <div class="summary-item">
                    <span>Transaction ID:</span>
                    <span class="enriqueta-regular"><?= htmlspecialchars($transactionId) ?></span>
                </div>
                <div class="summary-item">
                    <span>Total Due:</span>
                    <span class="enriqueta-bold">₱<?= htmlspecialchars($amountDue) ?></span>
                </div>
            </div>

            <!-- Payment Method Selector -->
            <h3 class="payment-subheading enriqueta-semibold">Select Exchange Protocol:</h3>
            <div class="payment-method">
                <label>
                    <input type="radio" name="payment_method" value="Bitcoin" checked>
                    <div class="payment-method-item">
                        <i class="fa-brands fa-bitcoin"></i>
                    </div>
                    <span>Bitcoin</span>
                </label>
                <label>
                    <input type="radio" name="payment_method" value="In Person">
                    <div class="payment-method-item">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <span>Eye Contact</span>
                </label>
            </div>

            <!-- Form -->
            <form action="/handlers/process_payment.handler.php" method="POST">
                <input type="hidden" name="transaction_id" value="<?= htmlspecialchars($transactionId) ?>">
                <input type="hidden" name="payment_method" id="selected-payment-method" value="Bitcoin"> 

                <!--General Fields-->
                <div class="payment-form-group-flex">
                    <div class="payment-form-group">
                        <input type="date" id="meeting-date" name="meeting_date" class="payment-form-control" placeholder=" " required>
                        <label for="meeting-date" class="payment-form-label payment-form-label-required">Meeting Date</label>
                    </div>
                    <div class="payment-form-group">
                        <input type="time" id="meeting-time" name="meeting_time" class="payment-form-control" placeholder=" " required>
                        <label for="meeting-time" class="payment-form-label payment-form-label-required">Meeting Time</label>
                    </div>
                </div>

                <div class="payment-form-group">
                    <input type="text" id="contact-info" name="contact_info" class="payment-form-control" placeholder=" " required>
                    <label for="contact-info" class="payment-form-label payment-form-label-required">Contact Information</label>
                </div>

                <!-- Bitcoin Fields -->
                <div id="bitcoin-fields" class="payment-method-fields">
                    <div class="payment-form-group">
                    <input type="text" id="meeting-location" name="meeting_location" class="payment-form-control" placeholder=" " required>
                    <label for="meeting-location" class="payment-form-label payment-form-label-required">Preferred Drop Off Location</label>
                </div>
                    <div class="copy-address-section">
                        <p class="enriqueta-semibold">Send ₱<?= htmlspecialchars($amountDue) ?> worth of Bitcoin to:</p>
                        <code id="payment-address">bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh</code>
                        <button type="button" class="copy-button"><i class="fas fa-copy"></i> Copy Address</button>
                    </div>
                    <input type="hidden" name="amount_paid" value="<?= htmlspecialchars($amountDue) ?>">
                </div>

                <!-- In-Person Fields -->
                <div id="in-person-fields" class="payment-method-fields hidden">
                    <div class="payment-form-group">
                        <input type="text" id="meeting-location" name="meeting_location" class="payment-form-control" placeholder=" " required>
                        <label for="meeting-location" class="payment-form-label payment-form-label-required">Preferred Meeting Location</label>
                    </div>
                    <div class="payment-form-group">
                        <input type="number" step="0.01" min="0" id="inperson-amount-paid" name="amount_paid" class="payment-form-control" placeholder=" " required>
                        <label for="inperson-amount-paid" class="payment-form-label payment-form-label-required">Agreed Amount (₱)</label>
                    </div>
                    <div class="payment-form-group">
                        <textarea id="meeting-notes" name="meeting_notes" class="payment-form-control" rows="3" placeholder=" "></textarea>
                        <label for="meeting-notes" class="payment-form-label">Additional Notes</label>
                    </div>
                </div>

                <!-- Payment Status Display -->
                <div class="payment-status-section">
                    <p class="payment-status-label">Payment Status:</p>
                    <span class="payment-status-badge status-unpaid">Unpaid</span>
                </div>

                <button type="submit" class="payment-form-submit-button enriqueta-semibold">
                    <i class="fas fa-lock"></i> Confirm Transaction
                </button>
            </form>
        </div>
    </div>
</section>
<?php
}, "Payment Protocol", [
    'css' => [
        '/assets/css/main.css',
        '/assets/css/navbar.css',
        '/assets/css/footer.css',
        '/pages/Payment/assets/css/payment.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'
    ],
    'js' => [
        '/pages/Payment/assets/js/payment.js'
    ]
]);
