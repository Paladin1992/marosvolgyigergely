<?php
    if ($title == '') {
        print_page_title($page, true);
        include('novellak-lista.php');
    } else {
        $path = "content/novella/".$title.".php";
        
        if (file_exists($path)) {
            action_link('novellak', 'Vissza a novellákhoz');
            include($path);
        }
    }
?>