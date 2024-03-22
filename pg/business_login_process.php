<?php
    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : "";
    $b_num = (isset($_POST['b_number']) && $_POST['b_number'] != '') ? $_POST['b_number'] : "";
    $password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : "";

    if ($id == '') {
        die(json_encode(['result' => 'empty_id']));
    }

    if ($password == '') {
        die(json_encode(['result' => 'empty_password']));
    }
    
    if ($b_num == '') {
        die(json_encode(['result' => 'empty_bnum']));
    }

    include "../inc/dbconfig.php";
    
    $db = $pdo;

    include "../inc/businessmember.php";

    $mem = new BusinessMemeber($db);

    if ($mem->business_login($id, $password, $b_num)) {
        $arr = ['result' => 'login_success'];

        $b_memArr = $mem->getInfo($id);

        session_start();
        $_SESSION['ses_id'] = $id;
        $_SESSION['ses_grade'] = 'business_member';
    } else {
        $arr = ['result' => 'login_fail'];
    }
    die(json_encode($arr));
?>