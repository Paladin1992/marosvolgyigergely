<?php
    include_once("credentials_debug.php");
    //include_once("credentials_release.php");
    $connection = mysqli_connect($db_host, $db_user, $db_password);
    
    if (!$connection) {
       die('Could not connect: ' . mysqli_error($connection));
    }

    mysqli_select_db($connection, 'mgwebsite');

    $sql = 'SELECT * FROM irasok';
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        die('Could not get data: ' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        echo "Id: {$row['Id']}, ".
           "Title: {$row['Title']}, ".
           "URI: {$row['Uri']}, ".
           "Type: {$row['Type']}, ".
           "YearFinished: {$row['YearFinished']}<br>";
    }
?>