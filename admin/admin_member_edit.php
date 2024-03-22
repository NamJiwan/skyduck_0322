<?php
    include "../inc/common.php";

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/member.php";

    $mem = new Member($db);

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
    }

    $row = $mem->getInfoFormIdx($idx);
    // print_r($row); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MemberInput</title>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/main.css">

</head>

<body>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="./js/admin_member_edit.js"></script>
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
    <div id="inputform">
        <!-- Array ( [IDX] => 1 [ID] => znqptkzp [Password] => $2y$10$WIwOEqcAyCDtWmq6Th/.auHtKJKlMzQIUl9Aao/Ed1YPeiw.AINBW
        [Email] => znqptkzp@gmail.com [Name] => 정강우 [MobileNumber] => 010-8564-4780 [PhoneNumber] => 010-8564-4780
        [ZipCode] => 13529 [Address] => (백현동, 카카오 판교 아지트) [DetailAddress] => 2층 [SignupDate] => 2024-01-31 02:30:16 ) -->

        <input type="hidden" name="idx" value="<?= $row['IDX']; ?>">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <input type="hidden" name="old_email" id="old_email" value="<?= $row['Email']; ?>">

        <label for="member_id">아이디</label>
        <input type="text" name="id" id="member_id" value="<?= $row['ID'] ?>" placeholder="아이디를 입려해 주세요" readonly>
        <label for="member_password">비밀번호</label>
        <input type="password" name="password" id="member_password" placeholder="비밀번호를 입력해 주세요">
        <label for="member_password_check">비밀번호확인</label>
        <input type="password" name="password_check" id="member_password_check" placeholder="비밀번호를 다시 입력해 주세요">
        <div id="emailWrap">
            <label for="member_email">이메일</label>
            <?php
        $email = $row['Email'];
        $parts = explode('@', $email);
        $beforeAtSymbol = $parts[0];
        $domain = $parts[1];
    ?>
            <input type="text" id="member_email" name="email" value="<?= $beforeAtSymbol ?>" placeholder="이메일을 입력해주세요">

            <select name="email_domain" id="email_domain">
                <option value="gmail.com" <?= ($domain == 'gmail.com') ? 'selected' : '' ?>>gmail.com</option>
                <option value="naver.com" <?= ($domain == 'naver.com') ? 'selected' : '' ?>>naver.com</option>
                <option value="kakao.com" <?= ($domain == 'kakao.com') ? 'selected' : '' ?>>kakao.com</option>
                <option value="hanmail.net" <?= ($domain == 'hanmail.net') ? 'selected' : '' ?>>hanmail.net</option>
                <option value="manual_input"
                    <?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? 'selected' : '' ?>>
                    직접입력</option>
            </select>

            <input type="text" id="manual_email_input"
                value="<?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? $domain : '' ?>"
                placeholder="이메일을 입력해 주세요">

            <button id="btn_member_email_check" type="button">이메일 중복확인</button>
        </div>

        <label for="member_name">이름</label>
        <input type="text" name="name" id="member_name" placeholder="이름을 입력해 주세요" value="<?= $row['Name'] ?>">
        <div id="mobileWrap">
            <?php
                $mobileNumber = $row['MobileNumber'];
                $mparts = explode('-', $mobileNumber);
            ?>
            <label for="member_mobile">전화 번호</label>
            <input type="text" id="member_mobile" name="member_mobile" pattern="[0-9]{3}" value="<?= $mparts[0] ?>"> -
            <input type="text" id="member_mobile2" name="member_mobile2" pattern="[0-9]{4}" value="<?= $mparts[1] ?>"> -
            <input type="text" id="member_mobile3" name="member_mobile3" pattern="[0-9]{4}" value="<?= $mparts[2] ?>">
        </div>
        <div id="phoneWrap">
            <label for="member_phone">휴대전화 번호</label>
            <?php
                $phoneNumber = $row['PhoneNumber'];
                $pparts = explode('-', $phoneNumber);
            ?>
            <input type="text" id="member_phone" name="member_phone" pattern="[0-9]{3}" value="<?= $pparts[0] ?>"> -
            <input type="text" id="member_phone2" name="member_phone2" pattern="[0-9]{4}" value="<?= $pparts[1] ?>"> -
            <input type="text" id="member_phone3" name="member_phone3" pattern="[0-9]{4}" value="<?= $pparts[2] ?>">
        </div>
        <div id="addressWrap">
            <label for="member_zipcode">우편번호</label>
            <input type="text" name="zipcode" id="member_zipcode" readonly value="<?= $row['ZipCode']; ?>">
            <button id="btn_zipicode" type="button">우편번호 찾기</button>
            <div class="w-50">
                <label for="member_addr1">주소</label>
                <input type="text" name="member_addr1" id="member_addr1" placeholder="" value="<?= $row['Address']; ?>">
            </div>
            <div class="w-50">
                <label for="member_addr2">상세주소</label>
                <input type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요"
                    value="<?= $row['DetailAddress'] ?>">
            </div>
        </div>
        <div id="buttonwrap">
            <button id="edit_btn" type="button">수정 확인</button>
        </div>
    </div>
</body>

</html>