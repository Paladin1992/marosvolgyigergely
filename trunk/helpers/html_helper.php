<?php
    function get_meta_keywords($page, $title) {
        global $writing_info;
        $pageKeywords = get_menu_item_data($page)['keywords'];
        $niceTitle = $writing_info['Title'];
        $type = ($page == 'versek' ? 'vers' : 'novella');

        if ($niceTitle != '') {
            $pageKeywords .= ', '.$niceTitle;
        } else if ($title == 'osszes') {
            $pageKeywords .= ', összes '.$type;
        }

        echo $pageKeywords;
    }

    function get_meta_description($page, $title) {
        global $writing_info;
        $pageDescription = get_menu_item_data($page)['description'];
        $niceTitle = $writing_info['Title'];
        $type = ($page == 'versek' ? 'vers' : 'novella');

        if ($niceTitle != '') {
            $pageDescription = $niceTitle.', '.$type;
        } else if ($title == 'osszes') {
            $pageDescription .= ', összes '.$type;
        }

        echo $pageDescription;
    }

    function action_link($relative_path, $caption, $target = '', $class = '', $title = '') {
        $href = 'href="'.$relative_path.'"';
        $class = $class == '' ? '' : ' class="'.$class.'"';
        $target = $target == '' ? '' : ' target="'.$target.'"';
        $title = $title == '' ? '' : ' title="'.$title.'"';

        echo '<a '.$href.$target.$class.$title.'>'.$caption.'</a>';
    }

    // $orientation : "portrait" | "landscape"
    // $float       : "none" | "left" | "right"
    function insert_raw_image($src, $orientation, $float, $alt, $title, $classes = "", $styles = "") {
        $class = $classes == '' ? '' : ' '.$classes;
        $style = $styles == '' ? '' : ' style="'.$styles.'"';

        $image = '<img src="'.$src.'" alt="'.$alt.'" title="'.$title.'" class="'.$orientation.' '.$float.' clearfix'.$class.'"'.$style.'>';

        echo $image;
    }
?>