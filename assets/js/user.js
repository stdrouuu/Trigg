$(document).ready(function () {
  // Ambil jumlah pesanan
  $.getJSON("api/orders.php?action=getOrderCounts", function (counts) {
    $("#cnt-pending").text(counts.pending || 0);
    $("#cnt-processing").text(counts.processing || 0);
    $("#cnt-shipped").text(counts.shipped || 0);
    $("#cnt-delivered").text(counts.delivered || 0);
  });

  // Ambil jumlah item di keranjang
  $.getJSON("api/cart.php?action=getCount", function (data) {
    var count = data.cartCount || 0;
    if (count > 0) {
      $("#cartItemCount").text(count);
    }
  });

  // Ambil data komplain
  $.getJSON(
    "api/complaints.php?action=getUserComplaints",
    function (complaints) {
      if (!complaints || complaints.length === 0) {
        $("#userComplaintsList").html(
          '<div style="padding: 20px 24px; text-align: center; color: var(--text-secondary); font-size: 0.9rem;">Belum ada komplain yang diajukan.</div>',
        );
        return;
      }
      var html = "";
      complaints.forEach(function (c) {
        var d = new Date(c.created_at);
        var dateStr = d.toLocaleDateString("id-ID", {
          day: "2-digit",
          month: "short",
          year: "numeric",
        });
        var statusLabel =
          c.status === "open"
            ? "Menunggu"
            : c.status === "in_review"
              ? "In Review"
              : "Sudah Selesai";

        html += '<div class="complaint-item">';
        html += '  <div class="complaint-meta">';
        html +=
          '    <span class="complaint-cat-id">' +
          c.category +
          (c.order_id ? " (Order #" + c.order_id + ")" : "") +
          "</span>";
        html += "    <span>" + dateStr + "</span>";
        html += "  </div>";
        html += '  <div class="complaint-text">' + c.message + "</div>";
        html += '  <div style="margin-top: 6px;">';
        html +=
          '    <span class="user-complaint-status-badge user-status-' +
          c.status +
          '">' +
          statusLabel +
          "</span>";
        html += "  </div>";
        html += "</div>";
      });
      $("#userComplaintsList").html(html);
    },
  );

  $("#logoutBtn").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "api/auth.php",
      type: "POST",
      data: { action: "logout" },
      dataType: "json",
      success: function () {
        window.location.href = "index.php";
      },
    });
  });
});