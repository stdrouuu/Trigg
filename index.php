<?php session_start(); ?>
<?php include('components/head.php'); ?>

<body>
        <?php
            $page = 'main'; 
            $content = "pages/main.php"; 

            // cek path info
            if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] !== '') {
                // hapus slash 
                $path = trim($_SERVER['PATH_INFO'], '/');
                $parts = explode('/', $path);

                // route product 
                // ex: /product/10 
                // part 0 = product
                // part 1 = 10 (id)
                if (isset($parts[0]) && $parts[0] !== '') {
                    if ($parts[0] === 'product' && isset($parts[1])) {
                        $page = 'gameview';
                        $_GET['id'] = $parts[1];

                    // route admin
                    } elseif ($parts[0] === 'admin') {
                        if (isset($parts[1]) && $parts[1] === 'dashboard') {
                            $page = 'admin-dashboard';
                        } else {
                            $page = 'admin-login';
                        }

                    } else {
                        $page = $parts[0];
                    }
                }
            } elseif (isset($_GET['page'])) {
                $page = $_GET['page'];
            }

            if ($page !== '') {

                switch($page){
                    case "main": 
                        $content = "pages/main.php"; 
                        break;

                    case "auth": 
                        $content = "pages/public-login.php"; 
                        break;

                    case "product": 
                        $content = "pages/product.php"; 
                        break;

                    case "user": 
                        $content = "pages/user.php"; 
                        break; 

                    case "gameview": 
                        $content = "pages/gameview.php"; 
                        break;

                    case "credits": 
                        $content = "pages/credits.php"; 
                        break;

                    case "favorites":
                        $content = "pages/favorites.php";
                        break;
                    case "faq":
                        $content = "pages/faq.php";
                        break;

                    case "orders":
                        $content = "pages/orders.php";
                        break;

                    case "complaint":
                        $content = "pages/complaint.php";
                        break;

                    case "checkout":
                        $content = "pages/checkout.php";
                        break;

                    case "admin-login":
                        $content = "administrator/pages/login.php";
                        break;

                    case "admin-dashboard":
                        $content = "administrator/pages/dashboard.php";
                        break;

                    default:
                        $content = "pages/main.php";
                }
            }
        ?>

        <?php
        if ($page != 'user' && $page != 'auth' && $page != 'credits' && $page != 'favorites' && $page != 'orders' && $page != 'checkout' && $page != 'admin-login' && $page != 'admin-dashboard') {
            include('components/navbar.php');
        }
        ?>

        <section>
            <?php 
                include($content);
            ?>
        </section>

        <?php 
        if ($page != 'auth' && $page != 'user' && $page != 'gameview' && $page != 'orders' && $page != 'admin-login' && $page != 'admin-dashboard') {
            include('components/footer.php');
        }
        ?>

</body>
</html>