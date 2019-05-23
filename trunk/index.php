<?php
    include_once("connect.php");
    include_once("helpers.php");
    $page = (isset($_GET['p']) ? $_GET['p'] : 'fooldal');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <title><?=print_page_title($page);?> &bull; Marosvölgyi Gergely hivatalos oldala</title>

    <meta charset="utf-8"/>
    <meta keywords="Marosvölgyi Gergely, vers, versek, novella, novellák"/>
    <meta description="Marosvölgyi Gergely hivatalos oldala. Versek, novellák"/>
    <meta name="author" content="MaGe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/site.css">
    <!-- <link rel="shortcut icon" href="images/favicon.png"> -->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container <?=bs_col(12, 12, 12, 12, true);?>">
        <header>
            <div class="name-title">
                Marosvölgyi Gergely
            </div>
        </header>

        <?php
            include("menu.php");
        ?>
        
        <main>
            <?php
                $file_path = "content/".$page.".php";

                if (file_exists($file_path)) {
                    print_page_title($page, true);
                    include($file_path);
                } else {
                    header("Location: fooldal");
                }
            ?>
        </main>

        <footer>
            <?php
                $startYear = 2019;
                $currentYear = date("Y");
                echo '&copy;'.$startYear.($currentYear > $startYear ? '-'.$currentYear : '').' Marosvölgyi Gergely &ndash; Minden jog fenntartva!<br>';
            ?>
        </footer>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

<?php
    include_once("disconnect.php");
?>