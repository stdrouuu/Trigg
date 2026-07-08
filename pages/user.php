<?php
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: auth');
    exit;
}
?>

<link rel="stylesheet" href="./assets/css/user-style.css?v=<?= time(); ?>" />

    <a href="main" class="back-button">
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
    </a>

    <div class="user-container">

        <!-- Left Column -->
        <div class="user-left-col">
            <!-- Profile Card -->
            <div class="profile-card card-box">
                <div class="profile-bg-icon"><i class="fas fa-gamepad"></i></div>
                <div class="profile-avatar" id="userAvatar">B</div>
                <div class="profile-info">
                    <div class="profile-name" id="userName">Brandon</div>
                    <div class="profile-badge"><i class="fas fa-gamepad"></i> <i style="font-style: italic;">Trigg</i> Member</div>
                </div>
            </div>

            <!-- Order Summary Strip -->
            <a href="orders" class="orders-strip card-box">
                <div class="strip-title">
                    <span>Pesanan Saya</span>
                </div>
                <div class="strip-statuses">
                    <div class="strip-status">
                        <div class="strip-count" id="cnt-pending">—</div>
                        <div class="strip-label">Pending</div>
                    </div>
                    <div class="strip-divider"></div>
                    <div class="strip-status">
                        <div class="strip-count" id="cnt-processing">—</div>
                        <div class="strip-label">Diproses</div>
                    </div>
                    <div class="strip-divider"></div>
                    <div class="strip-status">
                        <div class="strip-count" id="cnt-shipped">—</div>
                        <div class="strip-label">Dikirim</div>
                    </div>
                    <div class="strip-divider"></div>
                    <div class="strip-status">
                        <div class="strip-count" id="cnt-delivered">—</div>
                        <div class="strip-label">Terkirim</div>
                    </div>
                </div>
                <i class="fas fa-chevron-right strip-arrow"></i>
            </a>

            <!-- E-Wallets -->
            <div class="account-menu card-box e-wallet-box">
                <div class="e-wallet-header">
                    <i class="fas fa-wallet"></i> E-Wallets
                </div>
                <a class="menu-list-item">
                    <div class="menu-icon-wrap ovo-wrap"><i class="fas fa-wallet"></i></div>
                    <span class="menu-title">OVO</span>
                    <span class="status-linked">Linked <br><span class="balance">Rp 150.000</span></span>
                </a>
                <a class="menu-list-item" target="_blank">
                    <div class="menu-icon-wrap gopay-wrap"><i class="fas fa-wallet"></i></div>
                    <span class="menu-title">GoPay</span>
                    <span class="status-connect">Connect <i class="fas fa-chevron-right arrow-icon margin-left"></i></span>
                </a>
            </div>

            <!-- Account Menu -->
            <div class="account-menu card-box">
                <a href="product?open_cart=1" class="menu-list-item">
                    <div class="menu-icon-wrap"><i class="fas fa-shopping-cart"></i></div>
                    <span class="menu-title">Keranjang Saya</span>
                    <span class="menu-badge" id="cartItemCount"></span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <a href="credits" class="menu-list-item">
                    <div class="menu-icon-wrap"><i class="fas fa-info-circle"></i></div>
                    <span class="menu-title">About <i style="font-style: italic;">Trigg</i></span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
                <a href="#" class="menu-list-item logout-item" id="logoutBtn">
                    <div class="menu-icon-wrap"><i class="fas fa-sign-out-alt"></i></div>
                    <span class="menu-title">Logout</span>
                    <i class="fas fa-chevron-right arrow-icon"></i>
                </a>
            </div>
        </div>

        <!-- Right Column -->
        <div class="user-right-col">
            <!-- Complaints Section -->
            <div class="account-menu card-box complaints-box">
                <div class="e-wallet-header">
                    <i class="fas fa-headset"></i> Komplain Saya
                </div>
                <div class="complaints-list-container" id="userComplaintsList">
                    <div style="padding: 20px 24px; text-align: center; color: var(--text-secondary); font-size: 0.9rem;">
                        Loading complaints...
                    </div>
                </div>
            </div>

            <!-- Submit New Complaint Shortcut -->
            <a href="complaint" class="card-box quick-complaint-shortcut">
                <div class="shortcut-icon-wrap">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="shortcut-info">
                    <h3>Ada kendala transaksi?</h3>
                    <p>Laporkan kendala pembayaran atau akun Anda ke Tim Support kami.</p>
                    <span class="shortcut-link">Kirim Komplain Baru <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
        </div>

    </div>

<script src="assets/js/user.js?v=<?= time(); ?>"></script>
