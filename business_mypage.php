<?php
include './header.php';
?>
<?php

// include "./inc/common.php";

include "./inc/dbconfig.php";

$db = $pdo;

include "./inc/businessmember.php";

$bmem = new BusinessMemeber($db);


if ($ses_id == '') {
    echo "<script>
            alert('로그인해주세요');
            window.location.href = './login.php';
        </script>";
};

if ($ses_grade != 'business_member') {
    echo "<script>
            alert('잘못된 접근');
            window.location.href = './index.php';
        </script>";
};

$row = $bmem->getInfoFormId($ses_id);
// print_r($row); 
?>




<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="./js/business_mypage.js"></script>
<?php
$filename = basename(__FILE__, '.php');
?>

<section class="portfolioPage">
    <div id="Title" class="">
        <?php
        include 'pageTitle.php';

        $title = "마이페이지";
        $subtitle = "";
        $filename = "mypage";
        $textColor = "";

        render_header($title, $subtitle, $filename, $textColor);
        ?>
    </div>
</section>
<div class="m-auto w-4/5 md:w-1/2 pt-20">
    <h1 class="font-bold text-4xl py-4 border-b-[3px] border-black">마이페이지</h1>

</div>
<div class="pt-10  m-auto w-4/5 sm:w-1/2">
    <input type="hidden" name="idx" value="<?= $row['IDX']; ?>">
    <input type="hidden" name="id_chk" id="id_chk" value="0">
    <input type="hidden" name="email_chk" id="email_chk" value="0">
    <input type="hidden" name="old_email" id="old_email" value="<?= $row['Email']; ?>">
    <input type="hidden" name="old_bnum" id="old_bnum" value="<?= $row['BusinessRegistrationNumber']; ?>">
    <input type="hidden" name="old_photo" id="old_photo" value="<?= $row['BusinessRegistrationImage']; ?>">
    <input type="hidden" id="old_b_name" name="old_b_name" value="<?= $row['CompanyName']; ?>">
    <input type="hidden" name="business_number_chk" id="business_number_chk" value="0">
    <div id="inputform">
        <input type="hidden" name="id_chk" id="id_chk" value="0">
        <input type="hidden" name="email_chk" id="email_chk" value="0">
        <input type="hidden" name="business_number_chk" id="business_number_chk" value="0">

        <div class="flex max-[369px]:block ">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="business_member_id">아이디 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <div class="flex justify-between gap-1 max-[369px]:block max-[369px]:space-y-2 ">
                    <input class="rounded-md border-[#D9D9D9] w-full max-[369px]:w-full " type="text" name="id" id="business_member_id" value="<?= $row['ID'] ?>" readonly>
                    <!-- <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 max-[369px]:w-full" id="btn_member_id_check" type="button">아이디 중복확인</button> -->
                </div>
                <p class="text-[#7D7D7D] text-xs">(영문소문자/숫자, 4~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="business_member_password">비밀번호<p class="text-red-600">*</p></label></div class="w-1/5 max-[369px]:w-full">
            <div class="w-full">
                <input class="w-full rounded-md border-[#D9D9D9]" type="password" name="password" id="business_member_password">
                <p class="text-[#7D7D7D] text-xs">(영문 대소문자/숫자/특수문자 중 2가지 이상 조합, 8자~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="business_member_password_chk">비밀번호확인 <p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="password" name="password_chk" id="business_member_password_chk">
        </div>


        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="company_name">회사명 <p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="text" name="companyname" id="company_name" value="<?= $row['CompanyName'] ?>">
        </div>

        <div class="flex mt-4 max-[369px]:block space-x-1">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="business_registration_number">사업자 등록 번호 <p class="text-red-600">*</p></label></div>
            <input class="rounded-md border-[#D9D9D9] w-4/6 max-[369px]:w-full " type="text" name="business_registration_number" id="business_registration_number" placeholder="ex) 00000000 (-없이 입력)" value="<?= $row['BusinessRegistrationNumber'] ?>">
            <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 max-[369px]:w-full" id="btn_business_number_chk" type="button">중복확인</button>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="business_type">업태 <p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="text" name="business_type" id="business_type" value="<?= $row['BusinessType'] ?>">
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="business_category">종목 <p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="text" name="business_category" id="business_category" value="<?= $row['BusinessCategory'] ?>">
        </div>

        <div class="flex mt-4 max-[369px]:block" id="emailWrap">
        <?php

        $email = $row['Email'];
        $parts = explode('@', $email);
        $beforeAtSymbol = $parts[0];
        $domain = $parts[1];

        ?>
            <div class="w-1/5"><label class="flex pt-2" for="business_member_email">이메일<p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <div class="flex justify-between items-center gap-4 max-[369px]:block">
                    <input class="w-1/4 max-[369px]:w-1/3  rounded-md border-[#D9D9D9]" type="text" id="business_member_email" name="email" value="<?= $beforeAtSymbol ?>">@
                    <input class="w-1/4 max-[369px]:w-1/3  rounded-md border-[#D9D9D9]" type="text" id="manual_email_input" value="<?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? $domain : '' ?>">
                    <select class="w-1/4 max-[369px]:w-1/3  rounded-md border-[#D9D9D9]" name="email_domain" id="email_domain">
                        <option value="gmail.com" <?= ($domain == 'gmail.com') ? 'selected' : '' ?>>gmail.com</option>
                        <option value="naver.com" <?= ($domain == 'naver.com') ? 'selected' : '' ?>>naver.com</option>
                        <option value="kakao.com" <?= ($domain == 'kakao.com') ? 'selected' : '' ?>>kakao.com</option>
                        <option value="hanmail.net" <?= ($domain == 'hanmail.net') ? 'selected' : '' ?>>hanmail.net</option>
                        <option value="manual_input" <?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? 'selected' : '' ?>>직접입력</option>
                    </select>
                </div>
                <button class="mt-2 rounded-md bg-[#182548] w-full text-white font-bold text-base py-2 px-3 " id="btn_member_email_check" type="button">이메일 중복확인</button>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="ceo_name">이름<p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="text" name="ceoname" id="ceo_name" value="<?= $row['CEOName'] ?>">
        </div>

        <div class="flex mt-4 max-[369px]:block" id="mobileWrap">
        <?php
        $mobileNumber = $row['MobileNumber'];
        $mparts = explode('-', $mobileNumber);
        ?>
            <div class="w-1/5 pt-2 max-[369px]:w-full"><label for="member_mobile">전화 번호</label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="business_member_mobile" name="member_mobile" pattern="[0-9]{3}" value="<?= $mparts[0] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="business_member_mobile2" name="member_mobile2" pattern="[0-9]{4}" value="<?= $mparts[1] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="business_member_mobile3" name="member_mobile3" pattern="[0-9]{4}" value="<?= $mparts[2] ?>">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="phoneWrap">
        <?php
        $phoneNumber = $row['PhoneNumber'];
        $pparts = explode('-', $phoneNumber);
        ?>
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">휴대전화 <p class="text-red-600">*</p></label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="business_member_phone" name="member_phone" pattern="[0-9]{3}" value="<?= $pparts[0] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="business_member_phone2" name="member_phone2" pattern="[0-9]{4}" value="<?= $pparts[1] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="business_member_phone3" name="member_phone3" pattern="[0-9]{4}" value="<?= $pparts[2] ?>">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="Wrap">
        <?php
        $faxNumber = $row['FaxNumber'];
        $fparts = explode('-', $faxNumber);
        ?>
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">팩스번호 </label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="business_member_fax" name="member_phone" pattern="[0-9]{3}" value="<?= $fparts[0] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="business_member_fax2" name="member_phone2" pattern="[0-9]{4}" value="<?= $fparts[1] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="business_member_fax3" name="member_phone3" pattern="[0-9]{4}" value="<?= $fparts[2] ?>">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="addressWrap">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">주소 <p class="text-red-600">*</p></label></div>
            <div class="w-full space-y-2">
                <div class="flex justify-between">
                    <input class=" w-3/5 rounded-md border-[#D9D9D9]" type="text" name="zipcode" id="member_zipcode" readonly value="<?= $row['ZipCode'] ?>">
                    <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 " id="btn_zipicode" type="button">우편번호 찾기</button>
                </div>

                <div class="w-full">
                    <input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr1" id="member_addr1" placeholder="" value="<?= $row['Address'] ?>">

                </div>

                <div class="w-full"><input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요" value="<?= $row['DetailAddress'] ?>"></div>

            </div>
        </div>


        <div class="flex mt-4 max-[369px]:block" id="imageWrap">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="business_image">사업자 등록증<p class="text-red-600">*</p></label></div>
            <input type="file" name="business_image" id="business_image">
            <img src="./data/business_image/<?= $row['BusinessRegistrationImage'] ?>" alt="" width="300px">
        </div>
        <button class="w-full rounded-md bg-mblack text-white font-bold text-xl p-3 my-8" type="button" id="input_submit">수정하기</button>
    </div>

</div>

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


<?php
include './footer.php';
?>

