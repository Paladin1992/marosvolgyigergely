<?php
    class MenuHelper {
        private $_menu;
        private $_menu_count;

        public function __construct() {
            $this->_menu = json_decode(file_get_contents("app/menu.json"), true);
            $this->_menu_count = count($this->_menu);
        }

        public function get_menu_item_data($url) {
            for ($i = 0; $i < $this->_menu_count && $this->_menu[$i]['url'] != $url; $i++) {}
    
            return ($i < $this->_menu_count ? $this->_menu[$i] : null);
        }

        function get_menu_item($current_page, $is_active) {
            $menu_item_data = $this->get_menu_item_data($current_page);
            $caption = $menu_item_data['menuItemCaption'];
            $url = $menu_item_data['url'];
            $active_class = ($is_active ? 'active' : '');
            
            if ($caption != '') {
                echo '<li class="menu '.$active_class.'"><a href="'.$url.'">'.$caption.'</a></li>';
            }
        }

        public function get_menu($current_page) {
            for ($i = 0; $i < $this->_menu_count; $i++) {
                $url = $this->_menu[$i]['url'];
                $this->get_menu_item($url, $url == $current_page);
            }
        }

        public function print_page_title($page, $wrap_in_h1 = false, $exclude = []) {
            $pageToExclude = in_array(App::$page, $exclude);
    
            if (!$pageToExclude) {
                if ($wrap_in_h1) {
                    $classes = $this->get_menu_item_data(App::$page)['classes'];
                    $classes = $classes == '' ? '' : ' class="'.$classes.'"';
                    echo '<h1'.$classes.'>'.$this->get_menu_item_data(App::$page)['h1'].'</h1>';
                } else {
                    echo $this->get_menu_item_data(App::$page)['menuItemCaption'];
                }
            }
        }

        public function insert_page_title() {
            $niceTitle = App::$writing_info == null ? '' : App::$writing_info['Title'];
            $type = (App::$page == 'versek' ? 'vers' : 'novella');
            $pageTitle = '';
            
            if ($niceTitle != '') {
                $pageTitle = $niceTitle;
            } else if (App::$title == 'osszes') {
                $pageTitle = 'Összes '.$type;
            } else {
                $pageTitle =
                    $this->get_menu_item_data(App::$page)['menuItemCaption'] == ''
                        ? $this->get_menu_item_data(App::$page)['h1']
                        : $this->get_menu_item_data(App::$page)['menuItemCaption'];
            }
    
            echo '<title>'.$pageTitle.' '.App::TITLE_SEPARATOR.' '.App::TITLE_SUFFIX.'</title>';
        }
    }

    App::$menuHelper = new MenuHelper();
?>