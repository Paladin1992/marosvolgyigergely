<div class="accordion-group">
    <div class="accordion">
        <div class="accordion-header">
            Versek betűrendben
            <i class="material-icons arrow">keyboard_arrow_down</i>
        </div>
        <div class="accordion-body">
            <ul class="poems-alphabet">
                <?php get_alphabet_for_poems(); ?>
            </ul>
            
            <?php get_poems_by_name(); ?>
        </div>
    </div>
    <div class="accordion">
        <div class="accordion-header">
            Versek időrendben
            <i class="material-icons arrow">keyboard_arrow_down</i>
        </div>
        <div class="accordion-body">
            <ul class="poems-time">
                <?php get_years_for_poems(); ?>
            </ul>    

            <?php get_poems_by_time(); ?>
        </div>
    </div>
</div>

<div>
    <a href="vers/osszes">Az összes vers egy lapon</a>
</div>

<div>
    <a href="vers/valtozatok">Változatok</a>
</div>