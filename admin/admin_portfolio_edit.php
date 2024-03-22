<?php
    include "../inc/common.php";

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/portfolio.php";

    $port = new Portfolio($db);

    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    };

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    };
    
    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $row = $port->getInfoFormIdx($idx);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/admin_main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="./js/admin_portfolio_edit.js"></script>
</head>

<body>
    <div class="area"></div>
    <nav class="main-menu">
        <ul>
            <li>
                <a href="./admin_main.php">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="nav-text">
                        메인
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_member.php">
                    <i class="fa fa-globe fa-2x"></i>
                    <span class="nav-text">
                        회원관리
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_business_member.php">
                    <i class="fa fa-comments fa-2x"></i>
                    <span class="nav-text">
                        사업자 회원 관리
                    </span>
                </a>

            </li>
            <li class="has-subnav">
                <a href="./admin_qna.php">
                    <i class="fa fa-camera-retro fa-2x"></i>
                    <span class="nav-text">
                        문의 관리
                    </span>
                </a>

            </li>
            <li>
                <a href="./admin_board.php">
                    <i class="fa fa-film fa-2x"></i>
                    <span class="nav-text">
                        게시판 관리
                    </span>
                </a>
            </li>
            <li>
                <a href="./admin_portfolio.php">
                    <i class="fa fa-book fa-2x"></i>
                    <span class="nav-text">
                        포트폴리오 관리
                    </span>
                </a>
            </li>
        </ul>
        <ul class="logout">
            <li>
                <a href="?logout=1">
                    <i class="fa fa-power-off fa-2x"></i>
                    <span class="nav-text">
                        로그아웃
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <div id="main_wrap">
        <!-- [idx] => 18
        [Category] => ect
        [Name] => ect_3
        [description] =>
        [ImageRoute] => ect_3.png
        [UploadDate] => -->
        <main class="container">
            <h1 class="text-center h1 mt-5">포트폴리오 입력하기</h1>
            <form name="input_form" method="post" enctype="multipart/form-data" autocomplete="off" action="">
                <input type="hidden" name="mode" value="input">
                <input type="hidden" name="old_name" id="old_name" value="<?= $row['Name'] ?>">
                <input type="hidden" name="old_images" id="old_images" value="<?= $row['ImageRoute'] ?>">
                <div class="w-100 mt-3">
                    <label for="choice_category">카테고리</label>
                    <?php
                        $Cate = $row['Category'];
                    ?>
                    <select name="choice_category" id="choice_category" class="form-select">
                        <option value="all">카테고리</option>
                        <option value="광고·편집" <?= ($Cate == 'add') ? 'selected' : '' ?>>광고 편집</option>
                        <option value="비쥬얼아이덴티티" <?= ($Cate == 'visual') ? 'selected' : '' ?>>비쥬얼아이덴티티</option>
                        <option value="환경디자인" <?= ($Cate == 'environmental_design') ? 'selected' : '' ?>>
                            환경디자인</option>
                        <option value="웹디자인" <?= ($Cate == 'web_design') ? 'selected' : '' ?>>웹디자인</option>
                        <option value="기타" <?= ($Cate == 'other') ? 'selected' : '' ?>>기타</option>
                    </select>
                </div>
                <div class="d-flex w-100">
                    <div class="w-100">
                        <label for="name" class="form-label mt-3">프로젝트 이름</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="이름을 입력해 주세요."
                            value="<?= $row['Name'] ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="description" class="form-label mt-3">설명</label>
                    <textarea name="description" id="description" class="form-control" rows="4"
                        placeholder="첫번째 설명을 입력해 주세요."><?= $row['description'] ?></textarea>
                </div>
                <div class="mt-3 d-flex flex-column gap-5">
                    <div>
                        <label for="detail_photo" class="form-label">디테일 이미지</label>
                        <input type="file" name="detail_photo" id="detail_photo" class="form-control" multiple>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2 mt-5">
                    <button id="btn_submit" class="btn btn-primary w-50" type="button">확인</button>
                    <button id="btn_cancel" class="btn btn-secondary w-50" type="button">취소</button>
                </div>
            </form>
        </main>
    </div>
</body>

</html>