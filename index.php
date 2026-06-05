<?php session_start(); ?>
<?php include('components/head.php'); ?>

<body>
        <?php
            $page = 'auth'; 
            $content = "pages/auth.php"; 

            if(isset($_GET['page'])){
                $page = $_GET['page'];

                switch($page){
                    case "main": 
                        $content = "pages/main.php"; 
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

                    default:
                        $content = "pages/main.php";
                }
            }
        ?>

        <?php
        if ($page != 'user' && $page != 'auth' && $page != 'credits' && $page != 'gameview' && $page != 'favorites' && $page != 'faq') {
            include('components/navbar.php');
        }
        ?>

        <section>
            <?php 
                include($content);
            ?>
        </section>

        <?php 
        if ($page != 'auth' && $page != 'user' && $page != 'gameview' && $page != 'credits' && $page != 'favorites' && $page != 'complaint' && $page != 'faq') {
            include('components/footer.php');
        }
        ?>

</body>
</html>