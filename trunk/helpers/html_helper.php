<?php
    class HtmlHelper {
        public static function get_versioned_link($filePath) {
            return $filePath.'?v='.date('YmdHis', filemtime($filePath));
        }

        public static function get_meta_keywords() {
            $pageKeywords = App::$menuHelper->get_menu_item_data(App::$page)['keywords'];
            $niceTitle = App::$writing_info['Title'];
            $type = (App::$page == 'versek' ? 'vers' : 'novella');
    
            if ($niceTitle != '') {
                $pageKeywords .= ', '.$niceTitle;
            } else if (App::$title == 'osszes') {
                $pageKeywords .= ', összes '.$type;
            }
    
            return $pageKeywords;
        }

        public static function get_meta_description() {
            $pageDescription = App::$menuHelper->get_menu_item_data(App::$page)['description'];
            $niceTitle = App::$writing_info['Title'];
            $type = (App::$page == 'versek' ? 'vers' : 'novella');
    
            if ($niceTitle != '') {
                $pageDescription = $niceTitle.', '.$type;
            } else if (App::$title == 'osszes') {
                $pageDescription .= ', összes '.$type;
            }
    
            return $pageDescription;
        }

        public static function action_link($relative_path, $caption, $target = '', $class = '', $title = '') {
            $href = 'href="'.$relative_path.'"';
            $class = $class == '' ? '' : ' class="'.$class.'"';
            $target = $target == '' ? '' : ' target="'.$target.'"';
            $title = $title == '' ? '' : ' title="'.$title.'"';
    
            echo '<a '.$href.$target.$class.$title.'>'.$caption.'</a>';
        }

        // $orientation : "portrait" | "landscape"
        // $float       : "none" | "left" | "right"
        public static function insert_raw_image($src, $orientation, $float, $alt, $title, $classes = "", $styles = "") {
            $class = $classes == '' ? '' : ' '.$classes;
            $style = $styles == '' ? '' : ' style="'.$styles.'"';

            $image = '<img src="'.$src.'" alt="'.$alt.'" title="'.$title.'" class="'.$orientation.' '.$float.' clearfix'.$class.'"'.$style.'>';

            echo $image;
        }
    }
?>