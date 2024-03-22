<?php
include "./../inc/common.php";

if ($ses_id == '' || $ses_grade != 'admin') {
    $arr = ['result' => 'access_denied'];
    die(json_encode($arr));
}

include './../inc/dbconfig.php';

$db = $pdo;

include '../inc/Questionboard.php';

$idx = (isset($_POST['idx']) && $_POST['idx'] != '' && is_numeric($_POST['idx'])) ? $_POST['idx'] : '';

if ($idx == '') {
    $arr = ['result' => 'empty_idx'];
    json_encode($arr);
}

$board = new Board($db);

// 이미지 파일 목록 가져오기
$imageList = $board->getImageList($idx);

// 이미지 파일 삭제
foreach ($imageList as $imageName) {
    $imagePath = "../data/board_attachment/{$imageName}";

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// 포트폴리오 데이터 삭제
$board->member_del($idx);

$arr = ['result' => 'success'];
die(json_encode($arr));
?>