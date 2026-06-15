<?php
// Pastikan user sudah login
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: auth');
    exit;
}
?>
<link rel="stylesheet" href="./assets/css/checkout-style.css?v=<?= time(); ?>" />

<a href="product" class="back-button">
    <i class="fas fa-arrow-left"></i>
    <span>Back to Products</span>
</a>

<div class="checkout-container">
    <!-- Breadcrumbs -->
    <div class="checkout-steps">
        <span class="step completed">Shopping Cart</span>
        <span class="step-arrow"><i class="fas fa-chevron-right"></i></span>
        <span class="step active">Checkout Details</span>
        <span class="step-arrow"><i class="fas fa-chevron-right"></i></span>
        <span class="step">Order Complete</span>
    </div>

    <div class="checkout-grid">
        <!-- Left Column: Form -->
        <div class="checkout-card billing-section">
            <h2 class="section-title">Billing & Shipping</h2>
            <form id="checkoutForm" onsubmit="event.preventDefault();">
                <div class="form-row">
                    <div class="form-group col-half">
                        <label for="firstName">First name *</label>
                        <input type="text" id="firstName" required placeholder="First name">
                    </div>
                    <div class="form-group col-half">
                        <label for="lastName">Last name *</label>
                        <input type="text" id="lastName" required placeholder="Last name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="country">Country / Region *</label>
                    <select id="country" disabled style="opacity: 0.8; cursor: not-allowed;">
                        <option value="Indonesia" selected>Indonesia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="streetAddress">Street address *</label>
                    <input type="text" id="streetAddress" required placeholder="House number and street name">
                </div>

                <div class="form-row">
                    <div class="form-group col-half">
                        <label for="phone">Phone *</label>
                        <input type="text" id="phone" required placeholder="Phone number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email address *</label>
                    <input type="email" id="email" required placeholder="Email address">
                </div>

                <div class="form-group">
                    <label for="notes">Order notes (optional)</label>
                    <textarea id="notes" rows="4" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </div>
            </form>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="checkout-card order-summary-section">
            <h2 class="section-title">Your Order</h2>
            
            <div class="order-items-list" id="checkoutOrderItems">
                <!-- Dynamically populated -->
            </div>

            <div class="summary-row subtotal-row">
                <span>Subtotal</span>
                <span id="checkoutSubtotal">Rp 0</span>
            </div>

            <div class="shipping-options-box">
                <span class="shipping-title">Shipment</span>
                <div class="shipping-option">
                    <input type="radio" id="shipmentDelivery" name="shipment_method" value="delivery" checked>
                    <label for="shipmentDelivery">
                        <strong>Free Delivery via JNE</strong>
                        <span class="shipping-desc">Delivered to your home address</span>
                    </label>
                </div>
            </div>

            <div class="summary-row total-row">
                <span>Total</span>
                <span id="checkoutTotal">Rp 0</span>
            </div>

            <div class="payment-methods-box">
                <span class="shipping-title">Payment Method</span>
                <div class="payment-option">
                    <input type="radio" id="payBank" name="payment_method" value="bank" checked>
                    <label for="payBank">
                        <strong>Direct bank transfer</strong>
                        <span class="payment-desc">Manual verification. Use Order Number as payment reference.</span>
                    </label>
                </div>
                <div class="payment-option">
                    <input type="radio" id="payQRIS" name="payment_method" value="qris">
                    <label for="payQRIS">
                        <strong>QRIS</strong>
                        <span class="payment-logos"><i class="fa-solid fa-qrcode"></i> Instant Scan</span>
                    </label>
                </div>
                <div class="payment-option">
                    <input type="radio" id="payEWallet" name="payment_method" value="ewallet">
                    <label for="payEWallet">
                        <strong>GoPay / OVO</strong>
                        <span class="payment-logos"><i class="fa-solid fa-wallet"></i> Linked Wallet</span>
                    </label>
                </div>
            </div>

            <button type="button" class="place-order-btn" id="btnPlaceOrder" onclick="processCheckoutSubmit()">
                PLACE ORDER
            </button>
        </div>
    </div>
</div>

<script src="assets/js/checkout.js?v=<?= time(); ?>"></script>
