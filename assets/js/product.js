// Load data produk saat halaman dibuka
$(document).ready(function () {
  // Cek jika ada keyword pencarian di URL
  var params = new URLSearchParams(window.location.search);
  var searchKeyword = params.get("search");

  if (searchKeyword) {
    searchProducts(searchKeyword);
    // Set nilai input pencarian
    $("#searchInput").val(searchKeyword);
  } else {
    loadProducts();
  }

  updateCartCount();
});

// Ambil semua produk via AJAX
function loadProducts() {
  var favIds = [];

  var fetchProducts = function () {
    $.ajax({
      url: "api/products.php?action=getAll",
      type: "GET",
      dataType: "json",
      success: function (products) {
        var grid = $("#productsGrid");
        grid.empty();

        products.forEach(function (product) {
          var isFavorited = favIds.indexOf(Number(product.id)) !== -1;
          var card = createProductCard(product, isFavorited);
          grid.append(card);
        });
      },
    });
  };

  if (window.isLoggedIn) {
    $.ajax({
      url: "api/favorites.php?action=getFavorites",
      type: "GET",
      dataType: "json",
      success: function (favorites) {
        favIds = favorites.map(function (item) {
          return Number(item.id);
        });
        fetchProducts();
      },
      error: function () {
        fetchProducts();
      },
    });
  } else {
    fetchProducts();
  }
}

// Cari produk dari database
function searchProducts(keyword) {
  var favIds = [];

  var fetchProducts = function () {
    $.ajax({
      url:
        "api/products.php?action=search&keyword=" + encodeURIComponent(keyword),
      type: "GET",
      dataType: "json",
      success: function (products) {
        var grid = $("#productsGrid");
        grid.empty();

        if (products.length == 0) {
          grid.html(
            '<p style="text-align:center; color:#aaa; grid-column: 1/-1; padding:40px;">No products found for "' +
              keyword +
              '"</p>',
          );
          return;
        }

        products.forEach(function (product) {
          var isFavorited = favIds.indexOf(Number(product.id)) !== -1;
          var card = createProductCard(product, isFavorited);
          grid.append(card);
        });
      },
    });
  };

  if (window.isLoggedIn) {
    $.ajax({
      url: "api/favorites.php?action=getFavorites",
      type: "GET",
      dataType: "json",
      success: function (favorites) {
        favIds = favorites.map(function (item) {
          return Number(item.id);
        });
        fetchProducts();
      },
      error: function () {
        fetchProducts();
      },
    });
  } else {
    fetchProducts();
  }
}

// Generate HTML untuk card produk
function createProductCard(product, isFavorited) {
  var badge = "";
  if (product.label == "PLAYSTATION") {
    badge = '<span class="badge playstation">PLAYSTATION</span>';
  } else if (product.label == "SWITCH 2") {
    badge = '<span class="badge switch2">SWITCH 2</span>';
  } else if (product.label == "OTHER") {
    badge = '<span class="badge other">OTHER</span>';
  }

  var html =
    '<a href="product/' + product.id + '" class="product-card-link">';
  html += '<div class="product-card">';
  html += '<div class="product-image">';
  html +=
    '<img src="' +
    product.image +
    '" alt="' +
    product.name +
    '" class="product-img">';
  html +=
    '<div class="product-image-overlay"><span>Klik Untuk Lihat Selengkapnya ></span></div>';
  html += badge;
  html += "</div>";
  html += "<h3>" + product.name + "</h3>";
  html +=
    '<div class="product-price">Rp ' +
    parseInt(product.price).toLocaleString("id-ID") +
    "</div>";

  html += '<div class="product-actions-row">';
  html +=
    '<button class="add-to-cart" onclick="addToCart(' +
    product.id +
    '); return false;">Add to Cart</button>';
  html +=
    '  <button class="fav-btn-action" onclick="toggleProductFavorite(event, ' +
    product.id +
    '); return false;">';
  html +=
    '    <i class="' +
    (isFavorited ? "fa-solid fa-heart" : "fa-regular fa-heart") +
    '" id="favIcon-' +
    product.id +
    '"' +
    (isFavorited ? ' style="color: #E8AEFF;"' : "") +
    "></i>";
  html += "  </button>";
  html += "</div>";

  html += "</div></a>";

  return html;
}

