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

    include "../inc/businessmember.php";
    include "../inc/lib.php";   


    $sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
    $sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

    $bmem = new BusinessMemeber($db);

    $paramArr = [ 'sn' => $sn, 'sf' => $sf];

    $total = $bmem->total($paramArr);
    $limit = 5;
    $page_limit = 5;
    $page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

    $param = ''; 

    $bmemArr = $bmem->list($page, $limit, $paramArr);
    // print_r($bmemArr);
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
    <script src="./js/admin_business_member.js"></script>
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
                <h3>사업자 회원관리</h3>
            </div>
            <table class="mt-3 table table-border">
                <tr>
                    <th>번호</th>
                    <th>아이디</th>
                    <th>회사명</th>
                    <th>대표명</th>
                    <th>이메일</th>
                    <th>사업자번호</th>
                    <th>등록일시</th>
                    <th>관리</th>
                </tr>
                <?php
            foreach($bmemArr AS $row){
                // [IDX] => 24 
                // [ID] => test33 
                // [CompanyName] => 삼성 
                // [CEOName] => 이재용 
                // [PhoneNumber] => 010-8564-4780 
                // [MobileNumber] => 010-8564-4780 
                // [FaxNumber] => 010-8564-4780 
                // [Email] => samsung@gmail.com 
                // [ZipCode] => 13529 
                // [Address] => (백현동, 카카오 판교 아지트) 
                // [DetailAddress] => 2층 
                // [BusinessRegistrationNumber] => 33333333 
                // [BusinessRegistrationImage] => 삼성.png 
                // [BusinessType] => 김민종 
                // [BusinessCategory] => 김민종 
                // [SignupDate] => 2024-03-04 17:08:12 ) 
            $row['SignupDate'] = substr($row['SignupDate'], 0, 16);
        ?>
                <tr>
                    <td><?= $row['IDX']; ?></td>
                    <td><?= $row['ID']; ?></td>
                    <td><?= $row['CompanyName']; ?></td>
                    <td><?= $row['CEOName']; ?></td>
                    <td><?= $row['Email']; ?></td>
                    <td><?= $row['BusinessRegistrationNumber']; ?></td>
                    <td><?= $row['SignupDate']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm btn_mem_edit" data-idx="<?= $row['IDX']; ?>">수정</button>
                        <button class="btn btn-danger btn-sm btn_mem_delete" data-idx="<?= $row['IDX']; ?>">삭제</button>
                    </td>
                </tr>
                <?php
            }
        ?>
            </table>
            <div class=" container mt-3 d-flex gap-2 w-50">
                <select class="form-select w-25" name="sn" id="sn">
                    <option value="1">아이디</option>
                    <option value="2">이메일</option>
                    <option value="3">회사이름</option>
                    <option value="4">대표자이름</option>
                    <option value="5">번호</option>
                </select>
                <input type="text" class="form-control w-25" id="sf" name="sf">
                <button class="btn btn-primary w-25" id="btn_search">검색</button>
                <button class="btn btn-success w-25" id="btn_all">전체목록</button>
                <button class="btn btn-primary" id="btn_excel">엑셀로 저장</button>

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