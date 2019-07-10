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

    function action_link($relative_path, $caption, $target = '', $class = '') {
        $href = 'href="'.$relative_path.'"';
        $class = $class == '' ? '' : ' class="'.$class.'"';
        $target = $target == '' ? '' : ' target="'.$target.'"';

        echo '<a '.$href.$target.$class.'>'.$caption.'</a>';
    }

    // $orientation : "portrait" | "landscape"
    // $float       : "none" | "left" | "right"
    function insert_raw_image($src, $orientation, $float, $alt, $title, $classes = "", $styles = "", $useHider = false) {
        $class = $classes == '' ? '' : ' '.$classes;
        $style = $styles == '' ? '' : ' style="'.$styles.'"';
        $result = '';

        $result .= '<figure class="'.$orientation.' '.$float.' clearfix'.$class.'"'.$style.'>';
            $image = '<img src="'.$src.'" class="tm-thumbnail '.$orientation.'" alt="'.$alt.'" title="'.$title.'">';
            $result .= $useHider ? wrap_into_hider($image) : $image;
        $result .= '</figure>';

        echo $result;
    }

    // $orientation : "portrait" | "landscape"
    // $float       : "none" | "left" | "right"
    function insert_figure($src, $orientation, $float, $alt, $title, $figcaption, $classes = "", $styles = "", $useHider = false) {
        $class = $classes == '' ? '' : ' '.$classes;
        $style = $styles == '' ? '' : ' style="'.$styles.'"';
        $result = '';

        $result .= '<figure class="'.$orientation.' '.$float.' clearfix'.$class.'"'.$style.'>';
            $result .= '<a href="'.$src.'" target="_blank">';
                $image = '<img src="'.$src.'" class="tm-thumbnail '.$orientation.'" alt="'.$alt.'" title="'.$title.'">';
                $result .= $useHider ? wrap_into_hider($image) : $image;
            $result .= '</a>';
            $result .= '<figcaption>'.$figcaption.'</figcaption>';
        $result .= '</figure>';

        echo $result;
    }
?>