<?php
    include_once('connect.php');
    global $connection;

    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : '';

    $fields = "`Title`, `Uri`, `DateFinished`";
    $condition = $type == '' ? '' : "WHERE `Type` = '".$type."'";
    $orderBy = $orderBy == '' ? 'Id' : $orderBy;

    $query = "SELECT $fields FROM `irasok` $condition ORDER BY `$orderBy` ASC";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Could not get data: '.mysqli_error($connection));
    }

    $rows = [];
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>