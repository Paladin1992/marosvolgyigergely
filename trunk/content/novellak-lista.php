<div class="accordion exclusive">
    <div class="accordion">
        <div class="accordion-header">
            <span class="accordion-caption nav-link">
                Novellák betűrendben
                <i class="material-icons arrow">keyboard_arrow_down</i>
            </span>
        </div>
        <div class="accordion-body">
            <ul class="poems-alphabet">
                <?php get_alphabet_for_short_stories(); ?>
            </ul>
            
            <?php get_short_stories_by_name(); ?>
        </div>
    </div>
    <div class="accordion">
        <div class="accordion-header">
            <span class="accordion-caption nav-link">
                Novellák időrendben
                <i class="material-icons arrow">keyboard_arrow_down</i>
            </span>
        </div>
        <div class="accordion-body">
            <ul class="poems-time">
                <?php get_years_for_short_stories(); ?>
            </ul>    

            <?php get_short_stories_by_time(); ?>
        </div>
    </div>
</div>

<div>
    <a href="novella/osszes" class="nav-link">Az összes novella egy lapon</a>
</div>