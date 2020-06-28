<?php
    $writingUrl = $_GET['writingUrl'];
    $typeName = $_GET['typeName'];
    utf8_encode(include('../../content/'.$typeName.'/keletkezes/'.$writingUrl.'.php'));
?>