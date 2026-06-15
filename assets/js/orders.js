// Mapping index untuk progress bar
const STATUS_STEP = { pending: 0, processing: 1, shipped: 2, delivered: 3 };
const STEP_ICONS = ["fa-check", "fa-cog", "fa-truck", "fa-box"];
const STEP_LABELS = ["Confirmed", "Processing", "Shipped", "Delivered"];
// Mengatur lebar progress bar sesuai status
const FILL_PCT = [0, 33.33, 66.66, 100];

function buildProgressBar(status) {
  var activeIdx = STATUS_STEP[status] ?? 0;
  var fillPct = FILL_PCT[activeIdx];

  var html =
    '<div class="delivery-progress">' +
    '<div class="progress-steps">' +
    '<div class="progress-line-container">' +
    '<div class="progress-fill" style="width:' +
    fillPct +
    '%"></div>' +
    "</div>";

  for (var i = 0; i < STEP_LABELS.length; i++) {
    var cls = "";
    if (i < activeIdx) cls = "done";
    else if (i === activeIdx) cls = "active";

    html +=
      '<div class="progress-step ' +
      cls +
      '">' +
      '<div class="step-dot"></div>' +
      '<div class="step-label">' +
      STEP_LABELS[i] +
      "</div>" +
      "</div>";
  }

  html += "</div></div>";
  return html;
}

function formatRp(num) {
  return "Rp " + parseInt(num).toLocaleString("id-ID");
}

function formatDate(str) {
  var d = new Date(str);
  return d.toLocaleDateString("id-ID", {
    day: "2-digit",
    month: "short",
    year: "numeric",
  });
}

function loadOrders(statusFilter) {
  var url = "api/orders.php?action=getOrders";
  if (statusFilter && statusFilter !== "all") url += "&status=" + statusFilter;

  $("#ordersList").html(
    '<div class="skeleton-card"><div class="skeleton-line" style="width:40%"></div>' +
      '<div class="skeleton-line" style="width:80%"></div>' +
      '<div class="skeleton-line" style="width:60%"></div></div>',
  );

  $.getJSON(url, function (orders) {
    if (orders.length === 0) {
      $("#ordersList").html(
        '<div class="empty-orders">' +
          '<i class="fas fa-box-open"></i>' +
          "<h3>Belum ada pesanan !</h3>" +
          "<p>Belum ada pesanan di kategori ini.</p>" +
          '<a href="product" class="btn-shop">Ayo, Mulai Belanja !</a>' +
          "</div>",
      );
      return;
    }

    var html = "";
    orders.forEach(function (order) {
      var statusClass = "status-" + order.status;
      var statusLabel =
        order.status.charAt(0).toUpperCase() + order.status.slice(1);

      html += '<div class="order-card ' + statusClass + '">';
      html += '<div class="order-card-header">';
      html += '<span class="order-id">ORDER #' + order.id + "</span>";
      html +=
        '<span class="order-date">' + formatDate(order.created_at) + "</span>";
      html +=
        '<span class="status-badge ' +
        statusClass +
        '">' +
        statusLabel +
        "</span>";
      html += "</div>";
      html += buildProgressBar(order.status);
      html += '<div class="order-card-footer">';
      html += "<div>";
      html +=
        '<div class="order-total">' + formatRp(order.total_price) + "</div>";
      html +=
        '<div class="order-items-count" id="item-count-' +
        order.id +
        '">Loading items...</div>';
      html += "</div>";
      html +=
        '<button class="btn-view-detail" onclick="toggleDetail(' +
        order.id +
        ')">View Items</button>';
      html += "</div>";
      html += '<div class="order-items-detail" id="detail-' + order.id + '">';
      if (order.recipient_name || order.shipping_address) {
        html +=
          '<div class="order-shipping-summary" style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px dashed var(--border); font-size: 0.9rem; color: var(--text-muted); text-align: left;">';
        html +=
          '<strong style="color: var(--text-primary); display: block; margin-bottom: 6px;"><i class="fas fa-map-marker-alt me-1"></i> Shipping Details:</strong>';
        html +=
          "<div><strong>Name:</strong> " +
          (order.recipient_name || "-") +
          "</div>";
        html +=
          "<div><strong>Phone:</strong> " +
          (order.phone_number || "-") +
          "</div>";
        html +=
          "<div><strong>Address:</strong> " +
          (order.shipping_address || "-") +
          " (Postal Code: " +
          (order.postal_code || "-") +
          ")</div>";
        html += "</div>";
      }
      html +=
        '<div class="order-items-rows-container" id="items-container-' +
        order.id +
        '"></div>';
      html += "</div>";
      html += "</div>";
    });

    $("#ordersList").html(html);

    // Load jumlah item & datanya secara lazy
    orders.forEach(function (order) {
      $.getJSON(
        "api/orders.php?action=getOrderDetail&id=" + order.id,
        function (items) {
          $("#item-count-" + order.id).text(
            items.length + " item" + (items.length !== 1 ? "s" : ""),
          );

          var itemsHtml = "";
          items.forEach(function (item) {
            itemsHtml += '<div class="order-item-row">';
            itemsHtml +=
              '<img src="' +
              (item.product_image || "assets/img/placeholder.jpg") +
              '" alt="' +
              item.product_name +
              '">';
            itemsHtml +=
              '<div class="order-item-name">' + item.product_name + "</div>";
            itemsHtml += '<div class="order-item-qty">x' + item.qty + "</div>";
            itemsHtml +=
              '<div class="order-item-price">' +
              formatRp(item.price_at_order) +
              "</div>";
            itemsHtml += "</div>";
          });
          $("#items-container-" + order.id).html(itemsHtml);
        },
      );
    });
  });
}

function toggleDetail(orderId) {
  var detail = $("#detail-" + orderId);
  detail.toggleClass("open");
  var $card = detail.closest(".order-card");
  var btn = $card.find(".btn-view-detail");
  btn.text(detail.hasClass("open") ? "Sembunyikan Detail" : "Lihat Detail");
}

$(document).ready(function () {
  loadOrders("all");

  $(".filter-tab").click(function () {
    $(".filter-tab").removeClass("active");
    $(this).addClass("active");
    loadOrders($(this).data("status"));
  });
});
