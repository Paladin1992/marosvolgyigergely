<footer>
    <div class="social-links-container">
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

    <div class="email-container">
        <i class="fa fa-envelope"></i> marosvolgyi<!--1-->.<!--2-->gergely<!--3-->@<!--4-->gmail<!--5-->.<!--6-->com
    </div>

    <?php
        $startYear = 2019;
        $currentYear = date("Y");
        $years = $startYear.($currentYear > $startYear ? '-'.$currentYear : '');
    ?>
    <div class="copyright">
        <div class="copyright-name">&copy;<?=($years.' '.$_MAGE)?></div>
        <!-- <div class="copyright-rights">
            <span class="copyright-separator">&ndash;</span> Minden jog fenntartva!
        </div> -->
    </div>
</footer>