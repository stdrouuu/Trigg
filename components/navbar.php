<link rel="stylesheet" href="./assets/css/navbar.css?v=<?= time(); ?>" />

<nav class="navbar">
      <div class="nav-container">
        <div class="nav-logo">
          <i class="fa-solid fa-shapes"></i>
          <!-- <i class="fa-brands fa-guilded"></i> -->
          <strong>GamInc</strong>
        </div>
  
        <div class="nav-user">
          <a class="user-icon" onclick="toggleTheme()">
            <i class="fa-solid fa-toggle-off"></i>
          </a>
        </div>

        <ul class="nav-menu">
          <li>
            <a href="index.php?page=main" class="nav-link">Home</a>
          </li>
          <li>
            <a href="index.php?page=main#about" class="nav-link">About</a>
          </li>
          <li>
            <a href="index.php?page=main#contact" class="nav-link">Contact</a>
          </li>
          <li>
            <a href="index.php?page=product" class="nav-link">Products</a>
          </li>
          <li>
            <a href="index.php?page=credits" class="nav-link">Credits</a>
          </li>
        </ul>
          

        <div class="search-bar">
          <input type="text" id="searchInput" placeholder="Cari game, item, atau top-up..." />
          <button id="searchBtn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <div class="nav-cart">
          <a href="index.php?page=favorites" class="cart-icon" title="Favorites" style="color: #ff4d4d;">
            <i class="fas fa-heart"></i>
          </a>
        </div>

        <div class="nav-cart">
          <!-- SIDEBAR SHOPPING CART -->
          <a href="javascript:void(0)" class="cart-icon" id="cartNavbarIcon" title="Shopping Cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count">0</span>
          </a>
        </div>

        <div class="nav-user">
          <a href="index.php?page=user" class="user-icon">
            <i class="fa-regular fa-user"></i>
          </a>
        </div>

        <div class="nav-hamburger">
          <div class="hamburger-icon">
            <i class="fa-solid fa-bars"></i>
          </div>
        </div>
      </div>
    </nav>

    <div class="mobile-overlay">
      <div class="mobile-menu">
          <a href="index.php?page=main">Home</a>
          <a href="index.php?page=main#about">About</a>
          <a href="index.php?page=main#contact">Contact</a>
          <a href="index.php?page=product">Products</a>
          <a href="index.php?page=favorites">Favorites</a>
          <a href="index.php?page=credits">Credits</a>
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
                <button class="cart-sidebar-shop-btn" onclick="closeCartSidebar(); window.location.href='index.php?page=product';">Start Shopping</button>
            </div>
        </div>
        <div class="cart-sidebar-footer" id="cartSidebarFooter">
            <div class="cart-sidebar-subtotal">
                <span>Subtotal</span>
                <span class="subtotal-amount" id="sidebarSubtotal">Rp 0</span>
            </div>
            <p class="cart-sidebar-note">Shipping & taxes calculated at checkout.</p>
            <button class="cart-sidebar-checkout-btn" onclick="alert('Checkout feature coming soon!')">Proceed to Checkout</button>
        </div>
    </div>

    <script src="assets/js/navhamburger.js"></script>
    <script src="assets/js/thtoggle.js"></script>

    <script>
        // Global functions for controlling the Sidebar Cart
        function openCartSidebar() {
            $('#cartSidebar').addClass('active');
            $('#cartSidebarOverlay').addClass('active');
            loadSidebarCart();
        }

        function closeCartSidebar() {
            $('#cartSidebar').removeClass('active');
            $('#cartSidebarOverlay').removeClass('active');
        }

        // Load cart items inside the sidebar drawer
        function loadSidebarCart() {
            $.ajax({
                url: 'api/cart.php?action=getCart',
                type: 'GET',
                dataType: 'json',
                success: function(items) {
                    var container = $('#cartSidebarItems');
                    container.empty();
                    
                    var subtotal = 0;
                    var totalCount = 0;

                    if (items.length == 0) {
                        $('#cartSidebarEmpty').show();
                        $('#cartSidebarFooter').hide();
                        $('.cart-sidebar-count').text('(0)');
                        $('.cart-count').text(0);
                    } else {
                        $('#cartSidebarEmpty').hide();
                        $('#cartSidebarFooter').show();

                        items.forEach(function(item) {
                            var itemTotal = parseInt(item.price) * parseInt(item.qty);
                            subtotal += itemTotal;
                            totalCount += parseInt(item.qty);

                            var badgeLabel = item.label ? item.label : 'GAME';

                            var itemHtml = '<div class="cart-sidebar-item">';
                            itemHtml += '<img src="' + item.image + '" class="cart-sidebar-img">';
                            itemHtml += '<div class="cart-sidebar-info">';
                            itemHtml += '<h4>' + item.name + '</h4>';
                            itemHtml += '<span class="cart-sidebar-platform">' + badgeLabel + '</span>';
                            itemHtml += '<div class="cart-sidebar-price">Rp ' + parseInt(item.price).toLocaleString('id-ID') + '</div>';
                            itemHtml += '<div class="cart-sidebar-actions">';
                            itemHtml += '<div class="cart-sidebar-qty">';
                            itemHtml += '<button onclick="updateSidebarQty(' + item.cart_id + ', ' + (parseInt(item.qty) - 1) + ')">-</button>';
                            itemHtml += '<span>' + item.qty + '</span>';
                            itemHtml += '<button onclick="updateSidebarQty(' + item.cart_id + ', ' + (parseInt(item.qty) + 1) + ')">+</button>';
                            itemHtml += '</div>';
                            itemHtml += '<i class="fa-solid fa-trash cart-sidebar-remove" onclick="removeSidebarItem(' + item.cart_id + ')"></i>';
                            itemHtml += '</div>'; // actions
                            itemHtml += '</div>'; // info
                            itemHtml += '</div>'; // item

                            container.append(itemHtml);
                        });

                        $('.cart-sidebar-count').text('(' + totalCount + ')');
                        $('.cart-count').text(totalCount);
                        $('#sidebarSubtotal').text('Rp ' + subtotal.toLocaleString('id-ID'));
                    }
                }
            });
        }

        // Update quantity from sidebar drawer
        function updateSidebarQty(cartId, newQty) {
            if (newQty <= 0) {
                removeSidebarItem(cartId);
                return;
            }
            $.ajax({
                url: 'api/cart.php',
                type: 'POST',
                data: {
                    action: 'updateQty',
                    cart_id: cartId,
                    qty: newQty
                },
                dataType: 'json',
                success: function() {
                    loadSidebarCart();
                    // Also refresh standard catalog cart if it exists on active page
                    if (typeof loadCart === 'function') {
                        loadCart();
                    }
                }
            });
        }

        // Remove item from sidebar drawer
        function removeSidebarItem(cartId) {
            $.ajax({
                url: 'api/cart.php',
                type: 'POST',
                data: {
                    action: 'removeFromCart',
                    cart_id: cartId
                },
                dataType: 'json',
                success: function() {
                    loadSidebarCart();
                    // Also refresh standard catalog cart if it exists on active page
                    if (typeof loadCart === 'function') {
                        loadCart();
                    }
                }
            });
        }

        // Search function - redirect to product page with search results
        function doSearch() {
            var keyword = $('#searchInput').val().trim();
            if (keyword == '') return;
            window.location.href = 'index.php?page=product&search=' + encodeURIComponent(keyword);
        }

        $(document).ready(function() {
            // Check for URL parameter to open cart sidebar on load
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('open_cart') === '1') {
                openCartSidebar();
                // Clean up the URL parameter visually without reloading
                const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search.replace(/[\?&]open_cart=1/, '');
                window.history.replaceState({path: cleanUrl}, '', cleanUrl);
            }

            // Update cart count on navbar load
            $.ajax({
                url: 'api/cart.php?action=getCount',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('.cart-count').text(response.cartCount);
                }
            });

            // Bind triggers for Cart Sidebar Drawer
            $('#cartNavbarIcon').click(function(e) {
                e.preventDefault();
                openCartSidebar();
            });

            $('#cartSidebarClose, #cartSidebarOverlay').click(function() {
                closeCartSidebar();
            });

            // Search bar functionality
            $('#searchBtn').click(function() {
                doSearch();
            });

            $('#searchInput').keypress(function(e) {
                if (e.which == 13) {
                    doSearch();
                }
            });
        });
    </script>
