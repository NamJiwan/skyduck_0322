

<div class="d-flex mt-3 justify-content-between align-items-start">
    <?php
    if (isset($sn) && $sn != '' && isset($sf) && $sf != '') {
        $param = '&sn=' . $sn . '&sf=' . $sf;
    }
    echo my_pagination($total, $limit, $page_limit, $page, $param);
    ?>
</div>