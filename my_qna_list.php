<?php
include './header.php';
?>
<?php
include "./inc/dbconfig.php";
// include "./inc/common.php";

if ($ses_id == '') {
    echo "<script>
            alert('접근 권한 없음');
            window.location.href = './index.php';
        </script>";
}


$db = $pdo;

include "./inc/qna.php";

$qna = new Qna($db);
// print_r($ses_id);

if ($ses_grade == 'common_member') {
    $myQnaArr = $qna->getAllInfoFromIdTable($ses_id, "sd_Users");
} else if ($ses_grade == 'business_member') {
    $myQnaArr = $qna->getAllInfoFromIdTable($ses_id, "sd_BusinessUsers");
}

// print_r($myQnaArr);
?>
<style>
    .page-link {
        color: #000;
        background-color: #fff;
        border: 1px solid #ccc;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #555;
        font-weight: bold;
        background-color: #f1f1f1;
        border-color: #ccc;

    }

    .page-link:focus,
    .page-link:hover {
        color: #000;
        background-color: #fafafa;
        border-color: #ccc;
    }
</style>
<?php
$filename = basename(__FILE__, '.php');
?>

<section class="portfolioPage">
    <div id="Title" class="">
        <?php
        include 'pageTitle.php';

        $title = "나의견적문의";
        $subtitle = "";
        $filename = "qna";
        $textColor = "text-black";

        render_header($title, $subtitle, $filename, $textColor);
        ?>
    </div>

    <div class=""></div>

    <div class="pt-[80px]">
    </div>
</section>

<script src="./js/my_qna_list.js"></script>

<div class="w-[91%] max-w-[1024px] m-auto" id="main_wrap ">
        <script src="./js/my_qna_list.js"></script>
        <main class="w-full" style="height: calc(100vh - 257px);">
        <div>
        <h1 class="text-6xl">나의문의</h1>
        <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
    </div>
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
            [additional_notes] => 안녕하세요 -->
            <table class="mt-3 table table-border table-hover">
                <tr class="table-secondary border-t-2 border-[#3333] p-0">
                    <th class=" text-center">번호</th>
                    <th>이름</th>
                    <th>이메일</th>
                    <th>회사명</th>
                    <th>내용</th>
                    <th>관리</th>
                </tr>
                <?php
            foreach($myQnaArr AS $row){
                // print_r($row);
        ?>
                <tr>
                    <td class="text-center"><?= $row['idx']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['company_name']; ?></td>
                    <td><?= $row['additional_notes']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm btn_mem_edit" data-idx="<?= $row['idx']; ?>">보기</button>
                    </td>
                </tr>
                <?php
            }
        ?>
            </table>
        </main>
    </div>
    </main>

<?php
include './footer.php';
?>