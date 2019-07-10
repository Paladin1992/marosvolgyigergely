<?php
    $menu = json_decode(file_get_contents("menu.json"), true);
    $menu_count = count($menu);

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
        
        if ($caption != '') {
            echo '<li class="menu '.$active_class.'"><a href="'.$url.'">'.$caption.'</a></li>';
        }
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

    function insert_page_title($page, $title) {
        global $_TITLE_SEPARATOR, $_TITLE_SUFFIX, $writing_info;
        $niceTitle = $writing_info == null ? '' : $writing_info['Title'];
        $type = ($page == 'versek' ? 'vers' : 'novella');
        $pageTitle = '';
        
        if ($niceTitle != '') {
            $pageTitle = $niceTitle;
        } else if ($title == 'osszes') {
            $pageTitle = 'Összes '.$type;
        } else {
            $pageTitle =
                get_menu_item_data($page)['menuItemCaption'] == ''
                    ? get_menu_item_data($page)['h1']
                    : get_menu_item_data($page)['menuItemCaption'];
        }

        echo '<title>'.$pageTitle.' '.$_TITLE_SEPARATOR.' '.$_TITLE_SUFFIX.'</title>';
    }
?>