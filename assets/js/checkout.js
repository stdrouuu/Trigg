$(document).ready(function () {
  loadCheckoutSummary();

  // Isi otomatis nama penerima jika ada
  if (window.userName) {
    var names = window.userName.split(" ");
    $("#firstName").val(names[0] || "");
    if (names.length > 1) {
      $("#lastName").val(names.slice(1).join(" "));
    }
  }
});

function loadCheckoutSummary() {
  $.getJSON("api/cart.php?action=getCart", function (items) {
    var container = $("#checkoutOrderItems");
    container.empty();

    if (items.length === 0) {
      container.html(
        '<div class="empty-checkout">Your cart is empty. <a href="product">Go back to products</a></div>',
      );
      $("#btnPlaceOrder").prop("disabled", true);
      return;
    }

    var subtotal = 0;
    items.forEach(function (item) {
      var itemTotal = parseInt(item.price) * parseInt(item.qty);
      subtotal += itemTotal;

      var html = '<div class="checkout-item">';
      html += '  <div class="checkout-item-details">';
      html += '    <img src="' + item.image + '" class="checkout-item-img">';
      html += "    <div>";
      html += '      <div class="checkout-item-name">' + item.name + "</div>";
      html +=
        '      <div class="checkout-item-qty">Qty: ' + item.qty + "</div>";
      html += "    </div>";
      html += "  </div>";
      html +=
        '  <div class="checkout-item-price">Rp ' +
        itemTotal.toLocaleString("id-ID") +
        "</div>";
      html += "</div>";
      container.append(html);
    });

    $("#checkoutSubtotal").text("Rp " + subtotal.toLocaleString("id-ID"));
    $("#checkoutTotal").text("Rp " + subtotal.toLocaleString("id-ID"));
  });
}

function processCheckoutSubmit() {
  var firstName = $("#firstName").val().trim();
  var lastName = $("#lastName").val().trim();
  var street = $("#streetAddress").val().trim();
  var phone = $("#phone").val().trim();
  var email = $("#email").val().trim();
  var notes = $("#notes").val().trim();

  if (!firstName || !lastName || !street || !phone || !email) {
    alert("Please fill out all required fields marked with *");
    return;
  }

  var $btn = $("#btnPlaceOrder");
  $btn.prop("disabled", true).text("PROCESSING...");

  $.ajax({
    url: "api/cart.php",
    type: "POST",
    data: {
      action: "checkout",
      first_name: firstName,
      phone: phone,
      address: street,
      email: email,
      order_notes: notes,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        if ($(".cart-count").length) $(".cart-count").text(0);
        if ($(".cart-sidebar-count").length)
          $(".cart-sidebar-count").text("(0)");

        // Redirect ke halaman orders
        window.location.href = "orders";
      } else {
        alert(response.message || "Checkout failed. Please try again.");
        $btn.prop("disabled", false).text("PLACE ORDER");
      }
    },
    error: function () {
      alert("Something went wrong. Please try again.");
      $btn.prop("disabled", false).text("PLACE ORDER");
    },
  });
}
