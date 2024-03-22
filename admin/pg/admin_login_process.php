<?php
// admin_login.php

include "../../inc/dbconfig.php";
$db = $pdo;
include "../../inc/admin.php";
$admin = new Admin($db);

$id = (isset($_POST['admin_id']) && $_POST['admin_id'] != '') ? $_POST['admin_id'] : '';
$password = (isset($_POST['admin_password']) && $_POST['admin_password'] != '') ? $_POST['admin_password'] : '';
$mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

if ($mode == '') {
    die(json_encode(['result' => 'empty_mode']));
}

if ($mode == 'admin_login') {
    if ($id == '') {
        die(json_encode(['result' => 'empty_admin_id']));
    }

    if ($password == '') {
        die(json_encode(['result' => 'empty_admin_password']));
    }

    if ($admin->login($id, $password)) {
        session_start();
        $_SESSION['ses_id'] = 'skyduck_admin';
        $_SESSION['ses_grade'] = 'admin';
        die(json_encode(['result' => 'admin_login_success']));
    } else {
        die(json_encode(['result' => 'login_fail']));
    }
}
?>