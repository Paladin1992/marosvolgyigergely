<div class="accordion-group exclusive">
    <div class="accordion" id="poemsByName">
        <div class="accordion-header">
            <span class="accordion-caption nav-link">
                Versek betűrendben
                <i class="material-icons arrow">keyboard_arrow_down</i>
            </span>
        </div>
        <div class="accordion-body">
            <ul class="poems-alphabet">
                <?php App::$sqlHelper->get_alphabet_for_writings('vers'); ?>
            </ul>
            
            <?php App::$sqlHelper->get_writings_by_name('vers'); ?>
        </div>
    </div>
    <div class="accordion" id="poemsByTime">
        <div class="accordion-header">
            <span class="accordion-caption nav-link">
                Versek időrendben
                <i class="material-icons arrow">keyboard_arrow_down</i>
            </span>
        </div>
        <div class="accordion-body">
            <ul class="poems-time">
                <?php App::$sqlHelper->get_years_for_writings('vers'); ?>
            </ul>    

            <?php App::$sqlHelper->get_writings_by_time('vers'); ?>
        </div>
    </div>
</div>

<div>
    <a href="vers/osszes" class="nav-link">Az összes vers egy lapon</a>
</div>

<!-- <div>
    <a href="vers/valtozatok" class="nav-link">Változatok</a>
</div> -->