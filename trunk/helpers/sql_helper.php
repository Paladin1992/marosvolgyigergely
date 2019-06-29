<?php
    include('connect.php');

    function list_poems_by_name() {
        global $connection;

        $query =
            "SELECT `Title`, `Initial`, `Uri` "
            ."FROM `irasok` "
            ."WHERE `IsVisible`=1 AND `Type`='vers' "
            ."ORDER BY `Initial`, `TitleLetterOnly`";

        $result = mysqli_query($connection, $query);
        
        $rows = [];
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $rows[] = $row;
        }

        $rows_length = count($rows);
        $prev_letter = '';
        $inside_block = false;

        for ($i = 0; $i < $rows_length; $i++) {
            $row = $rows[$i];
            $initial = $row['Initial'];

            if ($initial != $prev_letter) {
                if ($inside_block) {
                    echo '</ul>';
                    $inside_block = false;
                }

                echo '<div class="initial-group" id="'.$initial.'">'.transform_initial($initial).'</div>';
                echo '<ul>';
                
                $inside_block = true;
            }

            echo
                '<li>'
                    .'<a href="vers/'.$row['Uri'].'" class="poem-title-link">'.$row['Title'].'</a>'
                .'</li>';

            $prev_letter = $initial;
        }

        echo '</ul>';
    }

    function list_poems_by_time() {
        global $connection;

        $query =
            "SELECT `Title`, `Initial`, `Uri`, YEAR(`DateFinished`) AS Year "
            ."FROM `irasok` "
            ."WHERE `IsVisible`=1 AND `Type`='vers' "
            ."ORDER BY `DateFinished`";

        $result = mysqli_query($connection, $query);
        
        $rows = [];
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $rows[] = $row;
        }

        $rows_length = count($rows);
        $prev_year = '';
        $inside_block = false;

        for ($i = 0; $i < $rows_length; $i++) {
            $row = $rows[$i];
            $year = $row['Year'];

            if ($year != $prev_year) {
                if ($inside_block) {
                    echo '</ul>';
                    $inside_block = false;
                }

                echo '<div class="year-group" id="'.$year.'">'.$year.'</div>';
                echo '<ul>';
                
                $inside_block = true;
            }

            echo
                '<li>'
                    .'<a href="vers/'.$row['Uri'].'" class="poem-title-link">'.$row['Title'].'</a>'
                .'</li>';

            $prev_year = $year;
        }

        echo '</ul>';
    }

    function list_alphabet_for_poems() {
        global $connection;
        $query = "SELECT `Initial` FROM `irasok` WHERE `IsVisible`=1 GROUP BY `Initial` ORDER BY 1 ASC";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $initial = $row['Initial'];
            echo '<li><a href="versek#'.$initial.'">'.transform_initial($initial).'</a></li>';
        }
    }

    function list_years_for_poems() {
        global $connection;
        $query = "SELECT YEAR(`DateFinished`) AS Year FROM `irasok` WHERE `IsVisible`=1 GROUP BY YEAR(`DateFinished`) ORDER BY 1 ASC";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $year = $row['Year'];
            echo '<li><a href="versek#'.$year.'">'.$year.'</a></li>';
        }
    }

    function transform_initial($letter) {
        switch ($letter) {
            case 'A': 
            case 'Á': return 'A-Á';
            case 'E':
            case 'É': return 'E-É';
            case 'I':
            case 'Í': return 'I-Í';
            case 'O':
            case 'Ó': return 'O-Ó';
            case 'Ö':
            case 'Ő': return 'Ö-Ő';
            case 'U':
            case 'Ú': return 'U-Ú';
            case 'Ü':
            case 'Ű': return 'Ü-Ű';
            default: return $letter;
        }
    }

    function list_all($type) {
        global $connection;
        $query = "SELECT `Title`, `Uri`, YEAR(`DateFinished`) AS Year FROM `irasok` WHERE `IsVisible`=1 AND `Type`='".$type."' ORDER BY `DateFinished` ASC";
        $result = mysqli_query($connection, $query);
        $prev_year = '';

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $url = $row['Uri'];
            $path = 'content/'.$type.'/'.$url.'.php';
            $year = $row['Year'];

            if ($year != $prev_year) {
                echo '<div class="year-group">'.$year.'</div>';
            } else {
                echo '<hr/>';
            }

            echo '<article id="'.$url.'">';

            if (file_exists($path)) {
                include($path);
            } else {
                echo '<div style="color: red;">Nincs ilyen: '.$path.'</div>';
            }

            echo '</article>';

            $prev_year = $year;
        }
    }
?>