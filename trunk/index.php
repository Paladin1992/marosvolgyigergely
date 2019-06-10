<?php
    $page = (isset($_GET['page']) ? $_GET['page'] : 'fooldal');

    include_once("config.php");
    include_once("connect.php");
    include_once("helpers/menu_helper.php");
    include_once("helpers/html_helper.php");
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <?php
        set_base_url();
        insert_page_title($page);
    ?>

    <meta charset="utf-8"/>
    <meta keywords="Marosvölgyi Gergely, vers, versek, novella, novellák"/>
    <meta description="Marosvölgyi Gergely hivatalos oldala. Versek, novellák"/>
    <meta name="author" content="MaGe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/site.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container <?=bs_col(12, 12, 12, 12, true);?>">
        <div class="header-container">
            <header>
                <div class="name-title">
                    Marosvölgyi Gergely
                </div>

                <button id="btn-menu" type="button">
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
            </header>

            <?php
                include("menu.php");

                if ($page == 'versek' || $page == 'novellak') {
                    include("submenu.php");
                }
            ?>
        </div>
        
        <main>
            <?php
                $file_path = "content/".$page.".php";

                if (file_exists($file_path)) {
                    print_page_title($page, true);
                    include($file_path);
                }
            ?>
        </main>

        <?php include('footer.php'); ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

<?php include_once("disconnect.php"); ?>