<?php
    if ($title == '') {
        print_page_title($page, true);
        include('versek_lista.php');
    } else {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            action_link('versek', 'Vissza a versekhez');
            include($path);
        }
    }
?>