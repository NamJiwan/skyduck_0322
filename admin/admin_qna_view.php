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

    include "../inc/qna.php";
    include "../inc/lib.php";   

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $qna = new Qna($db);

    $row = $qna->getInfoFormIdx($idx);
    // print_r($row);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/admin_main.css">
    <link rel="stylesheet" href="./css/admin_qna_view.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</head>

<body>
    <script src="./js/admin_qna_view.js"></script>
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
        <!-- [idx] => 12
        [name] => 정강우
        [contact_number] => 01011111111
        [email] => aaaa@gmail.com
        [company_name] => 스카이덕
        [position] => 사장
        [website] => skyduck.com
        [service_required] => "Catalog\/Brochure,on"
        [budget] => 1.00
        [timeline] => 1주일
        [additional_notes] => 안녕하세요
        [created_at] => 2024-03-08 11:33:26 -->
        <div>
            <h2>상담에 필요한 기본정보</h2>
            <label for="qna_name">이름</label>
            <input type="text" id="qna_name" placeholder="이름" value="<?= $row['name'] ?>" readonly>
            <label for="qna_tel">연락처</label>
            <input type="tel" id="qna_tel" placeholder="연락처(-없이 입력)" value="<?= $row['contact_number'] ?>" readonly>
            <label for="qna_email">이메일</label>
            <input type="email" id="qna_email" placeholder="이메일" value="<?= $row['email'] ?>" readonly>
            <label for="qna_company_name">회사명</label>
            <input type="text" id="qna_company_name" placeholder="회사명" value="<?= $row['company_name'] ?>" readonly>
            <label for="qna_grade">직급</label>
            <input type="text" id="qna_grade" placeholder="직급" value="<?= $row['position'] ?>" readonly>
            <label for="qna_user_page">홈페이지</label>
            <input type="text" id="qna_user_page" placeholder="홈페이지" value="<?= $row['website'] ?>" readonly>
        </div>
        <hr>
        <div>
            <h2>요구서비스</h2>
            <?php
                $service_required = explode(',', $row['service_required']);
                // Remove 'on' from each service
                // $service_required = array_map(function($service) {
                //     return str_replace('/on', '', $service);
                // }, $service_required);
                // print_r($service_required);
            ?>
            <input type="checkbox" value="CatalogBrochure"
                <?= in_array("\"CatalogBrochure", $service_required) ? 'checked' : '' ?> disabled>카타로그/브로슈어
            <input type="checkbox" value="LeafletPamphlet"
                <?= in_array("LeafletPamphlet", $service_required) ? 'checked' : '' ?> disabled>리플렛/팜플릿
            <input type="checkbox" value="Poster" <?= in_array("Poster", $service_required) ? 'checked' : '' ?>
                disabled>포스터
            <input type="checkbox" value="Package" <?= in_array("Package", $service_required) ? 'checked' : '' ?>
                disabled>패키지
            <input type="checkbox" value="NewsletterBook"
                <?= in_array("NewsletterBook", $service_required) ? 'checked' : '' ?> disabled>사보/책
            <input type="checkbox" value="Advertisement"
                <?= in_array("Advertisement", $service_required) ? 'checked' : '' ?> disabled>지면광고
            <input type="checkbox" value="RFP" <?= in_array("RFP", $service_required) ? 'checked' : '' ?> disabled>제안서
            <input type="checkbox" value="Others" <?= in_array("Others", $service_required) ? 'checked' : '' ?>
                disabled>기타
        </div>
        <hr>
        <div>
            <h2>예산과 일정</h2>
            <label for="qna_budget">예산</label>
            <input type="text" id="qna_budget" placeholder="예산을 입력해 주세요" value="<?= $row['budget'] ?>">
            <label for="qna_schedule">일정</label>
            <input type="text" id="qna_schedule" placeholder="일정을 입력해 주세요" value="<?= $row['timeline'] ?>">
        </div>
        <hr>
        <div>
            <h2>요구사항</h2>
            <textarea name="qna_content" id="qna_content" cols="100" rows="10" placeholder="
        제목: ex 카탈로그/브로슈어, 리플렛/팜플렛, 포스터, 제안서 등 
        사이즈: 
        페이지 수:
        인쇄 부수:
        추가설명: ex 종이종류 및 재질/코팅유무/후가공 등
        " readonly><?= $row['additional_notes'] ?></textarea>
        </div>
        <button type="button" id="qna_submit">뒤로</button>
    </div>
</body>

</html>