<?php
    // var_dump($_SERVER['DOCUMENT_ROOT']);
    
    session_start();

    $ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : '';

    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    }

    if ($ses_id != 'skyduck_admin') {
        echo "<script>
            alert('접근 권한 없음');
            window.location.href = './admin_login.php';
        </script>";
    }

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/Questionboard.php";
    include "../inc/reply.php";


    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $board = new Board($db);
    $reply = new Reply($db);


    $row = $board->getInfoFormIdx($idx);
    $replyrow = $reply->getInfoBoardIdx($idx);
    // print_r($replyrow);

    if (!empty($replyrow)) {
        die("
        <script>
            alert('답글이 존재합니다.');
            history.go(-1);
        </script>
    ");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <title>Document</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/admin_main.css">
    <link rel="stylesheet" href="./css/admin_reply_write.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="./js/admin_reply_write.js"></script>
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
        <div class="container text-center">
            <input type="hidden" id="target_idx" value="<?= $row['idx'] ?>">
            <div class="row">
                <div class="col">
                    <?= $row['idx'] ?>
                </div>
                <div class="col">
                    <?= $row['title'] ?>
                </div>
                <div class="col">
                    <?= $row['posting_time'] ?>
                </div>
            </div>
            <div class="pt-5 pb-5">
                <input type="text" name="subject" id="id_subject" class="form-control" placeholder="제목을 입력해 주세요."
                    autocomplete="off">
            </div>
            <div id="summernote"></div>
            <div class="mt-3 d-flex gap-2 justify-content-end">
                <button class="btn btn-primary" id="btn_write_submit">확인</button>
                <button class="btn btn-secondary" id="btn_board_list">목록</button>
            </div>
        </div>
    </div>
    <script>
    $('#summernote').summernote({
        placeholder: '내용을 입력해 주세요.',
        tabsize: 2,
        height: 500,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    </script>
</body>

</html>