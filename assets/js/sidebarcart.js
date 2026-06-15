// Global functions for controlling the Sidebar Cart
function openCartSidebar() {
  $("#cartSidebar").addClass("active");
  $("#cartSidebarOverlay").addClass("active");
  loadSidebarCart();
}

function closeCartSidebar() {
  $("#cartSidebar").removeClass("active");
  $("#cartSidebarOverlay").removeClass("active");
}

// Load cart items inside the sidebar drawer
function loadSidebarCart() {
  $.ajax({
    url: "api/cart.php?action=getCart",
    type: "GET",
    dataType: "json",
    success: function (items) {
      var container = $("#cartSidebarItems");
      container.empty();

      var subtotal = 0;
      var totalCount = 0;

      if (items.length == 0) {
        $("#cartSidebarEmpty").show();
        $("#cartSidebarFooter").hide();
        $(".cart-sidebar-count").text("(0)");
        $(".cart-count").text(0);
      } else {
        $("#cartSidebarEmpty").hide();
        $("#cartSidebarFooter").show();

        items.forEach(function (item) {
          var itemTotal = parseInt(item.price) * parseInt(item.qty);
          subtotal += itemTotal;
          totalCount += parseInt(item.qty);

          var badgeLabel = item.label ? item.label : "GAME";

          var itemHtml = '<div class="cart-sidebar-item">';
          itemHtml += '<img src="' + item.image + '" class="cart-sidebar-img">';
          itemHtml += '<div class="cart-sidebar-info">';
          itemHtml += "<h4>" + item.name + "</h4>";
          itemHtml +=
            '<span class="cart-sidebar-platform">' + badgeLabel + "</span>";
          itemHtml +=
            '<div class="cart-sidebar-price">Rp ' +
            parseInt(item.price).toLocaleString("id-ID") +
            "</div>";
          itemHtml += '<div class="cart-sidebar-actions">';
          itemHtml += '<div class="cart-sidebar-qty">';
          itemHtml +=
            '<button onclick="updateSidebarQty(' +
            item.cart_id +
            ", " +
            (parseInt(item.qty) - 1) +
            ')">-</button>';
          itemHtml += "<span>" + item.qty + "</span>";
          itemHtml +=
            '<button onclick="updateSidebarQty(' +
            item.cart_id +
            ", " +
            (parseInt(item.qty) + 1) +
            ')">+</button>';
          itemHtml += "</div>";
          itemHtml +=
            '<i class="fa-solid fa-trash cart-sidebar-remove" onclick="removeSidebarItem(' +
            item.cart_id +
            ')"></i>';
          itemHtml += "</div>"; // actions
          itemHtml += "</div>"; // info
          itemHtml += "</div>"; // item

          container.append(itemHtml);
        });

        $(".cart-sidebar-count").text("(" + totalCount + ")");
        $(".cart-count").text(totalCount);
        $("#sidebarSubtotal").text("Rp " + subtotal.toLocaleString("id-ID"));
      }
    },
  });
}

// Update quantity from sidebar drawer
function updateSidebarQty(cartId, newQty) {
  if (newQty <= 0) {
    removeSidebarItem(cartId);
    return;
  }
  $.ajax({
    url: "api/cart.php",
    type: "POST",
    data: {
      action: "updateQty",
      cart_id: cartId,
      qty: newQty,
    },
    dataType: "json",
    success: function () {
      loadSidebarCart();
      // Also refresh standard catalog cart if it exists on active page
      if (typeof loadCart === "function") {
        loadCart();
      }
    },
  });
}

// Remove item from sidebar drawer
function removeSidebarItem(cartId) {
  $.ajax({
    url: "api/cart.php",
    type: "POST",
    data: {
      action: "removeFromCart",
      cart_id: cartId,
    },
    dataType: "json",
    success: function () {
      loadSidebarCart();
      // Also refresh standard catalog cart if it exists on active page
      if (typeof loadCart === "function") {
        loadCart();
      }
    },
  });
}

// Search function - redirect to product page with search results
function doSearch() {
  var keyword = $("#searchInput").val() || $("#mobileSearchInput").val();
  keyword = (keyword || "").trim();
  if (keyword == "") return;
  window.location.href =
    "product?search=" + encodeURIComponent(keyword);
}

$(document).ready(function () {
  // Check for URL parameter to open cart sidebar on load
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get("open_cart") === "1") {
    openCartSidebar();
    // Clean up the URL parameter visually without reloading
    const cleanUrl =
      window.location.protocol +
      "//" +
      window.location.host +
      window.location.pathname +
      window.location.search.replace(/[\?&]open_cart=1/, "");
    window.history.replaceState({ path: cleanUrl }, "", cleanUrl);
  }

  // Update cart count on navbar load
  $.ajax({
    url: "api/cart.php?action=getCount",
    type: "GET",
    dataType: "json",
    success: function (response) {
      $(".cart-count").text(response.cartCount);
    },
  });

  // Bind triggers for Cart Sidebar Drawer
  $("#cartNavbarIcon").click(function (e) {
    e.preventDefault();
    openCartSidebar();
  });

  $("#cartSidebarClose, #cartSidebarOverlay").click(function () {
    closeCartSidebar();
  });

  // Search bar functionality
  $("#searchBtn, #mobileSearchBtn").click(function () {
    doSearch();
  });

  $("#searchInput, #mobileSearchInput").keypress(function (e) {
    if (e.which == 13) {
      doSearch();
    }
  });
});

// Checkout: redirect to checkout page
function doCheckout() {
  closeCartSidebar();
  setTimeout(function () {
    window.location.href = "checkout";
  }, 300);
}