// Toggle status favorit produk
function toggleProductFavorite(event, productId) {
  event.preventDefault();
  event.stopPropagation();

  if (!window.isLoggedIn) {
    notifAlert("Please log in first!");
    return;
  }

  var icon = $("#favIcon-" + productId);

  $.ajax({
    url: "api/favorites.php",
    type: "POST",
    data: {
      action: "toggleFavorite",
      product_id: productId,
    },
    dataType: "json",
    success: function (response) {
      if (response.status == "added") {
        icon.removeClass("fa-regular").addClass("fa-solid");
        icon.css("color", "#E8AEFF");
        notifAlert("Added to Favorites!");
      } else {
        icon.removeClass("fa-solid").addClass("fa-regular");
        icon.css("color", "");
        notifAlert("Removed from Favorites");
      }
    },
  });
}

// Tambah ke keranjang via AJAX
function addToCart(productId) {
  if (!window.isLoggedIn) {
    notifAlert("Please log in first!");
    return;
  }

  $.ajax({
    url: "api/cart.php",
    type: "POST",
    data: {
      action: "addToCart",
      product_id: productId,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        // Update jumlah keranjang di navbar
        $(".cart-count").text(response.cartCount);
        notifAlert("Product added to cart!");
        // Buka drawer keranjang otomatis
        if (typeof openCartSidebar === "function") {
          openCartSidebar();
        }
      }
    },
  });
}

// Update jumlah keranjang di navbar
function updateCartCount() {
  $.ajax({
    url: "api/cart.php?action=getCount",
    type: "GET",
    dataType: "json",
    success: function (response) {
      $(".cart-count").text(response.cartCount);
    },
  });
}

// Ambil data keranjang dari database
function loadCart() {
  $.ajax({
    url: "api/cart.php?action=getCart",
    type: "GET",
    dataType: "json",
    success: function (items) {
      var tbody = $(".cart-table tbody");
      tbody.empty();

      var subtotal = 0;

      if (items.length == 0) {
        tbody.html(
          '<tr><td colspan="5" style="text-align:center; color:#aaa; padding:30px;">Your cart is empty</td></tr>',
        );
      } else {
        items.forEach(function (item) {
          var itemTotal = parseInt(item.price) * parseInt(item.qty);
          subtotal += itemTotal;

          var row = '<tr class="cart-item">';
          row += '<td class="item-info">';
          row += '<img src="' + item.image + '">';
          row += "<span>" + item.name + "</span>";
          row += "</td>";
          row +=
            "<td>Rp " + parseInt(item.price).toLocaleString("id-ID") + "</td>";
          row += "<td>";
          row += '<div class="qty-box">';
          row +=
            '<button onclick="updateCartQty(' +
            item.cart_id +
            ", " +
            (parseInt(item.qty) - 1) +
            ')">-</button>';
          row += '<span class="qty-input">' + item.qty + "</span>";
          row +=
            '<button onclick="updateCartQty(' +
            item.cart_id +
            ", " +
            (parseInt(item.qty) + 1) +
            ')">+</button>';
          row += "</div>";
          row += "</td>";
          row += "<td>Rp " + itemTotal.toLocaleString("id-ID") + "</td>";
          row +=
            '<td><i class="fa-solid fa-trash" style="color: #d52525; cursor:pointer;" onclick="removeFromCart(' +
            item.cart_id +
            ')"></i></td>';
          row += "</tr>";

          tbody.append(row);
        });
      }

      var shipping = 24000;
      var total = subtotal + shipping;
      $("#subtotal").text("Rp " + subtotal.toLocaleString("id-ID"));
      $("#tax").text("Rp " + shipping.toLocaleString("id-ID"));
      $("#total").text("Rp " + total.toLocaleString("id-ID"));
    },
  });
}

// Update jumlah item di keranjang
function updateCartQty(cartId, newQty) {
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
      loadCart();
      updateCartCount();
    },
  });
}

// Hapus dari keranjang
function removeFromCart(cartId) {
  $.ajax({
    url: "api/cart.php",
    type: "POST",
    data: {
      action: "removeFromCart",
      cart_id: cartId,
    },
    dataType: "json",
    success: function () {
      loadCart();
      updateCartCount();
    },
  });
}

 alert
function notifAlert(message) {
  var container = $("#notifContainer");
  var box = $('<div class="notifAlert">' + message + "</div>");
  container.append(box);

  setTimeout(function () {
    box.addClass("show");
  }, 20);

  // Hapus notifikasi setelah 3 detik
  setTimeout(function () {
    box.removeClass("show");
    setTimeout(function () {
      box.remove();
    }, 300);
  }, 3000);
}
