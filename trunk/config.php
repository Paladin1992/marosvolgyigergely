<?php
    // debug
    $_HTML_BASE_URL = 'http://localhost:8080/marosvolgyigergely/trunk/';
    // release
    //$_HTML_BASE_URL = 'http://marosvolgyigergely.hu/';

    $_TITLE_SEPARATOR = '&bull;';
    $_TITLE_SUFFIX = 'Marosvölgyi Gergely hivatalos oldala';

    function set_base_url() {
        global $_HTML_BASE_URL;
        echo '<base href="'.$_HTML_BASE_URL.'">';
    }
?>