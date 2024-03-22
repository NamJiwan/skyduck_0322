<?php
    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : "";
    $password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : "";
    
    if ($id == "") {
        die(json_encode(['result' => 'empty_id']));
    }

    if ($password == "") {
        die(json_encode(['result' => 'empty_password']));
    }

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/member.php";

    $mem = new Member($db);
    
    if ($mem->login($id, $password)) {
        $arr = ['result' => 'login_success'];

        $memArr = $mem->getInfo($id);

        session_start();
        $_SESSION['ses_id'] = $id;
        $_SESSION['ses_grade'] = "common_member";
    } else {
        $arr = ['result' => 'login_fail'];
    }

    die(json_encode($arr));
    
?>