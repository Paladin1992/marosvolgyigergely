<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                    Novellák betűrendben
                    <i class="material-icons arrow">keyboard_arrow_down</i>
                </a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
                <ul class="poems-alphabet">
                    <?php get_alphabet_for_short_stories(); ?>
                </ul>
                
                <?php get_short_stories_by_name(); ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                    Novellák időrendben
                    <i class="material-icons arrow">keyboard_arrow_down</i>
                </a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
                <ul class="poems-time">
                    <?php get_years_for_short_stories(); ?>
                </ul>    

                <?php get_short_stories_by_time(); ?>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="novella/osszes">Az összes novella egy lapon</a>
</div>