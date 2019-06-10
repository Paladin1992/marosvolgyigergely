<?php
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