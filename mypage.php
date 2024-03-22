<?php
include './header.php';
?>
<?php

// include "./inc/common.php";
include "./inc/dbconfig.php";

$db = $pdo;

include "./inc/member.php";

$mem = new Member($db);

if ($ses_id == '') {
    echo "<script>
            alert('로그인해주세요');
            window.location.href = './login.php';
        </script>";
};

if ($ses_grade != 'common_member') {
    echo "<script>
            alert('잘못된 접근');
            window.location.href = './index.php';
        </script>";
};

$memArr = $mem->getInfoFormId($ses_id);
// print_r($memArr);
?>

<?php
$email = $memArr['Email'];
$parts = explode('@', $email);
$beforeAtSymbol = $parts[0];
$domain = $parts[1];
?>
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

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="./js/mypage.js"></script>
<div class="m-auto w-4/5 md:w-1/2 pt-20">
    <h1 class="font-bold text-4xl py-4 border-b-[3px] border-black">마이페이지</h1>

</div>
<div class="pt-10 m-auto w-4/5 md:w-1/2 max-[1004px]:w-4/5">
    <div id="inputform">
    <input type="hidden" name="idx" value="<?= $memArr['IDX']; ?>">
    <input type="hidden" name="email_chk" id="email_chk" value="0">
    <input type="hidden" name="old_email" id="old_email" value="<?= $memArr['Email']; ?>">

        <div class="flex max-[369px]:block ">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_id">아이디 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <div class="flex justify-between gap-1 max-[369px]:block max-[369px]:space-y-2 ">
                    <input class="rounded-md border-[#D9D9D9] w-full max-[369px]:w-full " type="text" name="id" id="member_id" value="<?= $memArr['ID'] ?>" readonly>
                    <!-- <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 max-[369px]:w-full" id="btn_member_id_check" type="button">아이디 중복확인</button> -->
                </div>
                <p class="text-[#7D7D7D] text-xs">(영문소문자/숫자, 4~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_password">비밀번호 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <input class="w-full rounded-md border-[#D9D9D9]" type="password" name="password" id="member_password" placeholder="비밀번호를 입력해 주세요">
                <p class="text-[#7D7D7D] text-xs">(영문 대소문자/숫자/특수문자 중 2가지 이상 조합, 8자~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_password_check">비밀번호확인 <p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="password" name="password_check" id="member_password_check" placeholder="비밀번호를 다시 입력해 주세요">
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5"><label class="flex pt-2" for="member_email">이메일 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <div class="flex justify-between items-center gap-4 max-[369px]:block">
                    <input class="w-1/4 max-[369px]:w-1/3  rounded-md border-[#D9D9D9]" type="text" id="member_email" name="email" placeholder="이메일을 입력해주세요" value="<?= $beforeAtSymbol ?>">@
                    <input class="w-1/4  max-[369px]:w-1/4   rounded-md border-[#D9D9D9]" type="text" id="manual_email_input" placeholder="이메일을 입력해 주세요">
                    <select class="w-1/4  max-[369px]:w-1/3   rounded-md border-[#D9D9D9]" name="email_domain" id="email_domain">
                        <option value="manual_input" <?= (!in_array($domain, ['gmail.com', 'naver.com', 'kakao.com', 'hanmail.net'])) ? 'selected' : '' ?>>직접입력</option>
                        <option value="gmail.com" <?= ($domain == 'gmail.com') ? 'selected' : '' ?>>gmail.com</option>
                        <option value="naver.com" <?= ($domain == 'naver.com') ? 'selected' : '' ?>>naver.com</option>
                        <option value="kakao.com" <?= ($domain == 'kakao.com') ? 'selected' : '' ?>>kakao.com</option>
                        <option value="hanmail.net" <?= ($domain == 'hanmail.net') ? 'selected' : '' ?>>hanmail.net</option>
                    </select>
                </div>
                <button class="mt-2 rounded-md bg-[#182548] w-full text-white font-bold text-base py-2 px-3 " id="btn_member_email_check" type="button">이메일 중복확인</button>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_name">이름 <p class="text-red-600">*</p></label></div>
            <input class="rounded-md border-[#D9D9D9] w-full" type="text" name="name" id="member_name" placeholder="이름을 입력해 주세요" value="<?= $memArr['Name'] ?>">
        </div>

        <div class="flex mt-4 max-[369px]:block" id="mobileWrap">
            <?php
            $mobileNumber = $memArr['MobileNumber'];
            $mparts = explode('-', $mobileNumber);
            ?>
            <div class="w-1/5 pt-2 max-[369px]:w-full"><label for="member_mobile">전화 번호</label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_mobile" name="member_mobile" pattern="[0-9]{3}" value="<?= $mparts[0] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="member_mobile2" name="member_mobile2" pattern="[0-9]{4}" value="<?= $mparts[1] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="member_mobile3" name="member_mobile3" pattern="[0-9]{4}" value="<?= $mparts[2] ?>">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="phoneWrap">
            <?php
            $phoneNumber = $memArr['PhoneNumber'];
            $pparts = explode('-', $phoneNumber);
            ?>
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">휴대전화 <p class="text-red-600">*</p></label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone" name="member_phone" pattern="[0-9]{3}" value="<?= $pparts[0] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone2" name="member_phone2" pattern="[0-9]{4}" value="<?= $pparts[1] ?>">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone3" name="member_phone3" pattern="[0-9]{4}" value="<?= $pparts[2] ?>">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="addressWrap">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">주소 <p class="text-red-600">*</p></label></div>
            <div class="w-full space-y-2">
                <div class="flex justify-between">
                    <input class=" w-3/5 rounded-md border-[#D9D9D9]" type="text" name="zipcode" id="member_zipcode" readonly value="<?= $memArr['ZipCode']; ?>">
                    <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 " id="btn_zipicode" type="button">우편번호 찾기</button>
                </div>

                <div class="w-full">
                    <input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr1" id="member_addr1" placeholder="" value="<?= $memArr['Address']; ?>">

                </div>

                <div class="w-full"><input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요" value="<?= $memArr['DetailAddress'] ?>"></div>

            </div>
        </div>

        <div id="buttonwrap">
            <button class="w-full rounded-md bg-mblack text-white font-bold text-xl p-3 my-8" id="edit_btn" type="button">수정하기</button>
        </div>
    </div>

</div>



<?php
include './footer.php';
?>