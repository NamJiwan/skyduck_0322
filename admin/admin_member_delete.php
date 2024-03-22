<?php
    include "./../inc/common.php";

    if ($ses_id == '' || $ses_grade != 'admin') {
        $arr = ['result' => 'access_denied'];
        die(json_encode($arr));
    }

    include './../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/member.php';

    $idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ? $_POST['idx'] : '';

    if ($idx == '') {
        $arr = ['result' => 'empty_idx'];
        json_encode($arr);
    };
    
    $mem = new Member($db);
    $mem->member_del($idx);

    $arr = ['result' => 'success'];
    die(json_encode($arr));
?>