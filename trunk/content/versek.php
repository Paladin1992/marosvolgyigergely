<?php
    if ($title == '') {
        print_page_title($page, true);
        include('versek-lista.php');
    } else if ($title == 'osszes') {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            action_link('versek', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a versekhez', '', 'nav-link back', 'Vissza a versekhez');
            
            echo '<article id="'.$title.'">';
            {
                include($path);
                action_link('versek', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a versekhez', '', 'nav-link back', 'Vissza a versekhez');
            }
            echo '</article>';
        }
    } else {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            action_link('versek', '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a versekhez', '', 'nav-link back', 'Vissza a versekhez');
            
            echo '<article id="'.$title.'" class="poem">';
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