// Load data produk ke tabel
function loadProducts() {
  $.ajax({
    url: "administrator/api/admin_products.php?action=getAll",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      data.forEach(function (product) {
        // Format nama class label
        var labelClass = "label-" + product.label.replace(" ", "");

        html += "<tr>";
        html += "<td>" + product.id + "</td>";
        html +=
          '<td><img src="' +
          product.image +
          '" alt="' +
          product.name +
          '"></td>';
        html += "<td>" + product.name + "</td>";
        html +=
          "<td>Rp " + parseInt(product.price).toLocaleString("id-ID") + "</td>";
        html +=
          '<td><span class="label-badge ' +
          labelClass +
          '">' +
          product.label +
          "</span></td>";
        html += "<td>";
        html +=
          '<button class="btn-edit" onclick="editProduct(' +
          product.id +
          ')"><i class="fas fa-edit"></i></button>';
        html +=
          '<button class="btn-delete" onclick="showDeleteModal(' +
          product.id +
          ')"><i class="fas fa-trash"></i></button>';
        html += "</td>";
        html += "</tr>";
      });
      $("#productTableBody").html(html);
    },
  });
}

// Buka modal tambah produk
$("#btnAddProduct").click(function () {
  $("#modalTitle").text("Add Product");
  $("#productId").val("");
  $("#productName").val("");
  $("#productPrice").val("");
  $("#productLabel").val("PLAYSTATION");
  $("#productDescription").val("");
  $("#productImage").val("");
  $("#imagePreview").hide();
  var modal = new bootstrap.Modal(document.getElementById("productModal"));
  modal.show();
});

// Preview gambar
$("#productImage").change(function () {
  var file = this.files[0];
  if (file) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#imagePreview").attr("src", e.target.result).show();
    };
    reader.readAsDataURL(file);
  }
});

// Simpan data produk (Tambah/Update)
$("#btnSaveProduct").click(function () {
  var id = $("#productId").val();
  var formData = new FormData();

  formData.append("name", $("#productName").val());
  formData.append("price", $("#productPrice").val());
  formData.append("label", $("#productLabel").val());
  formData.append("description", $("#productDescription").val());

  var imageFile = $("#productImage")[0].files[0];
  if (imageFile) {
    formData.append("image", imageFile);
  }

  if (id) {
    formData.append("action", "updateProduct");
    formData.append("id", id);
  } else {
    formData.append("action", "addProduct");
  }

  $.ajax({
    url: "administrator/api/admin_products.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      if (response.success) {
        bootstrap.Modal.getInstance(
          document.getElementById("productModal"),
        ).hide();
        loadProducts();
        alert(response.message);
      } else {
        alert(response.message);
      }
    },
  });
});

// Edit produk - load data ke modal
function editProduct(id) {
  $.ajax({
    url: "api/products.php?action=getOne&id=" + id,
    type: "GET",
    dataType: "json",
    success: function (product) {
      $("#modalTitle").text("Edit Product");
      $("#productId").val(product.id);
      $("#productName").val(product.name);
      $("#productPrice").val(product.price);
      $("#productLabel").val(product.label);
      $("#productDescription").val(product.description);
      $("#productImage").val("");

      if (product.image) {
        $("#imagePreview").attr("src", product.image).show();
      } else {
        $("#imagePreview").hide();
      }

      var modal = new bootstrap.Modal(document.getElementById("productModal"));
      modal.show();
    },
  });
}

// Tampilkan modal konfirmasi hapus
function showDeleteModal(id) {
  $("#deleteProductId").val(id);
  var modal = new bootstrap.Modal(document.getElementById("deleteModal"));
  modal.show();
}

// Konfirmasi hapus produk
$("#btnConfirmDelete").click(function () {
  var id = $("#deleteProductId").val();

  $.ajax({
    url: "administrator/api/admin_products.php",
    type: "POST",
    data: { action: "deleteProduct", id: id },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        bootstrap.Modal.getInstance(
          document.getElementById("deleteModal"),
        ).hide();
        loadProducts();
        alert(response.message);
      }
    },
  });
});

