<?php
    include('connect.php');

    function get_writing_info($title) {
        global $connection;
        $query = "SELECT * FROM `irasok` WHERE `Uri`='$title'";
        $result = mysqli_query($connection, $query);

        $writing_info = mysqli_fetch_array($result, MYSQL_ASSOC);
        return $writing_info;
    }

    function list_all($type) {
        global $connection;

        $query =
            "SELECT `Title`, `Uri`, YEAR(`DateFinished`) AS Year "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE '".$type."%' "
            ."ORDER BY `DateFinished` ASC";
        
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

    // poems
    function get_poems_by_name() {
        global $connection;

        $query =
            "SELECT `Title`, `Initial`, `Uri` "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'vers%' "
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

    function get_poems_by_time() {
        global $connection;

        $query =
            "SELECT `Title`, `Initial`, `Uri`, YEAR(`DateFinished`) AS Year "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'vers%' "
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

    function get_alphabet_for_poems() {
        global $connection;

        $query =
            "SELECT `Initial` "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId` "
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'vers%' "
            ."GROUP BY `Initial` "
            ."ORDER BY 1 ASC";

        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $initial = $row['Initial'];
            echo '<li><a href="versek#'.$initial.'">'.transform_initial($initial).'</a></li>';
        }
    }

    function get_years_for_poems() {
        global $connection;

        $query =
            "SELECT YEAR(`DateFinished`) AS Year "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'vers%' "
            ."GROUP BY YEAR(`DateFinished`) "
            ."ORDER BY 1 ASC";
        
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $year = $row['Year'];
            echo '<li><a href="versek#'.$year.'">'.$year.'</a></li>';
        }
    }

    // function get_prev_poem_link_by_time($id) {
    //     global $connection;
    //     $query = "CALL GetPrevPoemByTime(".$id.")";
    //     $result = mysqli_query($connection, $query);
    //     $rowsCount = mysqli_num_rows($result);
        
    //     if ($rowsCount > 0) {
    //         echo action_link('vers/'.$result['Uri'], 'Előző vers időrendben ('.$result['Name'].')');
    //     } else {
    //         echo '';
    //     }
    // }

    // function get_next_poem_link_by_time($id) {
    //     global $connection;
    //     $query = "CALL GetNextPoemByTime(".$id.")";
    //     $result = mysqli_query($connection, $query);
    //     $rowsCount = mysqli_num_rows($result);
        
    //     if ($rowsCount > 0) {
    //         echo action_link('vers/'.$result['Uri'], 'Következő vers időrendben ('.$result['Name'].')');
    //     } else {
    //         echo '';
    //     }
    // }

    // $direction: 'prev' | 'next'
    // $type: 'vers' | 'novella'
    // $by: 'name' | 'time'
    function get_paging_link($id, $direction, $type, $by) {
        global $connection;
        $qDirection = ucfirst($direction);
        $qType = ($type == 'vers' ? 'Poem' : 'ShortStory');
        $qBy = ucfirst($by);
        $proc = '`Get'.$qDirection.$qType.'By'.$qBy.'`';

        $query = 'CALL '.$proc.'('.intval($id).')';
        $result = mysqli_query($connection, $query);

        if (!$result) return;
        
        if (mysqli_num_rows($result) > 0) {
            $writing = mysqli_fetch_array($result, MYSQL_ASSOC);
            $caption_with_arrow = '';

            if ($direction == 'prev') {
                $caption_with_arrow = '<i class="material-icons arrow">keyboard_arrow_left</i>'.$writing['Title'];
            } else {
                $caption_with_arrow = $writing['Title'].'<i class="material-icons arrow">keyboard_arrow_right</i>';
            }

            echo action_link($type.'/'.$writing['Uri'], $caption_with_arrow);
        }

        $connection->next_result();
    }

    // short stories
    function get_short_stories_by_name() {
        global $connection;

        $query =
            "SELECT `Title`, `Initial`, `Uri` "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'novella%' "
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
                    .'<a href="novella/'.$row['Uri'].'" class="short-story-title-link">'.$row['Title'].'</a>'
                .'</li>';

            $prev_letter = $initial;
        }

        echo '</ul>';
    }

    function get_short_stories_by_time() {
        global $connection;

        $query =
            "SELECT `Title`, `Initial`, `Uri`, YEAR(`DateFinished`) AS Year "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'novella%' "
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
                    .'<a href="novella/'.$row['Uri'].'" class="short-story-title-link">'.$row['Title'].'</a>'
                .'</li>';

            $prev_year = $year;
        }

        echo '</ul>';
    }

    function get_alphabet_for_short_stories() {
        global $connection;

        $query =
            "SELECT `Initial` "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'novella%' "
            ."GROUP BY `Initial` "
            ."ORDER BY 1 ASC";
        
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $initial = $row['Initial'];
            echo '<li><a href="novellak#'.$initial.'">'.transform_initial($initial).'</a></li>';
        }
    }

    function get_years_for_short_stories() {
        global $connection;

        $query =
            "SELECT YEAR(`DateFinished`) AS Year "
            ."FROM `irasok` iras "
            ."INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
            ."WHERE `IsVisible`=1 AND tipus.`Name` LIKE 'novella%' "
            ."GROUP BY YEAR(`DateFinished`) "
            ."ORDER BY 1 ASC";
        
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            $year = $row['Year'];
            echo '<li><a href="novellak#'.$year.'">'.$year.'</a></li>';
        }
    }

    // helpers
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
?>