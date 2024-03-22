<?php
    include "../inc/common.php";

    include "../inc/dbconfig.php";

    $db = $pdo;

    include "../inc/businessmember.php";

    $bmem = new BusinessMemeber($db);

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

    $row = $bmem->getInfoFormIdx($idx);
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
    <script src="./js/admin_business_member_edit.js"></script>
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
        <!-- [IDX] => 6 
    [ID] => skawldhkstest 
    [Password] => $2y$10$sRT8KM4r9fnT1WhqLGGXlO7V3xve4PDR6cl..W6PehOrskjVRrjla 
    [CompanyName] => wldhks 
    [CEOName] => wldhks 
    [PhoneNumber] => 02202-221-3321 
    [MobileNumber] => 010-22-21 
    [FaxNumber] => 010-223-11 
    [Email] => wldhks@gmail.com 
    [ZipCode] => 41937 
    [Address] => (동성로3가) 
    [DetailAddress] => 동성로3가 
    [BusinessRegistrationNumber] => 010022 
    [BusinessRegistrationImage] => wldhks.png 
    [BusinessType] => 임의종목 
    [BusinessCategory] => 임의종목 
    [SignupDate] => 2024-02-29 14:49:34 -->
        <input type="hidden" name="idx" value="<?= $row['IDX']; ?>">
        <input type="hidden" name="id_chk" id="id_chk" value="0">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <input type="hidden" name="old_email" id="old_email" value="<?= $row['Email']; ?>">
        <input type="hidden" name="old_bnum" id="old_bnum" value="<?= $row['BusinessRegistrationNumber']; ?>">
        <input type="hidden" name="old_photo" id="old_photo" value="<?= $row['BusinessRegistrationImage']; ?>">
        <input type="hidden" id="old_b_name" name="old_b_name" value="<?= $row['CompanyName']; ?>">
        <input type="hidden" name="business_number_chk" id="business_number_chk" value="0">
        <label for="business_member_id">아이디</label>
        <input type="text" name="id" id="business_member_id" placeholder="아이디를 입력해 주세요" value="<?= $row['ID'] ?>">
        <label for="business_member_password">비밀번호</label>
        <input type="password" name="password" id="business_member_password" placeholder="비밀번호를 입력해 주세요">
        <label for="business_member_password_chk">비밀번호확인</label>
        <input type="password" name="password_chk" id="business_member_password_chk" placeholder="확인용 비밀번호를 입력해 주세요">
        <label for="company_name">회사명</label>
        <input type="text" name="companyname" id="company_name" placeholder="회사명을 입력해 주세요"
            value="<?= $row['CompanyName'] ?>">
        <label for="ceo_name">대표명</label>
        <input type="text" name="ceoname" id="ceo_name" placeholder="대표명을 입력해주세요" value="<?= $row['CEOName'] ?>">
        <div id="emailWrap">
            <label for="business_member_email">이메일</label>
            <?php
        $email = $row['Email'];
        $parts = explode('@', $email);
        $beforeAtSymbol = $parts[0];
        $domain = $parts[1];
    ?>
            <input type="text" id="business_member_email" name="email" placeholder="이메일을 입력해주세요"
                value="<?= $beforeAtSymbol ?>">
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
        <div id="mobileWrap">
            <?php
                $mobileNumber = $row['MobileNumber'];
                $mparts = explode('-', $mobileNumber);
            ?>
            <label for="business_member_mobile">전화 번호</label>
            <input type="text" id="business_member_mobile" name="member_mobile" pattern="[0-9]{3}"
                value="<?= $mparts[0] ?>"> -
            <input type="text" id="business_member_mobile2" name="member_mobile2" pattern="[0-9]{4}"
                value="<?= $mparts[1] ?>"> -
            <input type="text" id="business_member_mobile3" name="member_mobile3" pattern="[0-9]{4}"
                value="<?= $mparts[2] ?>">
        </div>
        <div id="phoneWrap">
            <?php
                $phoneNumber = $row['PhoneNumber'];
                $pparts = explode('-', $phoneNumber);
            ?>
            <label for="business_member_phone">휴대전화 번호</label>
            <input type="text" id="business_member_phone" name="member_phone" pattern="[0-9]{3}"
                value="<?= $pparts[0] ?>"> -
            <input type="text" id="business_member_phone2" name="member_phone2" pattern="[0-9]{4}"
                value="<?= $pparts[1] ?>"> -
            <input type="text" id="business_member_phone3" name="member_phone3" pattern="[0-9]{4}"
                value="<?= $pparts[2] ?>">
        </div>
        <div id="Wrap">
            <?php
                $faxNumber = $row['FaxNumber'];
                $fparts = explode('-', $faxNumber);
            ?>
            <label for="business_member_fax">팩스 번호</label>
            <input type="text" id="business_member_fax" name="member_ㄴphone" pattern="[0-9]{3}"
                value="<?= $fparts[0] ?>"> -
            <input type="text" id="business_member_fax2" name="member_phone2" pattern="[0-9]{4}"
                value="<?= $fparts[1] ?>"> -
            <input type="text" id="business_member_fax3" name="member_phone3" pattern="[0-9]{4}"
                value="<?= $fparts[2] ?>">
        </div>
        <div id="addressWrap">
            <label for="member_zipcode">우편번호</label>
            <input type="text" name="zipcode" id="member_zipcode" readonly value="<?= $row['ZipCode'] ?>">
            <button id="btn_zipicode" type="button">우편번호 찾기</button>
            <div class="w-50">
                <label for="member_addr1">주소</label>
                <input type="text" name="member_addr1" id="member_addr1" placeholder="" value="<?= $row['Address'] ?>">
            </div>
            <div class="w-50">
                <label for="member_addr2">상세주소</label>
                <input type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요"
                    value="<?= $row['DetailAddress'] ?>">
            </div>
        </div>
        <label for="business_registration_number">사업자 등록 번호(-없이 입력)</label>
        <input type="text" name="business_registration_number" id="business_registration_number"
            placeholder="ex) 00000000" value="<?= $row['BusinessRegistrationNumber'] ?>">
        <button id="btn_business_number_chk" type="button">중복확인</button>
        <label for="business_type">업태</label>
        <input type="text" name="business_type" id="business_type" placeholder="업태를 입력해주세요"
            value="<?= $row['BusinessType'] ?>">
        <label for="business_category">업종</label>
        <input type="text" name="business_category" id="business_category" value="<?= $row['BusinessCategory'] ?>">
        <div id="imageWrap">
            <label for="business_image">사업자 등록증</label>
            <input type="file" name="business_image" id="business_image">
        </div>
        <button type="button" id="input_submit">확인</button>
    </div>
</body>

</html>