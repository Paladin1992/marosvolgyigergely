<?php
    $id = $writing_info['Id'];
    $type = $page == 'versek' ? 'vers' : 'novella';
?>

<div class="pagination-container">
    <div class="pagination-prev">
        <?php
            get_paging_link($id, 'prev', $type, 'time');
        ?>
    </div>
    <div class="pagination-next">
        <?php
            get_paging_link($id, 'next', $type, 'time');
        ?>
    </div>
</div>