<?php
    if ($title == '') {
        print_page_title($page, true);
        include('novellak-lista.php');
    } else if ($title == 'osszes') {
        $path = "content/novella/".$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-novella.php');
            
            echo '<article id="'.$title.'">';
            {
                include($path);
                include('content/partials/vissza-novella.php');
            }
            echo '</article>';
        }
    } else {
        $path = "content/novella/".$title.".php";
        
        if (file_exists($path)) {
            include('content/partials/vissza-novella.php');
            
            echo '<article id="'.$title.'" class="short-story">';
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