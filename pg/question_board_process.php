<?php
include "../inc/dbconfig.php";

$db = $pdo;

include '../inc/Questionboard.php';

$board = new Board($db);

$name = (isset($_POST['name']) && $_POST['name'] != '') ? $_POST['name'] : '';
$password = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] : '';
$email = (isset($_POST['email']) && $_POST['email'] != '') ? $_POST['email'] : '';
$tel = (isset($_POST['tel']) && $_POST['tel'] != '') ? $_POST['tel'] : '';
$title = (isset($_POST['title']) && $_POST['title'] != '') ? $_POST['title'] : '';
$content = (isset($_POST['content']) && $_POST['content'] != '') ? $_POST['content'] : '';
$attachment = (isset($_POST['attachment']) && $_POST['attachment'] != '') ? $_POST['attachment'] : '';
$mode = (isset($_POST['mode']) && $_POST['mode'] != '') ? $_POST['mode'] : '';

if ($mode == 'board_input') {
    if ($name == '') {
        die(json_encode(['result' => 'empty_name']));
    }
    
    if ($password == '') {
        die(json_encode(['result' => 'empty_password']));
    }
    
    if ($email == '') {
        die(json_encode(['result' => 'empty_email']));
    }
    
    if ($tel == '') {
        die(json_encode(['result' => 'empty_tel']));
    }
    
    if ($title == '') {
        die(json_encode(['result' => 'empty_title']));
    }
    
    if ($content == '') {
        die(json_encode(['result' => 'empty_content']));
    }
    
    if ($mode == '') {
        die(json_encode(['result' => 'empty_mode']));
    }

    $upload_dir = "../data/board_attachment/";

    $uploadedFiles = array();

    if (isset($_FILES['files']['name']) && is_array($_FILES['files']['name'])) {
        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            // 파일이 첨부되어 있는지 확인
            if (!empty($_FILES['files']['name'][$i])) {
                $filename = $_FILES['files']['name'][$i];
                $tmp_name = $_FILES['files']['tmp_name'][$i];
    
                // 파일 확장자 확인
                $extArray = explode('.', $filename);
                $ext = end($extArray);
    
                // 확장자가 허용 목록에 있는지 확인
                $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                if (in_array(strtolower($ext), $allowedExtensions)) {
                    // 허용되는 확장자일 경우 파일을 지정된 디렉토리로 복사
                    $newFilename = $name . '-' . ($i + 1) . '.' . $ext;
                    if (move_uploaded_file($tmp_name, $upload_dir . $newFilename)) {
                        $uploadedFiles[] = $newFilename; // 업로드된 파일명을 배열에 추가
                    } else {
                        // 파일 업로드 실패
                        die("File upload failed");
                    }
                } else {
                    // 확장자가 허용 목록에 없는 경우
                    die("File extension not allowed");
                }
            }
        }
    }
    
    

    $arr = [
        'name' => $name,
        'password' => $password,
        'email' => $email,
        'phone_number' => $tel,
        'title' => $title,
        'content' => $content,
        'attachment' => $uploadedFiles
    ];

    try {
        $result = $board->input($arr);

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
} else if ($mode == 'board_password_chk') {
    $idx = (isset($_POST['idx']) && $_POST['idx'] != '') ? $_POST['idx'] : '';
    
    if ($idx == '') {
        die(json_encode(['result' => 'empty_idx']));
    };

    if ($password == '') {
        die(json_encode(['result' => 'empty_password']));
    };

    if ($board->verifyPasswordById($idx, $password)) {
        die(json_encode(['result' => 'success']));
    } else {
        die(json_encode(['result' => 'fail']));
    }
}
?>