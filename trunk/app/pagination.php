<?php
    $id = App::$writing_info['Id'];
    $typeName = App::$page == 'versek' ? 'vers' : 'novella';
?>

<div class="pagination-container">
    <div class="pagination-prev">
        <?php
            App::$sqlHelper->get_paging_link($id, 'prev', $typeName, 'time', 'nav-link');
        ?>
    </div>
    <div class="pagination-next">
        <?php
            App::$sqlHelper->get_paging_link($id, 'next', $typeName, 'time', 'nav-link');
        ?>
    </div>
</div>