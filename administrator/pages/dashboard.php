<?php
session_start();

// Check if admin is logged in, if not redirect to login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard | GamInc.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../assets/css/admin-dashboard.css?v=<?= time(); ?>" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <!-- Admin Navbar -->
    <div class="admin-navbar">
        <div class="logo">
            <i class="fa-solid fa-puzzle-piece"></i>
            GamInc <span style="color: rgba(159, 159, 159, 1);">@admin</span>
        </div>
        <div class="admin-info">
            <a href="../../main" class="back-to-site">
                <i class="fas fa-external-link-alt"></i> View Site
            </a>
            <span>Hello, @admin</span>
            <button class="btn-logout" id="logoutBtn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <h1 class="page-title">Admin Dashboard</h1>

        <!-- ═══ TAB: PRODUCTS ═══════════════════════════ -->
        <div class="tab-panel active" id="panel-products">
            <button class="btn-add" id="btnAddProduct">
                <i class="fas fa-plus"></i> Add New Product
            </button>
            <div class="table-container">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Label</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <!-- Products loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ═══ TAB: ORDERS ════════════════════════════ -->
        <div class="tab-panel" id="panel-orders">
            <div class="table-container">
                <table class="product-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody id="ordersTableBody">
                        <!-- Orders loaded via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ═══ TAB: COMPLAINTS ════════════════════════ -->
        <div class="tab-panel" id="panel-complaints">
            <div class="table-container">
                <table class="product-table" id="complaintsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Order ID</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="complaintsTableBody">
                        <!-- Complaints loaded via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Add/Edit Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="productId" />

                    <label>Product Name</label>
                    <input type="text" id="productName" placeholder="Enter product name" />

                    <label>Price (Rp)</label>
                    <input type="number" id="productPrice" placeholder="Enter price" />

                    <label>Label</label>
                    <select id="productLabel">
                        <option value="PLAYSTATION">PLAYSTATION</option>
                        <option value="SWITCH 2">SWITCH 2</option>
                        <option value="OTHER">OTHER</option>
                    </select>

                    <label>Description</label>
                    <textarea id="productDescription" placeholder="Enter product description"></textarea>

                    <label>Product Image</label>
                    <input type="file" id="productImage" accept="image/*" />
                    <img id="imagePreview" class="preview-img" style="display:none;" />
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn-save" id="btnSaveProduct">Save Product</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <input type="hidden" id="deleteProductId" />
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn-delete" id="btnConfirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load products into table
        function loadProducts() {
            $.ajax({
                url: '../api/admin_products.php?action=getAll',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    data.forEach(function(product) {
                        // Format label class name
                        var labelClass = 'label-' + product.label.replace(' ', '');

                        html += '<tr>';
                        html += '<td>' + product.id + '</td>';
                        html += '<td><img src="../../' + product.image + '" alt="' + product.name + '"></td>';
                        html += '<td>' + product.name + '</td>';
                        html += '<td>Rp ' + parseInt(product.price).toLocaleString('id-ID') + '</td>';
                        html += '<td><span class="label-badge ' + labelClass + '">' + product.label + '</span></td>';
                        html += '<td>';
                        html += '<button class="btn-edit" onclick="editProduct(' + product.id + ')"><i class="fas fa-edit"></i> Edit</button>';
                        html += '<button class="btn-delete" onclick="showDeleteModal(' + product.id + ')"><i class="fas fa-trash"></i> Delete</button>';
                        html += '</td>';
                        html += '</tr>';
                    });
                    $('#productTableBody').html(html);
                }
            });
        }

        // Open Add Product Modal
        $('#btnAddProduct').click(function() {
            $('#modalTitle').text('Add Product');
            $('#productId').val('');
            $('#productName').val('');
            $('#productPrice').val('');
            $('#productLabel').val('PLAYSTATION');
            $('#productDescription').val('');
            $('#productImage').val('');
            $('#imagePreview').hide();
            var modal = new bootstrap.Modal(document.getElementById('productModal'));
            modal.show();
        });

        // Image preview
        $('#productImage').change(function() {
            var file = this.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        });

        // Save Product (Add or Update)
        $('#btnSaveProduct').click(function() {
            var id = $('#productId').val();
            var formData = new FormData();

            formData.append('name', $('#productName').val());
            formData.append('price', $('#productPrice').val());
            formData.append('label', $('#productLabel').val());
            formData.append('description', $('#productDescription').val());

            // Add image if selected
            var imageFile = $('#productImage')[0].files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            // Decide if add or update
            if (id) {
                formData.append('action', 'updateProduct');
                formData.append('id', id);
            } else {
                formData.append('action', 'addProduct');
            }

            $.ajax({
                url: '../api/admin_products.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        bootstrap.Modal.getInstance(document.getElementById('productModal')).hide();
                        loadProducts();
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

        // Edit product - load data into modal
        function editProduct(id) {
            $.ajax({
                url: '../../api/products.php?action=getOne&id=' + id,
                type: 'GET',
                dataType: 'json',
                success: function(product) {
                    $('#modalTitle').text('Edit Product');
                    $('#productId').val(product.id);
                    $('#productName').val(product.name);
                    $('#productPrice').val(product.price);
                    $('#productLabel').val(product.label);
                    $('#productDescription').val(product.description);
                    $('#productImage').val('');

                    if (product.image) {
                        $('#imagePreview').attr('src', '../../' + product.image).show();
                    } else {
                        $('#imagePreview').hide();
                    }

                    var modal = new bootstrap.Modal(document.getElementById('productModal'));
                    modal.show();
                }
            });
        }

        // Show delete confirmation modal
        function showDeleteModal(id) {
            $('#deleteProductId').val(id);
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Confirm delete
        $('#btnConfirmDelete').click(function() {
            var id = $('#deleteProductId').val();

            $.ajax({
                url: '../api/admin_products.php',
                type: 'POST',
                data: { action: 'deleteProduct', id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                        loadProducts();
                        alert(response.message);
                    }
                }
            });
        });

        // Logout
        $('#logoutBtn').click(function() {
            $.ajax({
                url: '../api/admin_auth.php',
                type: 'POST',
                data: { action: 'logout' },
                dataType: 'json',
                success: function() {
                    window.location.href = '../login.php';
                }
            });
        });

        // ─── TAB SWITCHING ─────────────────────────────
        $(document).ready(function() {
            loadProducts();
            loadBadgeCounts();

            $('.admin-tab').click(function() {
                var tab = $(this).data('tab');
                $('.admin-tab').removeClass('active');
                $(this).addClass('active');
                $('.tab-panel').removeClass('active');
                $('#panel-' + tab).addClass('active');

                if (tab === 'orders')     loadOrders();
                if (tab === 'complaints') loadComplaints();
            });
        });

        // Load tab badge counts
        function loadBadgeCounts() {
            $.getJSON('../api/admin_orders.php?action=getAllOrders', function(orders) {
                var pending = orders.filter(function(o) { return o.status === 'pending'; }).length;
                if (pending > 0) {
                    $('#pendingOrdersBadge').text(pending).show();
                }
            });
            $.getJSON('../api/admin_orders.php?action=getAllComplaints', function(complaints) {
                var open = complaints.filter(function(c) { return c.status === 'open'; }).length;
                if (open > 0) {
                    $('#openComplaintsBadge').text(open).show();
                }
            });
        }

        // ─── ORDERS ────────────────────────────────────
        var ordersLoaded = false;
        function loadOrders() {
            if (ordersLoaded) return;
            ordersLoaded = true;

            $.getJSON('../api/admin_orders.php?action=getAllOrders', function(orders) {
                if (orders.length === 0) {
                    $('#ordersTableBody').html('<tr><td colspan="6" style="text-align:center;color:#a1a1aa;padding:40px">No orders yet.</td></tr>');
                    return;
                }
                var html = '';
                orders.forEach(function(order) {
                    var d = new Date(order.created_at);
                    var dateStr = d.toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' });
                    html += '<tr>';
                    html += '<td>#' + order.id + '</td>';
                    html += '<td>' + dateStr + '</td>';
                    html += '<td>' + order.item_count + ' item(s)</td>';
                    html += '<td>Rp ' + parseInt(order.total_price).toLocaleString('id-ID') + '</td>';
                    html += '<td><span class="status-badge status-' + order.status + '" style="padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;">'
                          + order.status.charAt(0).toUpperCase() + order.status.slice(1) + '</span></td>';
                    html += '<td>';
                    html += '<select class="order-status-select" data-id="' + order.id + '">';
                    ['pending','processing','shipped','delivered'].forEach(function(s) {
                        html += '<option value="' + s + '"' + (order.status === s ? ' selected' : '') + '>'
                              + s.charAt(0).toUpperCase() + s.slice(1) + '</option>';
                    });
                    html += '</select>';
                    html += '</td>';
                    html += '</tr>';
                });
                $('#ordersTableBody').html(html);

                // Live status update on change
                $(document).on('change', '.order-status-select', function() {
                    var id     = $(this).data('id');
                    var status = $(this).val();
                    var $row   = $(this).closest('tr');

                    $.ajax({
                        url: '../api/admin_orders.php',
                        type: 'POST',
                        data: { action: 'updateOrderStatus', order_id: id, status: status },
                        dataType: 'json',
                        success: function(resp) {
                            if (resp.success) {
                                // Update status badge in same row
                                $row.find('.status-badge').attr('class', 'status-badge status-' + status)
                                    .text(status.charAt(0).toUpperCase() + status.slice(1));
                            }
                        }
                    });
                });
            });
        }

        // ─── COMPLAINTS ────────────────────────────────
        var complaintsLoaded = false;
        function loadComplaints() {
            if (complaintsLoaded) return;
            complaintsLoaded = true;

            $.getJSON('../api/admin_orders.php?action=getAllComplaints', function(complaints) {
                if (complaints.length === 0) {
                    $('#complaintsTableBody').html('<tr><td colspan="7" style="text-align:center;color:#a1a1aa;padding:40px">No complaints yet.</td></tr>');
                    return;
                }
                var html = '';
                complaints.forEach(function(c) {
                    var d = new Date(c.created_at);
                    var dateStr = d.toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' });
                    var shortMsg = c.message.length > 60 ? c.message.substring(0, 60) + '...' : c.message;
                    html += '<tr>';
                    html += '<td>#' + c.id + '</td>';
                    html += '<td>' + dateStr + '</td>';
                    html += '<td>' + c.category + '</td>';
                    html += '<td>' + (c.order_id ? '#' + c.order_id : '—') + '</td>';
                    html += '<td title="' + c.message.replace(/"/g, '&quot;') + '">' + shortMsg + '</td>';
                    html += '<td><span class="complaint-status-badge complaint-status-' + c.status + '">' + c.status.replace('_', ' ') + '</span></td>';
                    html += '<td>';
                    if (c.status !== 'resolved') {
                        html += '<button class="btn-resolve" onclick="resolveComplaint(' + c.id + ', this)">'
                              + '<i class="fas fa-check"></i> Resolve</button>';
                    } else {
                        html += '<span style="color:#a1a1aa;font-size:0.8rem">Resolved</span>';
                    }
                    html += '</td>';
                    html += '</tr>';
                });
                $('#complaintsTableBody').html(html);
            });
        }

        function resolveComplaint(id, btn) {
            $.ajax({
                url: '../api/admin_orders.php',
                type: 'POST',
                data: { action: 'updateComplaintStatus', complaint_id: id, status: 'resolved' },
                dataType: 'json',
                success: function(resp) {
                    if (resp.success) {
                        var $row = $(btn).closest('tr');
                        $row.find('.complaint-status-badge').attr('class', 'complaint-status-badge complaint-status-resolved').text('resolved');
                        $(btn).replaceWith('<span style="color:#a1a1aa;font-size:0.8rem">Resolved</span>');
                    }
                }
            });
        }

    </script>

</body>
</html>