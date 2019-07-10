<?php
    if ($title == '') {
        print_page_title($page, true);
        include('novellak-lista.php');
    } else {
        $path = "content/novella/".$title.".php";
        
        if (file_exists($path)) {
            action_link('novellak', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a novellákhoz', '', 'nav-link');
            
            echo '<article id="'.$title.'" class="short-story">';
            $current_title = $writing_info['Title'];
            include($path);
            echo '</article>';
            
            include('pagination.php');
        }
    }
?>