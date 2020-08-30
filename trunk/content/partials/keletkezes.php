<?php
    if (App::$writing_info['HasAuthorNotes'] == '1') {
        $url = App::$writing_info['Uri'];
        $typeName = App::$writing_info['TypeName'];
        echo '<div class="author-note-load" title="Szerzői jegyzet betöltése" data-writingUrl="'.$url.'" data-typeName="'.$typeName.'">'
                .'A '.$typeName.' keletkezéséről'
                .'<i class="material-icons arrow">keyboard_arrow_down</i>'
            .'</div>';
        echo '<div class="author-note"></div>';
    }
?>