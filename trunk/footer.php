<footer>
    <div class="social-links">
        <div class="keep-in-touch">Maradjunk kapcsolatban!</div>
        <ul class="clearfix">
            <li>
                <a href="https://www.facebook.com/marosvolgyi.gergely" target="_blank" class="facebook" title="Kövess Facebookon!">
                    <span class="fa fa-facebook"></span>
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/in/gergely-marosv%C3%B6lgyi-a5425a185/" target="_blank" class="linkedin" title="Kövess LinkedInen!">
                    <span class="fa fa-linkedin"></span>
                </a>
            </li>
            <li>
                <a href="https://www.poet.hu/szerzo/Marosvolgyi_Gergely" target="_blank" class="poet" title="Tegyél figyelőbe a Poet.hu oldalon!">
                    P
                </a>
            </li>
        </ul>
    </div>

    <?php
        $startYear = 2019;
        $currentYear = date("Y");
        echo '<span class="copyright">&copy;'.$startYear.($currentYear > $startYear ? '-'.$currentYear : '').' Marosvölgyi Gergely &ndash; Minden jog fenntartva!</span>';
    ?>
</footer>