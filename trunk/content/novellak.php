<?php
    if (App::$title == '') {
        App::$menuHelper->print_page_title(App::$page, true);
        include('novellak-lista.php');
    } else if (App::$title == 'osszes') {
        $path = "content/novella/".App::$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-novella.php');
            
            echo '<article id="'.App::$title.'">';
            {
                include($path);
                include('content/partials/vissza-novella.php');
            }
            echo '</article>';
        }
    } else {
        $path = "content/novella/".App::$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-novella.php');
            
            echo '<article id="'.App::$title.'" class="short-story">';
            {
                include($path);
                include('content/partials/keletkezes.php');
                include('content/partials/warning.php');
            }
            echo '</article>';
            
            include('app/pagination.php');
        }
    }
?>