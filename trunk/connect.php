<?php
    include_once("credentials_debug.php");
    //include_once("credentials_release.php");

    $connection = mysqli_connect($db_host, $db_user, $db_password);
    
    if (!$connection) {
       die('Could not connect: '.mysqli_error($connection));
    }

    mysqli_select_db($connection, 'mgwebsite');

    mysqli_query($connection, "SET NAMES 'UTF8'");
    mysqli_query($connection, "SET character_set_client='utf8'"); 
    mysqli_query($connection, "SET character_set_results='utf8'"); 
    mysqli_query($connection, "SET collation_connection='utf8_general_ci'");
?>