$("#logoutBtn").click(function () {
  $.ajax({
    url: "administrator/api/admin_auth.php",
    type: "POST",
    data: { action: "logout" },
    dataType: "json",
    success: function () {
      window.location.href = "admin";
    },
  });
});

// TAB SWITCHING
var tabTitles = {
  products: "Products",
  orders: "Orders",
  complaints: "Complaints",
};

$(document).ready(function () {
  loadProducts();
  loadBadgeCounts();

  $(".sidebar-nav-item").click(function () {
    var tab = $(this).data("tab");
    $(".sidebar-nav-item").removeClass("active");
    $(this).addClass("active");
    $(".tab-panel").removeClass("active");
    $("#panel-" + tab).addClass("active");
    $("#mainTitle").text(tabTitles[tab] || tab);

    if (tab === "orders") loadOrders();
    if (tab === "complaints") loadComplaints();
  });

  // Toggle full complaint message on click
  $(document).on("click", ".complaint-msg-cell", function () {
    var full = decodeURIComponent($(this).data("full"));
    var short = decodeURIComponent($(this).data("short"));
    if ($(this).hasClass("expanded")) {
      $(this).removeClass("expanded");
      $(this).html(
        short +
          ' <i class="fas fa-chevron-down text-muted" style="font-size:0.75rem;margin-left:4px;"></i>',
      );
      $(this).attr("title", "Klik untuk membaca selengkapnya");
    } else {
      $(this).addClass("expanded");
      $(this).html(
        full +
          ' <i class="fas fa-chevron-up text-muted" style="font-size:0.75rem;margin-left:4px;"></i>',
      );
      $(this).attr("title", "Klik untuk memperkecil");
    }
  });
});

// Load tab badge counts
function loadBadgeCounts() {
  $.getJSON(
    "administrator/api/admin_orders.php?action=getAllOrders",
    function (orders) {
      var pending = orders.filter(function (o) {
        return o.status === "pending";
      }).length;
      if (pending > 0) {
        $("#pendingOrdersBadge").text(pending).show();
      }
    },
  );
  $.getJSON(
    "administrator/api/admin_orders.php?action=getAllComplaints",
    function (complaints) {
      var open = complaints.filter(function (c) {
        return c.status === "open";
      }).length;
      if (open > 0) {
        $("#openComplaintsBadge").text(open).show();
      }
    },
  );
}

// ORDERS
var ordersLoaded = false;
function loadOrders() {
  if (ordersLoaded) return;
  ordersLoaded = true;

  $.getJSON(
    "administrator/api/admin_orders.php?action=getAllOrders",
    function (orders) {
      if (orders.length === 0) {
        $("#ordersTableBody").html(
          '<tr><td colspan="11" style="text-align:center;color:#a1a1aa;padding:40px">No orders yet.</td></tr>',
        );
        return;
      }
      var html = "";
      orders.forEach(function (order) {
        var d = new Date(order.created_at);
        var dateStr = d.toLocaleDateString("id-ID", {
          day: "2-digit",
          month: "short",
          year: "numeric",
        });
        html += "<tr>";
        html += "<td>#" + order.id + "</td>";
        html += "<td>" + dateStr + "</td>";
        html += "<td>" + (order.first_name || "-") + "</td>";
        html += "<td>" + (order.address || "-") + "</td>";
        html += "<td>" + (order.phone || "-") + "</td>";
        html += "<td>" + (order.email || "-") + "</td>";
        html += "<td>" + (order.order_notes || "-") + "</td>";
        html += "<td>" + (order.items_summary || "-") + "</td>";
        html +=
          "<td>Rp " +
          parseInt(order.total_price).toLocaleString("id-ID") +
          "</td>";
        html +=
          '<td><span class="status-badge status-' +
          order.status +
          '" style="padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;">' +
          order.status.charAt(0).toUpperCase() +
          order.status.slice(1) +
          "</span></td>";
        html += "<td>";
        html +=
          '<select class="order-status-select" data-id="' + order.id + '">';
        ["pending", "processing", "shipped", "delivered"].forEach(function (s) {
          html +=
            '<option value="' +
            s +
            '"' +
            (order.status === s ? " selected" : "") +
            ">" +
            s.charAt(0).toUpperCase() +
            s.slice(1) +
            "</option>";
        });
        html += "</select>";
        html += "</td>";
        html += "</tr>";
      });
      $("#ordersTableBody").html(html);

      // Update status pesanan saat opsi diubah
      $(document).on("change", ".order-status-select", function () {
        var id = $(this).data("id");
        var status = $(this).val();
        var $row = $(this).closest("tr");

        $.ajax({
          url: "administrator/api/admin_orders.php",
          type: "POST",
          data: { action: "updateOrderStatus", order_id: id, status: status },
          dataType: "json",
          success: function (resp) {
            if (resp.success) {
              // Update badge status di baris tabel
              $row
                .find(".status-badge")
                .attr("class", "status-badge status-" + status)
                .text(status.charAt(0).toUpperCase() + status.slice(1));
            }
          },
        });
      });
    },
  );
}

