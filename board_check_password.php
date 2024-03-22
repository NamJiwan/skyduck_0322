<?php

// include "./inc/common.php";

// if ($ses_id == ' ') {
//     echo "<script>
//             alert('접근 권한 없음');
//             window.location.href = './member_login.php';
//         </script>";
// };

$idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

if ($idx == '') {
    die("

        <script>
            alert('idx 값이 비었습니다.');
            history.go(-1);
        </script>
        ");

};
?>
<?php
include './header.php';
?>

<?php
$filename = basename(__FILE__, '.php');
?>

<section class="portfolioPage">
    <div id="Title" class="">
        <?php
        include 'pageTitle.php';

        $title = "게시판";
        $subtitle = "";
        $filename = "board";
        $textColor = "";

        render_header($title, $subtitle, $filename, $textColor);
        ?>
    </div>
</section>
<script src="./js/board_check_password.js"></script>
<div class="w-[91%] max-w-[1024px] m-auto pt-12 flex-col items-center text-center">
    <div class="m-auto w-full">
        <h1 class="text-bold text-3xl">비밀글 기능으로 보호된 글입니다.</h1>
        <p class="text-[#7D7D7D] py-4">작성자와 관리자만 열람하실 수 있습니다.</p>
        <p class="text-[#7D7D7D]">본인이라면 비밀번호를 입력하세요.</p>
    </div>
    <div class="w-50 m-auto pt-7">
        <!-- <label for="passwordcheck">비밀번호를 입력해주세요</label> -->
        <input class=" placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="password" placeholder="비밀번호" name="passwordcheck" id="passwordcheck">
    </div>
    <div class="w-50 m-auto pt-3"><button class="rounded-md bg-mblack text-white font-bold p-[10px] w-full" type="button" id="password_check_submit">확인</button></div>
</div>
<?php
include './footer.php';
?>

