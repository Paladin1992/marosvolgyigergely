<?php
    if ($title == '') {
        print_page_title($page, true);
        include('versek-lista.php');
    } else {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            action_link('versek', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a versekhez', '', 'nav-link');
            
            echo '<article id="'.$title.'" class="poem">';
            $current_title = $writing_info['Title'];
            include($path);
            echo '</article>';

            include('pagination.php');
        }
    }
?>