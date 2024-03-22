<?php
include './header.php';
?>
<?php
   
    include "./inc/dbconfig.php";

    $db = $pdo;

    include './inc/qna.php';

    $qna = new Qna($db);

    $idx = (isset($_GET['idx']) && $_GET['idx'] != '' && is_numeric($_GET['idx'])) ? $_GET['idx'] : '';

    if($idx == ''){
        die("
            <script>
                alert('idx 값이 비었습니다.');
                history.go(-1);
            </script>
        ");
    };

    $qnaArr = $qna->getInfoFormIdx($idx);


    if ($ses_id == '') {
        die("
        <script>
            alert('접근실패');
            self.location.href = './index.php';
        </script>
    ");
    }

    if ($ses_id != $qnaArr['author_id']) {
        die("
            <script>
                alert('권한없음');
                self.location.href = './index.php';
            </script>
        ");
    }
?>

<?php
$filename = basename(__FILE__, '.php');
?>

<section class="portfolioPage">
    <div id="Title" class="">
        <?php
        include 'pageTitle.php';

        $title = "견적문의";
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
    <script src="./js/my_qna_view.js"></script>
    <div class="m-auto w-4/5 border-b-[3px] border-black  ps-2">
    <h1 class="font-bold text-4xl ">당신의 프로젝트에 대해 이야기해주세요.</h1>
    <p class="font-bold pt-3 pb-6 ">문의를 남겨주시면 최대한 빠르게 답변드리겠습니다. </p>
</div>
<form id="contact-form" action="">

    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">
                    <p>상담에 필요한 기본정보를</p>
                    <p>입력해 주세요</p>
                </h2>
            </div class="w-1/5 max-[369px]:w-full">
            <div class="w-full grid grid-cols-2 gap-1 lg:grid-cols-3 ps-2 pb-3">
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="text" id="qna_name" placeholder="이름" name="user_name" value="<?= $qnaArr['name'] ?>" readonly>
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="tel" id="qna_tel" placeholder="연락처" name="user_phone" value="<?= $qnaArr['contact_number'] ?>" readonly>
                    
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="email" id="qna_email" placeholder="이메일" name="user_email" value="<?= $qnaArr['email'] ?>" readonly>
                    
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="text" id="qna_company_name" placeholder="회사명" name="company_name" value="<?= $qnaArr['company_name'] ?>" readonly>
                    
                </div>
                <div class="w-full"><input class="rounded-md border-[#D9D9D9] placeholder-slate-400 w-full" type="text" id="qna_grade" placeholder="직급" name="company_rank" value="<?= $qnaArr['position'] ?>" readonly></div>
                <div class="w-full"><input class="rounded-md border-[#D9D9D9] placeholder-slate-400 w-full" type="text" id="qna_user_page" placeholder="홈페이지" name="user_homepage" value="<?= $qnaArr['website'] ?>" readonly></div>
            </div>
        </div>
    </div>

    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">
                    <p>어떤 서비스가 필요하신가요?</p>
                    <p>다중선택이 가능합니다.</p>
                </h2>
            </div>
            <div class="w-full grid grid-cols-2 md:grid-cols-4 sm:grid-cols-3 gap-1 ps-2 pb-3  ">
            <?php
                $service_required = explode(',', $qnaArr['service_required']);
                // Remove 'on' from each service
                // $service_required = array_map(function($service) {
                //     return str_replace('/on', '', $service);
                // }, $service_required);
                // print_r($service_required);
            ?>
                <div><input type="checkbox" value="Catalog/Brochure" <?= in_array("\"CatalogBrochure", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">카타로그/브로슈어</span></div>
                <div><input type="checkbox" value="Leaflet/Pamphlet" <?= in_array("LeafletPamphlet", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">리플렛/팜플릿</span></div>
                <div><input type="checkbox" value="Poster"><span class="ps-2">포스터</span></div>
                <div><input type="checkbox" value="Package" <?= in_array("Poster", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">패키지</span></div>
                <div><input type="checkbox" value="Newsletter/Book" <?= in_array("NewsletterBook", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">사보/책</span></div>
                <div><input type="checkbox" value="Advertisement" <?= in_array("Advertisement", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">지면광고</span></div>
                <div><input type="checkbox" value="RFP" <?= in_array("RFP", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">제안서</span></div>
                <div><input type="checkbox" value="Others" <?= in_array("Others", $service_required) ? 'checked' : '' ?> disabled><span class="ps-2">기타</span></div>
            </div>
        </div>
    </div>

    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">예산과 일정은 어떻게 되나요</h2>
            </div>
            <div class="w-full flex ps-2 pb-3 space-x-3">
                <div class="w-full flex items-center gap-2">
                    <label class="max-[766px]:hidden w-1/6" for="qna_budget">예산 <span class="text-red-600">*</span></label>
                    <input class="rounded-md border-[#D9D9D9] w-full" type="text" id="qna_budget" placeholder="예산을 입력해 주세요" value="<?= $qnaArr['budget'] ?>">
                </div>
                <div class="w-full flex items-center gap-2">
                    <label class="max-[766px]:hidden w-1/6" for="qna_schedule">일정 <span class="text-red-600">*</span></label>
                    <input class="rounded-md border-[#D9D9D9] w-full " type="text" id="qna_schedule" placeholder="일정을 입력해 주세요" value="<?= $qnaArr['timeline'] ?>">
                </div>
            </div>
        </div>
    </div>

    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5">
        <div class="flex max-[1100px]:block ">
            <div class="w-1/3 max-[1100px]:w-full ps-2 pb-3">
                <h2 class=" font-bold">
                    <p>자세히 알려주시면</p>
                    <p> 정확한 견적에 도움이 됩니다</p>
                </h2>
            </div>
            <div class="w-full flex ps-2 pb-3 space-x-3">
                <textarea class="w-full rounded-md border-[#D9D9D9]  placeholder-slate-400" name="qna_content" id="qna_content" cols="20" rows="10" placeholder="
        제목: ex 카탈로그/브로슈어, 리플렛/팜플렛, 포스터, 제안서 등 
        사이즈: 
        페이지 수:
        인쇄 부수:
        추가설명: ex 종이종류 및 재질/코팅유무/후가공 등
                " readonly><?= $qnaArr['additional_notes'] ?></textarea>
            </div>
        </div>
    </div>
    
    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5 text-center">
        <button class="rounded-md   bg-black text-white font-bold text-xl px-28 py-4" type="button" id="qna_submit">뒤로가기</button>
    </div>

</form>

    
    <?php
include './footer.php';
?>