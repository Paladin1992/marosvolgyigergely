<?php
    class SqlHelper {
        private $_connection;

        public function __construct($connection) {
            $this->_connection = $connection;
        }

        public function get_writing_info($url) {
            $query =
                "SELECT iras.*, tipus.`Name` AS TypeName"
                ." FROM `irasok` iras"
                ." INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
                ." WHERE `Uri`='$url'";
    
            $result = mysqli_query($this->_connection, $query);
            $temp_writing_info = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            return $temp_writing_info;
        }

        public function get_records($query) {
            $result = mysqli_query($this->_connection, $query);
    
            $rows = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
    
            return $rows;
        }

        public function get_title($classes = null) {
            $final_title = App::$writing_info['Title'];
            $classList = is_null($classes) ? '' : ' class="'.$classes.'"';
            
            if (App::$title == 'osszes') {
                $href = App::$writing_info['TypeName'].'/'.App::$writing_info['Uri'];
                echo '<h2'.$classList.'><a href="'.$href.'">'.$final_title.'</a></h2>';
            } else {
                echo '<h1'.$classList.'>'.$final_title.'</h1>';
            }
        }

        public function get_writings_by_name($typeName) {
            $query =
                "SELECT `Title`, `Initial`, `Uri`"
                ." FROM `irasok` iras"
                ." INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
                ." WHERE `IsVisible`=1 AND tipus.`Name` LIKE '$typeName%'"
                ." ORDER BY `Initial`, `TitleLetterOnly`";

            $rows = $this->get_records($query);
            $count = count($rows);
            $prev_letter = '';
            $inside_block = false;

            for ($i = 0; $i < $count; $i++) {
                $row = $rows[$i];
                $initial = $row['Initial'];

                if ($initial != $prev_letter) {
                    if ($inside_block) {
                        echo '</ul>';
                        $inside_block = false;
                    }

                    echo '<div class="initial-group" id="'.$initial.'">'.$this->transform_initial($initial).'</div>';
                    echo '<ul class="group-list">';
                    
                    $inside_block = true;
                }

                echo
                    '<li class="group-list-item">'
                        .'<a href="'.$typeName.'/'.$row['Uri'].'" class="title-link">'.$row['Title'].'</a>'
                    .'</li>';

                $prev_letter = $initial;
            }

            echo '</ul>';
        }

        function get_writings_by_time($typeName) {
            $query =
                "SELECT `Title`, `Initial`, `Uri`, YEAR(`DateFinished`) AS Year"
                ." FROM `irasok` iras"
                ." INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
                ." WHERE `IsVisible`=1 AND tipus.`Name` LIKE '$typeName%'"
                ." ORDER BY `DateFinished`";

            $rows = $this->get_records($query);
            $count = count($rows);
            $prev_year = '';
            $inside_block = false;

            for ($i = 0; $i < $count; $i++) {
                $row = $rows[$i];
                $year = $row['Year'];

                if ($year != $prev_year) {
                    if ($inside_block) {
                        echo '</ul>';
                        $inside_block = false;
                    }

                    echo '<div class="year-group" id="'.$year.'">'.$year.'</div>';
                    echo '<ul class="group-list">';
                    
                    $inside_block = true;
                }

                echo
                    '<li class="group-list-item">'
                        .'<a href="'.$typeName.'/'.$row['Uri'].'" class="title-link">'.$row['Title'].'</a>'
                    .'</li>';

                $prev_year = $year;
            }

            echo '</ul>';
        }

        function get_alphabet_for_writings($typeName) {
            $query =
                "SELECT `Initial`"
                ." FROM `irasok` iras"
                ." INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
                ." WHERE `IsVisible`=1 AND tipus.`Name` LIKE '$typeName%'"
                ." GROUP BY `Initial`"
                ." ORDER BY 1 ASC";

            $rows = $this->get_records($query);
            $count = count($rows);
            $baseHref = $typeName == 'vers' ? 'versek' : 'novellak';

            for ($i = 0; $i < $count; $i++) {
                $initial = $rows[$i]['Initial'];
                echo '<li><a href="'.$baseHref.'#'.$initial.'">'.$this->transform_initial($initial).'</a></li>';
            }
        }

        function get_years_for_writings($typeName) {
            $query =
                "SELECT YEAR(`DateFinished`) AS Year"
                ." FROM `irasok` iras"
                ." INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
                ." WHERE `IsVisible`=1 AND tipus.`Name` LIKE '$typeName%'"
                ." GROUP BY YEAR(`DateFinished`)"
                ." ORDER BY 1 ASC";

            $rows = $this->get_records($query);
            $count = count($rows);
            $baseHref = $typeName == 'vers' ? 'versek' : 'novellak';

            for ($i = 0; $i < $count; $i++) {
                $year = $rows[$i]['Year'];
                echo '<li><a href="'.$baseHref.'#'.$year.'">'.$year.'</a></li>';
            }
        }

        function get_latest_writings($maxCount = 3, $maxDays = 183) {
            $query =
                "SELECT iras.`Title`, iras.`Uri`, tipus.`Name` AS `TypeName`"
                ." FROM `irasok` iras"
                ." INNER JOIN `tipusok` tipus ON tipus.`Id`=iras.`TypeId`"
                ." WHERE iras.`IsVisible`=1"
                ."    AND ABS(TIMESTAMPDIFF(DAY, CURDATE(), iras.`DatePublished`)) <= $maxDays"
                ." ORDER BY iras.`DatePublished` DESC, iras.`DateFinished` DESC, iras.`Id` DESC"
                ." LIMIT $maxCount";
    
            $rows = $this->get_records($query);
            $count = count($rows);
    
            echo '<div class="latest-writings">';
            
            if ($count == 0) {
                echo '(Az elmúlt fél évben nem került fel új írásom az oldalra.)';
            } else {
                for ($i = 0; $i < $count; $i++) {
                    $row = $rows[$i];
                    $href = $row['TypeName']."/".$row['Uri'];
                    App::$writing_info = $this->get_writing_info($row['Uri']); // get_title() will need writing_info to render titles
    
                    if ($i > 0) {
                        echo '<hr>';
                    }
    
                    echo '<div class="writing-extract">';
                        echo '<div class="writing-extract-text">';
                            echo '<div class="writing-extract-overlay"></div>';
                            include("content/".$href.".php");
                        echo '</div>';
                        echo '<div class="writing-extract-link">';
                            echo '<a href="'.$href.'" class="title-link">Tovább olvasom <i class="material-icons arrow">keyboard_arrow_right</i></a>';                    
                        echo '</div>';
                    echo '</div>';
                }
            }
            
            echo '</div>';
        }

        // $direction: 'prev' | 'next'
        // $type: 'vers' | 'novella'
        // $by: 'name' | 'time'
        public function get_paging_link($id, $direction, $type, $by, $classes) {
            $qDirection = ucfirst($direction);
            $qType = ($type == 'vers' ? 'Poem' : 'ShortStory');
            $qBy = ucfirst($by);
            $proc = '`Get'.$qDirection.$qType.'By'.$qBy.'`';

            $query = 'CALL '.$proc.'('.intval($id).')';
            $result = mysqli_query($this->_connection, $query);

            if (!$result) return;
            
            if (mysqli_num_rows($result) > 0) {
                $writing = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $href = $type.'/'.$writing['Uri'];
                $caption_with_arrow = '';
                $linkTitle = '';

                if ($direction == 'prev') {
                    $caption_with_arrow = '<i class="material-icons arrow">keyboard_arrow_left</i>'.$writing['Title'];
                    $linkTitle = 'Előző '.$type.': '.$writing['Title'];
                } else {
                    $caption_with_arrow = $writing['Title'].'<i class="material-icons arrow">keyboard_arrow_right</i>';
                    $linkTitle = 'Következő '.$type.': '.$writing['Title'];
                }

                echo HtmlHelper::action_link($href, $caption_with_arrow, '', $classes, $linkTitle);
            }

            $this->_connection->next_result();
        }

        // helpers
        private function transform_initial($letter) {
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
    }

    App::$sqlHelper = new SqlHelper($connection);
?>