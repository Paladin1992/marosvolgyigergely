<?php
    echo '<nav>';
    HtmlHelper::action_link(
        'versek', // href
        '<i class="material-icons arrow">keyboard_arrow_left</i>Vissza a versekhez', // innerHTML
        '', // styles
        'nav-link back', // classes
        'Vissza a versekhez' // title
    );
    echo '</nav>';
?>