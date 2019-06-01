Versek tartalma

<?php
    $title = isset($_GET['title']) ? $_GET['title'] : '';

    //action_link('versek/teli-kep', 'Téli kép');

    if ($title != '') {
        include("content/vers/".$title.".php");
    }
?>