<?php
// Cek session admin, if not redirect to login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] != true) {
    $base_dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
    header('Location: ' . $base_dir . 'admin');
    exit;
}
?>
<script>document.title = "Admin Dashboard | GamInc.";</script>
<link href="assets/css/admin-dashboard.css" rel="stylesheet" />


    <!-- Admin Layout: Sidebar + Content -->
    <div class="admin-layout">

        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <i class="fa-solid fa-shapes"></i>
                <span>Gam<span style="font-weight: 900; color: #A0C4FF;">i</span><span style="font-weight: 900; color: #BDB2FF;">n</span><span style="font-weight: 900; color: #E8AEFF;">c</span> <span class="sidebar-brand-sub">@admin</span></span>
            </div>

            <nav class="sidebar-nav">
                <p class="sidebar-nav-label">Management</p>
                <button class="sidebar-nav-item active" data-tab="products">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </button>
                <button class="sidebar-nav-item" data-tab="orders">
                    <i class="fas fa-receipt"></i>
                    <span>Orders</span>
                    <span class="sidebar-badge" id="pendingOrdersBadge"></span>
                </button>
                <button class="sidebar-nav-item" data-tab="complaints">
                    <i class="fas fa-headset"></i>
                    <span>Complaints</span>
                    <span class="sidebar-badge" id="openComplaintsBadge"></span>
                </button>
            </nav>

            <div class="sidebar-footer">
                <a href="../../main" class="sidebar-footer-link">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Site</span>
                </a>
                <button class="sidebar-footer-logout" id="logoutBtn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-main-header">
                <div>
                    <h1 class="admin-main-title" id="mainTitle">
                        Products
                    </h1>
                    <p class="admin-main-sub">Manage your store data below</p>
                </div>
            </div>

            <!-- PANEL PRODUCTS -->
            <div class="tab-panel active" id="panel-products">
                <div class="panel-header-actions">
                    <button class="btn-add" id="btnAddProduct">
                        <i class="fas fa-plus"></i> Add New Product
                    </button>
                </div>
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

            <!-- PANEL ORDERS -->
            <div class="tab-panel" id="panel-orders">
                <div class="table-container">
                    <table class="product-table" id="ordersTable">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>First Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Order Notes</th>
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

            <!-- PANEL COMPLAINTS -->
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

        </main>
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

    <script src="assets/js/admin-dashboard.js"></script>