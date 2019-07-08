<?php
    if ($title == '') {
        print_page_title($page, true);
        include('versek-lista.php');
    } else {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            action_link('versek', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a versekhez');
            echo '<article id="'.$title.'" class="poem">';
            include($path);
            echo '</article>';
            include('pagination.php');
        }
    }
?>