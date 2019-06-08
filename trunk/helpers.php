<?php
    $menu = json_decode(file_get_contents("menu.json"), true);
    $menu_count = count($menu);

    function bs_col($xs, $sm, $md, $lg, $use_offset) {
        $xs_offset = (12 - $xs) / 2;
        $sm_offset = (12 - $sm) / 2;
        $md_offset = (12 - $md) / 2;
        $lg_offset = (12 - $lg) / 2;
        $result = '';

        if ($xs != 0) {
            $result .= 'col-xs-'.$xs;
            if ($use_offset && $xs_offset != 0) {
                $result .= ' col-xs-offset-'.$xs_offset;
            }
        }

        if ($sm != 0) {
            $result .= ' col-sm-'.$sm;
            if ($use_offset && $sm_offset != 0) {
                $result .= ' col-sm-offset-'.$sm_offset;
            }
        }

        if ($md != 0) {
            $result .= ' col-md-'.$md;
            if ($use_offset && $md_offset != 0) {
                $result .= ' col-md-offset-'.$md_offset;
            }
        }

        if ($lg != 0) {
            $result .= ' col-lg-'.$lg;
            if ($use_offset && $lg_offset != 0) {
                $result .= ' col-lg-offset-'.$lg_offset;
            }
        }

        return $result;
    }

    function get_menu_item_data($url) {
        global $menu, $menu_count;

        for ($i = 0; $i < $menu_count && $menu[$i]['url'] != $url; $i++) {}

        return ($i < $menu_count ? $menu[$i] : null);
    }

    function get_menu_item($current_page, $is_active) {
        $menu_item_data = get_menu_item_data($current_page);
        $caption = $menu_item_data['menuItemCaption'];
        $url = $menu_item_data['url'];
        $active_class = ($is_active ? 'active' : '');
        
        echo '<li class="menu '.$active_class.'"><a href="'.$url.'">'.$caption.'</a></li>';
    }

    function get_menu($current_page) {
        global $menu, $menu_count;

        for ($i = 0; $i < $menu_count; $i++) {
            $url = $menu[$i]['url'];
            get_menu_item($url, $url == $current_page);
        }
    }

    function print_page_title($page, $wrap_in_h1 = false, $exclude = []) {
        $pageToExclude = in_array($page, $exclude);

        if (!$pageToExclude) {

            if ($wrap_in_h1) {
                $classes = get_menu_item_data($page)['classes'];
                $classes = $classes == '' ? '' : ' class="'.$classes.'"';
                echo '<h1'.$classes.'>'.get_menu_item_data($page)['h1'].'</h1>';
            } else {
                echo get_menu_item_data($page)['menuItemCaption'];
            }
        }
    }

    function insert_page_title($page) {
        global $_TITLE_SEPARATOR, $_TITLE_SUFFIX;
        echo '<title>'.get_menu_item_data($page)['menuItemCaption'].' '.$_TITLE_SEPARATOR.' '.$_TITLE_SUFFIX.'</title>';
    }

    function action_link($relative_path, $caption, $target = '', $class = '') {
        $href = 'href="'.base_url($relative_path).'"';
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