<?php
    include '../inc/dbconfig.php';

    $db = $pdo;

    include '../inc/businessmember.php';

    $bmem = new BusinessMemeber($db);

    $id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';
    $password = (isset($_POST['password']) && $_POST['password']) ? $_POST['password'] : '';
    $b_name = (isset($_POST['b_name']) && $_POST['b_name']) ? $_POST['b_name'] : '';
    $ceo_name = (isset($_POST['ceo_name']) && $_POST['ceo_name']) ? $_POST['ceo_name'] : '';
    $email = (isset($_POST['email']) && $_POST['email'] != '') ? $_POST['email'] : '';
    $b_mobile = (isset($_POST['b_mobile']) && $_POST['b_mobile'] != '') ? $_POST['b_mobile'] : '';
    $b_phone = (isset($_POST['b_phone']) && $_POST['b_phone'] != '') ? $_POST['b_phone'] : '';
    $b_fax = (isset($_POST['b_fax']) && $_POST['b_fax'] != '') ? $_POST['b_fax'] : '';
    $zipcode = (isset($_POST['zipcode']) && $_POST['zipcode'] != '') ? $_POST['zipcode'] : '';
    $addr = (isset($_POST['addr']) && $_POST['addr'] != '') ? $_POST['addr'] : '';
    $detail_addr = (isset($_POST['detail_addr']) && $_POST['detail_addr'] != '') ? $_POST['detail_addr'] : '';
    $b_number = (isset($_POST['b_number']) && $_POST['b_number'] != '') ? $_POST['b_number'] : '';
    $b_type = (isset($_POST['b_type']) && $_POST['b_type'] != '') ? $_POST['b_type'] : '';
    $b_category = (isset($_POST['b_category']) && $_POST['b_category'] != '') ? $_POST['b_category'] : '';
    $mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

    if ($mode == "id_chk") {
        if ($id == '') {
            die(json_encode(['result' => 'empty_id']));
        }

        if ($bmem->id_exist($id)) {
            die(json_encode(['result' => 'fail']));
        } else {
            die(json_encode(['result' => 'success']));
        }
    } else if ($mode == "email_chk") {
        if ($email == '') {
            die(json_encode(['result' => 'empty_email']));
        }

        // if ($bmem->email_format_check($email)) {
        //     die(json_encode(['result' => 'email_format_wrong']));
        // }

        if ($bmem->email_exists($email)) {
            die(json_encode(['result' => 'fail']));
            
        } else {
            die(json_encode(['result' => 'success']));
        }
    } else if ($mode == "b_number_chk") {
        if ($b_number == '') {
            die(json_encode(['result' => 'empty_b_number']));
        };

        if ($bmem->business_number_exists($b_number)) {
            die(json_encode(['result' => 'fail']));
        } else {
            die(json_encode(['result' => 'success']));
        };
    } else if ($mode == "input") {
        $photo = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
            $extArray = explode('.', $_FILES['photo']['name']);
            $ext = end($extArray);
            $photo = $b_name.".".$ext;

            copy($_FILES['photo']['tmp_name'], "../data/business_image/".$photo);
        };

        if ($id == '') {
            die(json_encode(['result' => 'empty_id']));
        }

        if ($pass == '') {
            die(json_encode(['result' => 'empty_password']));
        }

        if ($b_name == '') {
            die(json_encode(['result' => 'empty_bname']));
        }

        if ($ceo_name == '') {
            die(json_encode(['result' => 'empty_ceo_name']));
        }

        if ($email == '') {
            die(json_encode(['result' => 'empty_email']));
        }

        if ($b_mobile == '') {
            die(json_encode(['result' => 'empty_b_mobile']));
        }

        if ($b_phone == '') {
            die(json_encode(['result' => 'empty_b_phone']));
        }

        if ($b_fax == '') {
            die(json_encode(['result' => 'empty_b_fax']));
        }

        if ($zipcode == '') {
            die(json_encode(['result' => 'empty_zipcode']));
        }

        if ($addr == '') {
            die(json_encode(['result' => 'empty_addr']));
        }

        if ($detail_addr == '') {
            die(json_encode(['result' => 'empty_detail_addr']));
        }

        if ($b_number == '') {
            die(json_encode(['result' => 'empty_b_number']));
        }

        if ($b_type == '') {
            die(json_encode(['result' => 'empty_b_type']));
        }

        if ($b_category == '') {
            die(json_encode(['result' => 'empty_b_category']));
        }

        $arr = [
            'id' => $id,
            'password' => $password,
            'companyname' => $b_name,
            'ceoname' => $ceo_name,
            'mobilenumber' => $b_mobile,
            'phonenumber' => $b_phone,
            'faxnumber' => $b_fax,
            'email' => $email,
            'zipcode' => $zipcode,
            'address' => $addr,
            'detailaddress' => $detail_addr,
            'businessregistrationnumber' => $b_number,
            'businessregistrationimage' => $photo,
            'businesstype' => $b_type,
            'businesscategory' => $b_category
        ];

        try {
            $result = $bmem->input($arr);

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
    } else if ($mode == 'admin_business_edit') {
        session_start();

        $old_photo = (isset($_POST['old_photo']) && $_POST['old_photo'] != '') ? $_POST['old_photo'] : '';
        $old_b_name = (isset($_POST['old_b_name']) && $_POST['old_b_name'] != '') ? $_POST['old_b_name'] : '';
    
        // Check if b_name has changed
        if ($old_b_name != $b_name) {
            // Rename the old image file
            if (!empty($old_photo) && file_exists("../data/business_image/" . $old_photo)) {
                $extArray = explode('.', $old_photo);
                $ext = end($extArray);
                $new_photo_with_new_b_name = $b_name . "." . $ext;
                rename("../data/business_image/" . $old_photo, "../data/business_image/" . $new_photo_with_new_b_name);
                $old_photo = $new_photo_with_new_b_name;
            }
        }
    
        // Handle new image file
        if (!empty($_FILES['photo']['name'])) {
            // Delete the old image file
            if (!empty($old_photo) && file_exists("../data/business_image/" . $old_photo)) {
                unlink("../data/business_image/" . $old_photo);
            }
    
            // Process the new image file
            $extArray = explode('.', $_FILES['photo']['name']);
            $ext = end($extArray);
            $new_photo = $b_name . "." . $ext;
            move_uploaded_file($_FILES['photo']['tmp_name'], "../data/business_image/" . $new_photo);
            $old_photo = $new_photo;
        }
    
    
        $extArray = explode('.', $old_photo);
        $ext = end($extArray);
        $new_photo_with_new_b_name = $_POST['b_name'] . "." . $ext;
    
        $arr = [
            'id' => $id,
            'password' => $password,
            'companyname' => $b_name,
            'ceoname' => $ceo_name,
            'mobilenumber' => $b_mobile,
            'phonenumber' => $b_phone,
            'faxnumber' => $b_fax,
            'email' => $email,
            'zipcode' => $zipcode,
            'address' => $addr,
            'detailaddress' => $detail_addr,
            'businessregistrationnumber' => $b_number,
            'businessregistrationimage' => (!empty($new_photo)) ? $new_photo : $old_photo,
            'businesstype' => $b_type,
            'businesscategory' => $b_category
        ];
    
        $result = $bmem->admin_to_business_member_edit($arr);
    
        if ($result['success']) {
            die(json_encode(['result' => 'success']));
        } else {
            die(json_encode(['result' => 'fail', 'message' => $result['error']]));
        }
    } else if ($mode == 'business_edit') {
        session_start();

        $old_photo = (isset($_POST['old_photo']) && $_POST['old_photo'] != '') ? $_POST['old_photo'] : '';
        $old_b_name = (isset($_POST['old_b_name']) && $_POST['old_b_name'] != '') ? $_POST['old_b_name'] : '';
    
        // Check if b_name has changed
        if ($old_b_name != $b_name) {
            // Rename the old image file
            if (!empty($old_photo) && file_exists("./data/business_image/" . $old_photo)) {
                $extArray = explode('.', $old_photo);
                $ext = end($extArray);
                $new_photo_with_new_b_name = $b_name . "." . $ext;
                rename("../data/business_image/" . $old_photo, "./data/business_image/" . $new_photo_with_new_b_name);
                $old_photo = $new_photo_with_new_b_name;
            }
        }
    
        // Handle new image file
        if (!empty($_FILES['photo']['name'])) {
            // Delete the old image file
            if (!empty($old_photo) && file_exists("./data/business_image/" . $old_photo)) {
                unlink("./data/business_image/" . $old_photo);
            }
    
            // Process the new image file
            $extArray = explode('.', $_FILES['photo']['name']);
            $ext = end($extArray);
            $new_photo = $b_name . "." . $ext;
            move_uploaded_file($_FILES['photo']['tmp_name'], "./data/business_image/" . $new_photo);
            $old_photo = $new_photo;
        }
    
    
        $extArray = explode('.', $old_photo);
        $ext = end($extArray);
        $new_photo_with_new_b_name = $_POST['b_name'] . "." . $ext;
    
        $arr = [
            'id' => $id,
            'password' => $password,
            'companyname' => $b_name,
            'ceoname' => $ceo_name,
            'mobilenumber' => $b_mobile,
            'phonenumber' => $b_phone,
            'faxnumber' => $b_fax,
            'email' => $email,
            'zipcode' => $zipcode,
            'address' => $addr,
            'detailaddress' => $detail_addr,
            'businessregistrationnumber' => $b_number,
            'businessregistrationimage' => (!empty($new_photo)) ? $new_photo : $old_photo,
            'businesstype' => $b_type,
            'businesscategory' => $b_category
        ];
    
        $result = $bmem->business_member_edit($arr);
    
        if ($result['success']) {
            die(json_encode(['result' => 'success']));
        } else {
            die(json_encode(['result' => 'fail', 'message' => $result['error']]));
        }
    }
?>