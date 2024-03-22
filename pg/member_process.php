<?php
    include '../inc/dbconfig.php';

    $db = $pdo;
    
    include '../inc/member.php';
    
    $mem = new Member($db);

    // echo $_POST;
    
    
    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
    $password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : '';
    $email = (isset($_POST['email']) && $_POST['email'] != '') ? $_POST['email'] : '';
    $name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';
    $mobile = (isset($_POST['mobile']) && $_POST['mobile'] != '') ? $_POST['mobile'] : '';
    $phone = (isset($_POST['phone']) && $_POST['phone'] != '') ? $_POST['phone'] : '';
    $zipcode = (isset($_POST['zipcode']) && $_POST['zipcode'] != '') ? $_POST['zipcode'] : '';
    $addr = (isset($_POST['addr']) && $_POST['addr'] != '') ? $_POST['addr'] : '';
    $detail_addr = (isset($_POST['detail_addr']) && $_POST['detail_addr'] != '') ? $_POST['detail_addr'] : '';
    $mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

    if ($mode == "id_chk") {
        if ($id == '') {
            die(json_encode(['result' => 'empty_id']));
        }

        if ($mem->id_exist($id)) {
            die(json_encode(['result' => 'fail']));
        } else {
            die(json_encode(['result' => 'success']));
        }
    }else if($mode == 'email_chk') {
        if ($email == '') {
            die(json_encode(['result' => 'empty_email']));
        };

        if ($mem->email_exists($email)) {
            die(json_encode(['result' => 'fail']));
        }else {
            die(json_encode(['result' => 'success']));
        }
    } else if ($mode == 'member_input') {
        $arr = [
            'id' => $id,
            'password' => $password,
            'email' => $email,
            'name' => $name,
            'mobile' => $mobile,
            'phone' => $phone,
            'zipcode' => $zipcode,
            'address' => $addr,
            'detailaddress' => $detail_addr
        ];

        try {
            $result = $mem->input($arr);

            header('Content-Type: application/json');
            if ($result) {
                die(json_encode(['result' => 'success']));
            } else {
                die(json_encode(['result' => 'fail']));
            }
        } catch (Exception $e) {
            header('Content-Type: application/json');
            die(json_encode(['result' => 'error', 'message' => $e->getMessage()]));
        }
    } else if ($mode == 'admin_edit') {
        session_start();
    
        $arr = [
            'id' => $id,
            'password' => $password,
            'email' => $email,
            'name' => $name,
            'mobile' => $mobile,
            'phone' => $phone,
            'zipcode' => $zipcode,
            'address' => $addr,
            'detailaddress' => $detail_addr
        ];
    
        $result = $mem->admin_to_member_edit($arr);
    
        if ($result['success']) {
            die(json_encode(['result' => 'success']));
        } else {
            die(json_encode(['result' => 'fail', 'message' => $result['error']]));
        }
    } else if ($mode == 'edit') {
        session_start();
    
        $arr = [
            'id' => $id,
            'password' => $password,
            'email' => $email,
            'name' => $name,
            'mobile' => $mobile,
            'phone' => $phone,
            'zipcode' => $zipcode,
            'address' => $addr,
            'detailaddress' => $detail_addr
        ];
    
        $result = $mem->member_edit($arr);
    
        if ($result['success']) {
            die(json_encode(['result' => 'success']));
        } else {
            die(json_encode(['result' => 'fail', 'message' => $result['error']]));
        }
    } 

?>