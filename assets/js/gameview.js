// Load detail game saat halaman dibuka
$(document).ready(function () {
  loadGameview();
});

// Ambil ID produk dari URL
function getProductIdFromURL() {
  if (typeof window.gameviewId !== "undefined" && window.gameviewId) {
    return Number(window.gameviewId);
  }
  var params = new URLSearchParams(window.location.search);
  return Number(params.get("id"));
}

// Ambil detail produk via AJAX
function loadGameview() {
  var productId = getProductIdFromURL();

  $.ajax({
    url: "api/products.php?action=getOne&id=" + productId,
    type: "GET",
    dataType: "json",
    success: function (product) {
      $("#mainProductImage").attr("src", product.image);
      $("#mainProductImage").attr("alt", product.name);
      $("#productTitle").text(product.name);
      $("#productPrice").text(
        "Rp " + parseInt(product.price).toLocaleString("id-ID"),
      );
      $("#description").text(product.description);
      $("#sku").text("ITEM-ID-" + product.id);
      $("#category").text(product.label);
      $("#tags").text(product.label + ", Games");

      // Set brand teks sesuai label produk
      if (product.label == "PLAYSTATION") {
        $("#productBrand").text("PlayStation");
      } else if (product.label == "SWITCH 2") {
        $("#productBrand").text("Nintendo Switch 2");
      } else {
        $("#productBrand").text("Other");
      }

      // Cek apakah produk ini difavoritkan
      checkFavoriteStatus(product.id);
    },
  });
}

// Tambah ke keranjang dari halaman gameview
function addToCart() {
  if (!window.isLoggedIn) {
    notifAlert("Please log in first!");
    return;
  }

  var productId = getProductIdFromURL();

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
        notifAlert("Product added to cart!");
        // Buka drawer keranjang otomatis
        if (typeof openCartSidebar === "function") {
          openCartSidebar();
        }
      }
    },
  });
}

// Toggle status favorit
function toggleFavorite() {
  if (!window.isLoggedIn) {
    notifAlert("Please log in first!");
    return;
  }
  var productId = getProductIdFromURL();

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
        $("#favIcon").removeClass("fa-regular").addClass("fa-solid");
        $("#favIcon").css("color", "#E8AEFF");
        notifAlert("Added to Favorites!");
      } else {
        $("#favIcon").removeClass("fa-solid").addClass("fa-regular");
        $("#favIcon").css("color", "");
        notifAlert("Removed from Favorites");
      }
    },
  });
}

// Cek status favorit produk
function checkFavoriteStatus(productId) {
  $.ajax({
    url: "api/favorites.php?action=checkFavorite&product_id=" + productId,
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response.isFavorited) {
        $("#favIcon").removeClass("fa-regular").addClass("fa-solid");
        $("#favIcon").css("color", "#E8AEFF");
      }
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

  setTimeout(function () {
    box.removeClass("show");
    setTimeout(function () {
      box.remove();
    }, 300);
  }, 3000);
}

// Cegah klik jika belum login
function checkAuthLink(event) {
  if (!window.isLoggedIn) {
    event.preventDefault();
    notifAlert("Please log in first!");
  }
}
