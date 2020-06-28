<?php
    $page = (isset($_GET['page']) ? $_GET['page'] : 'fooldal');
    $title = (isset($_GET['title']) ? $_GET['title'] : '');

    include('app/config.php');
    include('db/credentials.php');
    include('db/connect.php');
    include('helpers/menu_helper.php');
    include('helpers/html_helper.php');
    include('helpers/sql_helper.php');

    if ($page == 'versek' || $page == 'novellak') {
        $writing_info = get_writing_info($title);
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <?php
        set_base_url();
        insert_page_title($page, $title);
    ?>

    <meta charset="utf-8"/>
    <meta keywords="<?=get_meta_keywords($page, $title);?>"/>
    <meta description="<?=get_meta_description($page, $title);?>"/>
    <meta name="author" content="MaGe">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_versioned_link('css/site.css'); ?>">

    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <header>
                <?php
                    if ($page == 'fooldal') {
                        echo '<h1 class="name-title">'.$_MAGE.'</h1>';
                    } else {
                        echo '<div class="name-title">'.$_MAGE.'</div>';
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
            <div class="name-title"><?=$_MAGE?></div>
        </div>

        <main>
            <?php
                $file_path = "content/".$page.".php";

                if (file_exists($file_path)) {
                    print_page_title($page, true, ['fooldal', 'versek', 'novellak']);
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
                if ($page == 'versek' || $page == 'novellak') {
                    $storedProcedureName = $page == 'versek' ? 'GetAllPoemsCount' : 'GetAllShortStoriesCount';
                    $query = "CALL `$storedProcedureName`();";
                    $rows = get_records($query);

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

        const title = '<?php echo $title; ?>';
        const page = '<?php echo $page; ?>';
    </script>
    <script src="<?php echo get_versioned_link('js/app/common.js')?>"></script>
    <?php
        if ($page == 'versek' || $page == 'novellak') {
            if ($title == 'osszes') {
                echo '<script src="'.get_versioned_link('js/app/osszes.js').'"></script>';
            } else if ($title == '') {
                echo '<script src="'.get_versioned_link('js/app/lista.js').'"></script>';
            }
        }
    ?>
</body>
</html>

<?php include("db/disconnect.php"); ?>