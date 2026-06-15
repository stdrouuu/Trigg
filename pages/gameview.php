<link rel="stylesheet" href="./assets/css/gameview-style.css?v=<?= time(); ?>">


    <a href="product" class="back-button">
        <i class="fas fa-arrow-left"></i>
        <span>Back</span>
    </a>

<div class="product-card">
    <div class="product-gallery">
        <div class="main-image">
            <img src="" alt="Product Image" id="mainProductImage">
        </div>
    </div>

    <div class="product-details">
        <p class="product-brand" id="productBrand">Product Brand</p>
        <h1 class="product-title" id="productTitle">Product Title</h1>

        <div class="price-section">
            <p class="current-price" id="productPrice">Rp -</p>
        </div>

        <hr>
            <p class="description" id="description">-</p>
            <div class="action-row" style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                <button class="add-to-cart" id="addToCart" onclick="addToCart();">ADD TO CART</button>
                <a href="#" class="btn-fav-gameview" onclick="toggleFavorite(); return false;"><i class="fa-regular fa-heart" id="favIcon"></i></a>
            </div>
        <hr>

        <div class="metadata">
            <p><strong>SKU:</strong> <span class="sku" id="sku">-</span></p>
            <p><strong>CATEGORIES:</strong> <span class="category" id="category">-</span></p>
            <p><strong>TAGS:</strong> <span class="tags" id="tags">-</span></p>
        </div>
    </div>
</div>

<div id="notifContainer"></div>

<script>
    window.gameviewId = <?= isset($_GET['id']) ? (int)$_GET['id'] : 0 ?>;
</script>
<script src="assets/js/gameview.js"></script>

