<?php
$isLoggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
$userName = $isLoggedIn ? $_SESSION['user_name'] : '';
?>
<link rel="stylesheet" href="./assets/css/navbar.css?v=<?= time(); ?>" />

<nav class="navbar">
      <div class="nav-container">
        <!-- Group Left: Logo & Menu Links -->
        <div class="nav-group-left" style="display: flex; align-items: center; gap: 36px;">
          <div class="nav-logo" onclick="window.location.href='main'" style="cursor: pointer;">
            <i class="fa-solid fa-shapes"></i>
           <strong>Gam<span style="font-weight: 900; color: #A0C4FF;">i</span><span style="font-weight: 900; color: #BDB2FF;">n</span><span style="font-weight: 900; color: #E8AEFF;">c</span></strong>

          </div>
    
          <ul class="nav-menu">
            <li>
              <a href="main" class="nav-link">Home</a>
            </li>
            <li>
              <a href="product" class="nav-link">Products</a>
            </li>
            <li>
              <a href="faq" class="nav-link">FAQ</a>
            </li>
            <li>
              <a href="complaint" class="nav-link">Complaints</a>
            </li>
          </ul>
        </div>
  
        <!-- Group Right: Search, Theme, Favorites, Cart, Login -->
        <div class="nav-group-right" style="display: flex; align-items: center; gap: 16px; flex: 1; justify-content: flex-end;">
          <div class="search-bar" style="margin-right: 8px;">
            <input type="text" id="searchInput" placeholder="Cari di toko..." />
            <button id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>

          <div class="nav-cart nav-favorites-wrapper">
            <a href="favorites" class="cart-icon fav-navbar-btn" title="Favorites">
              <i class="fas fa-heart"></i>
            </a>
          </div>

          <div class="nav-cart nav-cart-wrapper">
            <!-- SIDEBAR SHOPPING CART -->
            <a href="javascript:void(0)" class="cart-icon" id="cartNavbarIcon" title="Shopping Cart">
              <i class="fas fa-shopping-cart"></i>
              <span class="cart-count">0</span>
            </a>
          </div>

          <div class="nav-user" style="display: flex; align-items: center;">
            <?php if ($isLoggedIn): ?>
              <span class="nav-greeting" style="color: var(--text-primary); font-size: 0.95rem; font-weight: 500; margin-right: 12px; white-space: nowrap;">
                Hello, <span style="color: #BDB2FF;"><?= htmlspecialchars($userName)?></span>
              </span>
              <a href="user" class="user-icon" title="Profile">
                <i class="fa-regular fa-user"></i>
              </a>
            <?php else: ?>
              <a href="auth" class="login-here-btn">Login here !</a>
            <?php endif; ?>
          </div>

          <div class="nav-hamburger">
            <div class="hamburger-icon">
              <i class="fa-solid fa-bars"></i>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="mobile-overlay">
      <div class="mobile-menu">
          <!-- Mobile Search - RESPINSIF -->
          <div class="mobile-search-bar">
            <input type="text" id="mobileSearchInput" placeholder="Cari di toko..." />
            <button id="mobileSearchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>

          <!-- Mobile Links - RESPONSIF -->
          <div class="mobile-menu-links">
            <a href="main">Home</a>
            <a href="product">Products</a>
            <a href="faq">FAQ</a>
            <a href="complaint">Complaints</a>
            <a href="favorites" class="fav-navbar-btn">Favorites</a>
          </div>

          <!-- Mobile User Section - RESPONSIF -->
          <div class="mobile-user-section">
            <?php if ($isLoggedIn): ?>
              <div class="mobile-profile-card">
                <span class="mobile-greeting">Hello, <span class="mobile-username"><?= htmlspecialchars($userName)?></span></span>
                <a href="user" class="mobile-profile-btn"><i class="fa-regular fa-user"></i> Profile</a>
              </div>
            <?php else: ?>
              <a href="auth" class="mobile-login-btn">Login here !</a>
            <?php endif; ?>
          </div>
      </div>
    </div>

    <!-- Cart Sidebar Drawer -->
    <div class="cart-sidebar-overlay" id="cartSidebarOverlay"></div>
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-sidebar-header">
            <h3><i class="fas fa-shopping-cart"></i> Shopping Cart <span class="cart-sidebar-count">(0)</span></h3>
            <button class="cart-sidebar-close" id="cartSidebarClose"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="cart-sidebar-content">
            <div class="cart-sidebar-items" id="cartSidebarItems">
                <!-- Cart items will be loaded here dynamically -->
            </div>
            <div class="cart-sidebar-empty" id="cartSidebarEmpty" style="display: none;">
                <i class="fas fa-shopping-basket"></i>
                <p>Your shopping cart is empty</p>
                <button class="cart-sidebar-shop-btn" onclick="closeCartSidebar(); window.location.href='product';">Start Shopping</button>
            </div>
        </div>
        <div class="cart-sidebar-footer" id="cartSidebarFooter">
            <div class="cart-sidebar-subtotal">
                <span>Subtotal</span>
                <span class="subtotal-amount" id="sidebarSubtotal">Rp 0</span>
            </div>
            <p class="cart-sidebar-note">Shipping & taxes calculated at checkout.</p>
            <button class="cart-sidebar-checkout-btn" id="checkoutBtn" onclick="doCheckout()">Proceed to Checkout</button>
        </div>
    </div>

    <script src="assets/js/navhamburger.js"></script>
    <script src="assets/js/sidebarcart.js"></script>

