<?php

include "./inc/dbconfig.php";

$db = $pdo;

include './inc/Questionboard.php';

$board = new Board($db);

$idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

if ($idx == '') {
    die("

            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");

};

$boardArr = $board->getInfoFormIdx($idx);

?>
<?php
include './header.php';
?>
<?php
function Console_log($data){
    echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
}

$testVal = $boardArr['attachments'];
Console_log($testVal);
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
<script src="./js/board_view.js"></script>
<div class="w-[91%] max-w-[1024px] flex-col justify-center items-center m-auto pt-12">
    <div>
        <h1 class="text-6xl">Q&A</h1>
        <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
    </div>
    <table class="w-full ">
        <div class="flex border-t-2 border-black">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="name">이름<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="text" id="name" name="name" required value="<?= $boardArr['name'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="password">비밀번호<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="text" id="password" name="password" min="1000" max="9999" required value="<?= $boardArr['password'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="email">이메일<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="email" id="email" name="email" required value="<?= $boardArr['email'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="phone_number">전화번호<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="tel" id="phone_number" name="phone_number" required value="<?= $boardArr['phone_number'] ?>" readonly></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="title">제목<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><input class="w-full rounded-[3px] border-[#B7B7B7]" type="text" id="title" name="title" required value="<?= $boardArr['title'] ?>" readonly></div>
        </div>
        <div>
            <!-- <td><label for="content">Content:</label></td> -->
            <div><textarea class="w-full border-[#C8C8C8] my-6" id="content" name="content" rows="10" required placeholder="
            제목: ex 카탈로그/브로슈어, 리플렛/팜플렛, 포스터, 제안서 등 
            사이즈: 
            페이지 수:
            인쇄 부수:
            추가설명: ex 종이종류 및 재질/코팅유무/후가공 등
                    " readonly><?= $boardArr['content'] ?></textarea></div>
        </div>
        <div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="attachments">파일</label></div>
            <div class="w-2/6 p-2">
               
                <?php
                $images = explode(", ", $boardArr['attachments']);
                if (!$boardArr['attachments']) {
                    echo '<input class="w-full rounded-[3px] border-[#B7B7B7]" type="file" id="attachments" name="attachments" multiple>';
                }else{
                    for ($i = 0; $i < count($images); $i++) {
                        echo '<h3>' . $images[$i] . '</h3>';
                        echo '<img src="./data/board_attachment/' . $images[$i] . '" alt="설명' . ($i + 1) . '" width=400>';
                    }
                }
                ?>
            </div>
        </div>
    </table>
    
    <div class="flex justify-center gap-2 mt-2">
        <button class="bg-gray-300 font-bold p-[10px] rounded-md" type="button" id="go_all">목록</button>
        <button class="rounded-md bg-mblack text-white font-bold p-[10px]" type="button" id="view_reply">답글보기</button>
    </div>
</div>
<?php
include './footer.php';
?>

