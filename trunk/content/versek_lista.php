<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Versek betűrendben</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
                <ul class="poems-alphabet">
                    <?php list_alphabet_for_poems(); ?>
                </ul>
                
                <?php list_poems_by_name(); ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Versek időrendben</a>
            </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
                <ul class="poems-time">
                    <?php list_years_for_poems(); ?>
                </ul>    

                <?php list_poems_by_time(); ?>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="vers/osszes">Az összes vers egy lapon</a>
</div>