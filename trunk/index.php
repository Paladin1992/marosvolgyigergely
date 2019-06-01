<?php
    $page = (isset($_GET['page']) ? $_GET['page'] : 'fooldal');

    include_once("config.php");
    include_once("connect.php");
    include_once("helpers.php");
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <?php insert_page_title($page); ?>

    <meta charset="utf-8"/>
    <meta keywords="Marosvölgyi Gergely, vers, versek, novella, novellák"/>
    <meta description="Marosvölgyi Gergely hivatalos oldala. Versek, novellák"/>
    <meta name="author" content="MaGe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        // icon
        link_file('icon', 'images/favicon.png');

        // CSS
        link_file('css', 'css/bootstrap.min.css');
        link_file('css', 'css/font-awesome.min.css');
        link_file('css', 'css/site.css');

        // JavaScript
        link_file('js', 'js/jquery.min.js');
        link_file('js', 'js/bootstrap.min.js');
    ?>
</head>
<body>
    <div class="container <?=bs_col(12, 12, 12, 12, true);?>">
        <header>
            <div class="name-title">
                Marosvölgyi Gergely
            </div>
        </header>

        <?php include("menu.php"); ?>
        
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

    <?php link_file('js', 'js/script.js'); ?>
</body>
</html>

<?php include_once("disconnect.php"); ?>