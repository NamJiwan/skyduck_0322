<?php
    include "./inc/dbconfig.php";

    $db = $pdo;

    include "./inc/Questionboard.php";
    include "./inc/reply.php";


    $qidx = (isset($_GET['qusetion_idx']) && $_GET['qusetion_idx'] != '' && is_numeric($_GET['qusetion_idx'])) ? $_GET['qusetion_idx'] : '';

    if($qidx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $board = new Board($db);
    $reply = new Reply($db);


    $row = $board->getInfoFormIdx($qidx);
    $replyrow = $reply->getInfoBoardIdx($qidx);
    // print_r($replyrow);

    if (empty($replyrow)) {
        die("
        <script>
            alert('답글이 존재하지 않습니다..');
            history.go(-1);
        </script>
    ");
    }
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="./js/board_reply.js"></script>
<div class="w-[91%] max-w-[1024px] flex-col justify-center items-center m-auto pt-12">
<div class="container text-center">
<div class="flex border-y-[1px] border-[#CCCCCC]">
            <div class="w-1/6 text-center bg-[#D9D9D9]"><label class="w-full h-full flex  m-auto justify-center items-center text-xl" for="title">제목<p class="text-red-600">*</p></label></div>
            <div class="w-2/6 max-[960px]:w-4/6 p-2"><?= $replyrow['title'] ?></div>
        </div>

            <div class="p-3" id="contentWrap">
                <?= $replyrow['content']; ?>
            </div>
            <div class=" mt-3 d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary" id="btn_board_list">목록보기</button>
                <button class="btn btn-secondary" id="btn_board_view"
                    data-idx="<?= $replyrow['question_idx'] ?>">본문보기</button>
            </div>
        </div>

</div>
<?php
include './footer.php';
?>