var complaintsLoaded = false;
function loadComplaints() {
  if (complaintsLoaded) return;
  complaintsLoaded = true;

  $.getJSON(
    "administrator/api/admin_orders.php?action=getAllComplaints",
    function (complaints) {
      if (complaints.length === 0) {
        $("#complaintsTableBody").html(
          '<tr><td colspan="7" style="text-align:center;color:#a1a1aa;padding:40px">No complaints yet.</td></tr>',
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
        var shortMsg =
          c.message.length > 60
            ? c.message.substring(0, 60) + "..."
            : c.message;
        html += "<tr>";
        html += "<td>#" + c.id + "</td>";
        html += "<td>" + dateStr + "</td>";
        html += "<td>" + c.category + "</td>";
        html += "<td>" + (c.order_id ? "#" + c.order_id : "—") + "</td>";
        if (c.message.length > 60) {
          html +=
            '<td class="complaint-msg-cell" data-full="' +
            encodeURIComponent(c.message) +
            '" data-short="' +
            encodeURIComponent(shortMsg) +
            '" style="cursor:pointer; max-width: 320px; word-break: break-word;" title="Klik untuk membaca selengkapnya">' +
            shortMsg +
            ' <i class="fas fa-chevron-down text-muted" style="font-size:0.75rem;margin-left:4px;"></i></td>';
        } else {
          html +=
            '<td style="max-width: 320px; word-break: break-word;">' +
            c.message +
            "</td>";
        }
        var displayStatus = c.status;
        if (c.status === "open") displayStatus = "menunggu";
        else if (c.status === "resolved") displayStatus = "sudah selesai";
        else displayStatus = c.status.replace("_", " ");

        html +=
          '<td><span class="complaint-status-badge complaint-status-' +
          c.status +
          '">' +
          displayStatus +
          "</span></td>";
        html += "<td>";
        if (c.status !== "resolved") {
          html +=
            '<button class="btn-resolve" onclick="resolveComplaint(' +
            c.id +
            ', this)"></i>Selesaikan</button>';
        } else {
          html +=
            '<span style="color:#a1a1aa;font-size:0.8rem">Sudah Selesai</span>';
        }
        html += "</td>";
        html += "</tr>";
      });
      $("#complaintsTableBody").html(html);
    },
  );
}

function resolveComplaint(id, btn) {
  $.ajax({
    url: "administrator/api/admin_orders.php",
    type: "POST",
    data: {
      action: "updateComplaintStatus",
      complaint_id: id,
      status: "resolved",
    },
    dataType: "json",
    success: function (resp) {
      if (resp.success) {
        var $row = $(btn).closest("tr");
        $row
          .find(".complaint-status-badge")
          .attr("class", "complaint-status-badge complaint-status-resolved")
          .text("sudah selesai");
        $(btn).replaceWith(
          '<span style="color:#a1a1aa;font-size:0.8rem">Sudah Selesai</span>',
        );
      }
    },
  });
}
