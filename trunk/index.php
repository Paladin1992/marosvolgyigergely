<?php
    include('app/config.php');

    App::$page = (isset($_GET['page']) ? $_GET['page'] : 'fooldal');
    App::$title = (isset($_GET['title']) ? $_GET['title'] : '');

    include('db/credentials.php');
    include('db/connect.php');
    include('helpers/menu_helper.php');
    include('helpers/html_helper.php');
    include('helpers/sql_helper.php');

    if (App::$page == 'versek' || App::$page == 'novellak') {
        App::$writing_info = App::$sqlHelper->get_writing_info(App::$title);
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <base href="<?php echo App::HTML_BASE_URL; ?>">

    <?php
        App::$menuHelper->insert_page_title();
    ?>

    <meta charset="utf-8"/>
    <meta keywords="<?php echo HtmlHelper::get_meta_keywords(); ?>"/>
    <meta description="<?php echo HtmlHelper::get_meta_description(); ?>"/>
    <meta name="author" content="Marosvölgyi Gergely">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo HtmlHelper::get_versioned_link('css/site.css'); ?>">

    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <header>
                <?php
                    if (App::$page == 'fooldal') {
                        echo '<h1 class="name-title">'.App::AUTHOR.'</h1>';
                    } else {
                        echo '<div class="name-title">'.App::AUTHOR.'</div>';
                    }
                ?>

                <button id="btn-menu" type="button">
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
            </header>

            <?php include("app/menu.php"); ?>
        </div>
        
        <div class="header-placeholder">
            <div class="name-title"><?=App::AUTHOR?></div>
        </div>

        <main>
            <?php
                $file_path = "content/".App::$page.".php";

                if (file_exists($file_path)) {
                    App::$menuHelper->print_page_title(App::$page, true, ['fooldal', 'versek', 'novellak']);
                    include($file_path);
                }
            ?>
        </main>

        <?php include('app/footer.php'); ?>
    </div>

    <script>
        const app = {
            ACCORDION_SLIDE_SPEED_MS: 500,
            SCREEN_WIDTH_XS: 768,
            OFFSET_Y_XS: 60,
            OFFSET_Y_LG: 150,
            SCROLL_TIME_MS: 500,
            LOAD_WRITINGS_MAX_COUNT: 10,

            totalWritingsCount: <?php
                if (App::$page == 'versek' || App::$page == 'novellak') {
                    $storedProcedureName = App::$page == 'versek' ? 'GetAllPoemsCount' : 'GetAllShortStoriesCount';
                    $query = "CALL `$storedProcedureName`();";
                    $rows = App::$sqlHelper->get_records($query);

                    if (count($rows) > 0) {
                        echo $rows[0]['WritingsCount'];
                    } else {
                        echo '0';
                    }
                } else {
                    echo '0';
                }
            ?>,
            loadedWritingsCount: 0,
        };

        const title = '<?php echo App::$title; ?>';
        const page = '<?php echo App::$page; ?>';
    </script>
    <script src="<?php echo HtmlHelper::get_versioned_link('js/app/common.js')?>"></script>
    <?php
        if (App::$page == 'versek' || App::$page == 'novellak') {
            if (App::$title == 'osszes') {
                echo '<script src="'.HtmlHelper::get_versioned_link('js/app/osszes.js').'"></script>';
            } else if (App::$title == '') {
                echo '<script src="'.HtmlHelper::get_versioned_link('js/app/lista.js').'"></script>';
            }
        }
    ?>
</body>
</html>

<?php include("db/disconnect.php"); ?>