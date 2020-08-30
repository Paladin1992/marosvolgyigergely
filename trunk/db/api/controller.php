<?php
    include('../../app/config.php');
    include('../credentials.php');
    include('../connect.php');
    include('../../helpers/sql_helper.php');

    $action = $_GET['action'];
    include($action.'.php');

    include('../disconnect.php');
?>