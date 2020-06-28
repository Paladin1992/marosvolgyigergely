<?php
    if ($title == '') {
        print_page_title($page, true);
        include('versek-lista.php');
    } else if ($title == 'osszes') {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-vers.php');
            
            echo '<article id="'.$title.'">';
            {
                include($path);
                include('content/partials/vissza-vers.php');
            }
            echo '</article>';
        }
    } else {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-vers.php');
            
            echo '<article id="'.$title.'" class="poem">';
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