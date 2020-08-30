<?php
    class App {
        const HTML_BASE_URL = 'http://localhost:8080/mage/marosvolgyigergely/trunk/';
        const AUTHOR = 'Marosvölgyi Gergely';
        const TITLE_SEPARATOR = '&bull;';
        const TITLE_SUFFIX = App::AUTHOR.' hivatalos oldala';
        const LATEST_WRITINGS_MAX_COUNT = 5; // default: 3
        const LATEST_WRITINGS_MAX_DAYS = 183; // default: 183 (half year)

        public static $page = '';
        public static $title = '';
        public static $writing_info = null;

        public static $menuHelper = null;
        public static $sqlHelper = null;
    }
?>