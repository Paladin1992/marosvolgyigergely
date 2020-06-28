<?php
    if ($title == '') {
        print_page_title($page, true);
        include('novellak-lista.php');
    } else if ($title == 'osszes') {
        $path = "content/novella/".$title.".php";
        
        if (file_exists($path)) {
            action_link('novellak', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a novellákhoz', '', 'nav-link back', 'Vissza a novellákhoz');
            
            echo '<article id="'.$title.'">';
            {
                include($path);
                action_link('novellak', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a novellákhoz', '', 'nav-link back', 'Vissza a novellákhoz');
            }
            echo '</article>';
        }
    } else {
        $path = "content/novella/".$title.".php";
        
        if (file_exists($path)) {
            action_link('novellak', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a novellákhoz', '', 'nav-link back', 'Vissza a novellákhoz');
            
            echo '<article id="'.$title.'" class="short-story">';
            {
                include($path);
                include('content/keletkezes.php');
                include('content/warning.php');
            }
            echo '</article>';
            
            include('app/pagination.php');
        }
    }
?>