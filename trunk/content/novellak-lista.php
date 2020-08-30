<div class="accordion exclusive">
    <div class="accordion" id="shortStoriesByName">
        <div class="accordion-header">
            <span class="accordion-caption nav-link">
                Novellák betűrendben
                <i class="material-icons arrow">keyboard_arrow_down</i>
            </span>
        </div>
        <div class="accordion-body">
            <ul class="poems-alphabet">
                <?php App::$sqlHelper->get_alphabet_for_writings('novella'); ?>
            </ul>
            
            <?php App::$sqlHelper->get_writings_by_name('novella'); ?>
        </div>
    </div>
    <div class="accordion" id="shortStoriesByTime">
        <div class="accordion-header">
            <span class="accordion-caption nav-link">
                Novellák időrendben
                <i class="material-icons arrow">keyboard_arrow_down</i>
            </span>
        </div>
        <div class="accordion-body">
            <ul class="poems-time">
                <?php App::$sqlHelper->get_years_for_writings('novella'); ?>
            </ul>    

            <?php App::$sqlHelper->get_writings_by_time('novella'); ?>
        </div>
    </div>
</div>

<div>
    <a href="novella/osszes" class="nav-link">Az összes novella egy lapon</a>
</div>