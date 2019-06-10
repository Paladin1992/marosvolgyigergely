<?php
    $title = isset($_GET['title']) ? $_GET['title'] : '';

    //action_link('versek/teli-kep', 'Téli kép');

    if ($title == '') {
        include('versek_lista.php');
    } else {
        $path = "content/vers/".$title.".php";
        
        if (file_exists($path)) {
            include($path);
        }
    }
?>