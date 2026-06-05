<link rel="stylesheet" href="./assets/css/user-style.css" />


    <a href="index.php?page=product" class="back-button">
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
    </a>
    
    <div class="user-container">
        <div class="account-header">
            <div class="profile-info">
                <div class="avatar" id="userAvatar">
                    B
                </div>
                <div class="user-name" id="userName">Brandon</div>
            </div> 
        </div>

        <div class="wallet-section card-box">
            <div class="wallet-item">
                <i class="fas fa-credit-card icon-dana"></i>
                <span>DANA</span>
                <span class="balance">Connect</span>
            </div>
            <div class="wallet-item">
                <i class="fas fa-credit-card icon-ovo"></i>
                <span>OVO</span>
                <span class="balance">Connect</span>
            </div>
            <div class="wallet-item">
                <i class="fas fa-wallet icon-dompetku"></i>
                <span>My Balance</span>
                <span class="balance">Rp0</span>
            </div>
        </div>

        <div class="activity-section">
            <div class="section-title-row">
                <a href="#">See Order Details <i class="fas fa-chevron-right small-icon"></i></a>
            </div>

            <div class="activity-grid">
                <div class="activity-item card-box">
                    <i class="fas fa-clock activity-icon"></i>
                    <span>Pending Payment</span>
                </div>
                <div class="activity-item card-box">
                    <i class="fas fa-truck activity-icon"></i>
                    <span>Pending Shipment</span>
                </div>
                <div class="activity-item card-box">
                    <i class="fa-solid fa-paper-plane activity-icon"></i>
                    <span>Shipped</span>
                </div>
                <div class="activity-item card-box">
                    <i class="fas fa-check-circle activity-icon" style="color: #44ef86ff"></i>
                    <span>Completed</span>
                </div>
            </div>
        </div>

        <!-- Quick Links Section -->
        <div class="help-section">
            <a href="index.php?page=favorites" class="menu-list-item">
                <i class="fas fa-heart menu-icon" style="color: #ff4d4d;"></i>
                <span>My Favorites</span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a>
            <a href="index.php?page=product&open_cart=1" class="menu-list-item">
                <i class="fas fa-shopping-cart menu-icon"></i>
                <span>My Cart <span id="cartItemCount" style="color: #00e6e0;"></span></span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a>
            <a href="index.php?page=complaint" class="menu-list-item">
                <i class="fas fa-file-alt menu-icon" style="color: #000000ff;"></i>
                <span>Submit a Complaint</span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a>
            <a href="index.php?page=faq" class="menu-list-item">
                <i class="fas fa-headset menu-icon" style="color: #000000ff;"></i>
                <span>Help & FAQ</span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a>

            <a href="#" class="menu-list-item" id="logoutBtn">
                <i class="fas fa-sign-out-alt menu-icon" style="color: var(--red-alert);"></i>
                <span>Logout</span>
                <i class="fas fa-chevron-right arrow-icon"></i>
            </a> 
        </div>
    </div>

<script>
    $(document).ready(function() {
        // Logout
        $('#logoutBtn').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'api/auth.php',
                type: 'POST',
                data: { action: 'logout' },
                dataType: 'json',
                success: function() {
                    window.location.href = 'index.php';
                }
            });
        });
    });
</script>

<script src="assets/js/thtoggle.js"></script>