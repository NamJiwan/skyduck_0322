<?php
    session_start();

    $ses_id = (isset($_SESSION['ses_id']) && $_SESSION['ses_id'] != '') ? $_SESSION['ses_id'] : '';

    // 로그아웃 로직
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

    include "../inc/portfolio.php";
    include "../inc/lib.php";

    $sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
    $sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

    $port = new Portfolio($db);

    $paramArr = [ 'sn' => $sn, 'sf' => $sf];

    $total = $port->total($paramArr);
    $limit = 5;
    $page_limit = 5;
    $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

    $param = ''; 

    $portArr = $port->list($page, $limit, $paramArr);
    // print_r($portArr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/admin_main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="./js/admin_portfolio.js"></script>
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
        <main class="border rounded-2 p-5" style="height: calc(100vh - 257px);">
            <div class="container">
                <h3>회원관리</h3>
            </div>
            <table class="mt-3 table table-border">
                <tr>
                    <th>번호</th>
                    <th>프로젝트이름</th>
                    <th>카테고리</th>
                    <th>등록일시</th>
                    <th>관리</th>
                </tr>
                <?php
            foreach($portArr AS $row){
            // 2023-11-11 11:11:11
                $row['UploadDate'] = substr($row['UploadDate'], 0, 16);
        ?>
                <tr>
                    <td><?= $row['idx']; ?></td>
                    <td><?= $row['Name']; ?></td>
                    <td><?= $row['Category']; ?></td>
                    <td><?= $row['UploadDate']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm btn_mem_edit" data-idx="<?= $row['idx']; ?>">수정</button>
                        <button class="btn btn-danger btn-sm btn_mem_delete" data-idx="<?= $row['idx']; ?>">삭제</button>
                    </td>
                </tr>
                <?php
            }
        ?>
            </table>
            <div class=" container mt-3 d-flex gap-2 w-50">
                <select class="form-select w-25" name="sn" id="sn">
                    <option value="1">이름</option>
                    <option value="2">번호</option>
                    <option value="3">카테고리</option>
                </select>
                <input type="text" class="form-control w-25" id="sf" name="sf">
                <button class="btn btn-primary w-25" id="btn_search">검색</button>
                <button class="btn btn-success w-25" id="btn_all">전체목록</button>
                <button class="btn btn-primary" id="btn_excel">엑셀로 저장</button>
                <button class="btn btn-primary" id="btn_input">글쓰기</button>

            </div>
            <div class="d-flex mt-3 justify-content-between align-items-start">
                <?php

        if(isset($sn) && $sn != '' && isset($sf) && $sf != ''){      
            $param = '&sn='. $sn.'&sf='. $sf;
        }
        
        echo my_pagination($total, $limit, $page_limit, $page, $param);
        ?>

            </div>

        </main>


    </div>
</body>

</html>