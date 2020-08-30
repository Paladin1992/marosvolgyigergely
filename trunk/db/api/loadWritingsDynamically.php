<?php
    App::$title = isset($_GET['title']) ? $_GET['title'] : '';
    
    $typeName = isset($_GET['typeName']) ? $_GET['typeName'] : 0;
    $skip = isset($_GET['skip']) ? $_GET['skip'] : 0;
    $take = isset($_GET['take']) ? $_GET['take'] : 0;

    $isPrevYearNeeded = $skip > 0;

    if ($isPrevYearNeeded) {
        $skip--;
        $take++;
    }

    $storedProcedureName = $typeName == 'vers' ? 'LoadPoemsDynamically' : 'LoadShortStoriesDynamically';
    $query = "CALL `$storedProcedureName`($skip, $take);";
    $rows = App::$sqlHelper->get_records($query);

    $startIndex = 0;
    $count = count($rows);
    $prev_year = 0;

    if ($isPrevYearNeeded) {
        $startIndex = 1;
        $prev_year = $rows[0]['Year'];
    }
    
    for ($i = $startIndex; $i < $count; $i++) {
        $row = $rows[$i];
        $url = $row['Uri'];
        $path = '../../content/'.$typeName.'/'.$url.'.php';
        $year = $row['Year'];

        if ($year != $prev_year) {
            echo '<div class="year-group">'.$year.'</div>';
        } else {
            echo '<hr/>';
        }

        echo '<article id="'.$url.'">';

        if (file_exists($path)) {
            App::$writing_info = $row;
            include($path);
            include('../../content/partials/keletkezes.php');
        } else {
            echo '<div style="color: red;">Nincs ilyen: '.$path.'</div>';
        }

        echo '</article>';

        $prev_year = $year;
    }
?>