<?php
    if (App::$title == '') {
        App::$menuHelper->print_page_title(App::$page, true);
        include('versek-lista.php');
    } else if (App::$title == 'osszes') {
        $path = "content/vers/".App::$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-vers.php');
            
            echo '<article id="'.App::$title.'">';
            {
                include($path);
                include('content/partials/vissza-vers.php');
            }
            echo '</article>';
        }
    } else {
        $path = "content/vers/".App::$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-vers.php');
            
            echo '<article id="'.App::$title.'" class="poem">';
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