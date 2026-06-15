<link rel="stylesheet" href="./assets/css/orders-style.css?v=<?= time(); ?>" />

    <a href="user" class="back-button">
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
    </a>

<div class="orders-page">
    <h1 class="orders-page-title">Pesanan Saya</h1>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <div class="filter-tab active" data-status="all">Semua</div>
        <div class="filter-tab" data-status="pending">Pending</div>
        <div class="filter-tab" data-status="processing">Diproses</div>
        <div class="filter-tab" data-status="shipped">Dikirim</div>
        <div class="filter-tab" data-status="delivered">Terkirim</div>
    </div>

    <!-- Order List -->
    <div class="orders-list" id="ordersList">
        <!-- Skeleton Loaders -->
        <div class="skeleton-card" id="skeletonLoader">
            <div class="skeleton-line" style="width:40%"></div>
            <div class="skeleton-line" style="width:80%"></div>
            <div class="skeleton-line" style="width:60%"></div>
        </div>
    </div>
</div>

<script src="assets/js/orders.js"></script>

