<?php
include './header.php';
?>
<?php

    // include "./inc/common.php";

    include "./inc/dbconfig.php";

    $db = $pdo;

    include "./inc/member.php";
    include "./inc/businessmember.php";

    $mem = new Member($db);
    $bmem = new BusinessMemeber($db);

    if ($ses_id == '') {
        echo "<script>
        alert('로그인이 필요한 서비스입니다.');
        window.location.href = './login.php';
    </script>";
    };

    if ($ses_grade == 'common_member') {
        $arr = $mem->getInfoFormId($ses_id);
    } else if ($ses_grade == 'business_member') {
        $arr = $bmem->getInfoFormId($ses_id);
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

<script src="./js/qna.js"></script>

<div class="m-auto w-4/5 border-b-[3px] border-black  ps-2">
    <h1 class="font-bold text-4xl ">당신의 프로젝트에 대해 이야기해주세요.</h1>
    <p class="font-bold pt-3 pb-6 ">문의를 남겨주시면 최대한 빠르게 답변드리겠습니다. </p>
</div>
<form id="contact-form"  action="" >
    
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
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="text" id="qna_name" placeholder="이름" name="user_name">
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="tel" id="qna_tel" placeholder="연락처" name="user_phone">
                    <div class="absolute inset-y-1 left-0 pl-16 flex items-center pointer-events-none text-red-600">
                        *
                    </div>
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="email" id="qna_email" placeholder="이메일" name="user_email">
                    <div class="absolute inset-y-1 left-0 pl-16 flex items-center pointer-events-none text-red-600">
                        *
                    </div>
                </div>
                <div class="relative w-full">
                    <input class="placeholder-slate-400 rounded-md border-[#D9D9D9] w-full" type="text" id="qna_company_name" placeholder="회사명" name="company_name">
                    <div class="absolute inset-y-1 left-0 pl-16 flex items-center pointer-events-none text-red-600">
                        *
                    </div>
                </div>
                <div class="w-full"><input class="rounded-md border-[#D9D9D9] placeholder-slate-400 w-full" type="text" id="qna_grade" placeholder="직급" name="company_rank"></div>
                <div class="w-full"><input class="rounded-md border-[#D9D9D9] placeholder-slate-400 w-full" type="text" id="qna_user_page" placeholder="홈페이지" name="user_homepage"></div>
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
                <div><input type="checkbox" value="Catalog/Brochure" ><span class="ps-2">카타로그/브로슈어</span></div>
                <div><input type="checkbox" value="Leaflet/Pamphlet"><span class="ps-2">리플렛/팜플릿</span></div>
                <div><input type="checkbox" value="Poster"><span class="ps-2">포스터</span></div>
                <div><input type="checkbox" value="Package"><span class="ps-2">패키지</span></div>
                <div><input type="checkbox" value="Newsletter/Book"><span class="ps-2">사보/책</span></div>
                <div><input type="checkbox" value="Advertisement"><span class="ps-2">지면광고</span></div>
                <div><input type="checkbox" value="RFP"><span class="ps-2">제안서</span></div>
                <div><input type="checkbox" value="Others"><span class="ps-2">기타</span></div>
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
                    <input class="rounded-md border-[#D9D9D9] w-full" type="text" id="qna_budget" placeholder="예산을 입력해 주세요">
                </div>
                <div class="w-full flex items-center gap-2">
                    <label class="max-[766px]:hidden w-1/6" for="qna_schedule">일정 <span class="text-red-600">*</span></label>
                    <input class="rounded-md border-[#D9D9D9] w-full " type="text" id="qna_schedule" placeholder="일정을 입력해 주세요">
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
                "></textarea>
            </div>
        </div>
    </div>
    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5 text-center flex items-center justify-center">
        <label class="pr-2" for="qna_check">개인정보 방침을 읽었으며 동의합니다</label>
        <input type="checkbox" id="qna_check">
    </div>
    <div class="pt-10 m-auto w-4/5 max-[1004px]:w-4/5 text-center">
        <button class="rounded-md   bg-black text-white font-bold text-xl px-28 py-4" type="button" id="qna_submit">견적 문의</button>
    </div>
    
</form id="contact-form"  action="" >
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
<script>
    // // Email JS
    // (function() {
    //     // https://dashboard.emailjs.com/admin/account
    //     emailjs.init('Wh5DPzjPo5Ysz-aZX');
    // })();
        
    // window.onload = function() {
    //     document.getElementById('qna_submit').addEventListener('click', function(event) {
    //         event.preventDefault();
            
    //         if(document.getElementById('qna_tel').value == ''){
    //             event.preventDefault();
    //             alert('연락처를 입력하세요');
    //             document.getElementById('qna_tel').focus();
    //         }else if(document.getElementById('qna_email').value == ''){
    //             event.preventDefault();
    //             alert('이메일을 입력하세요');
    //             document.getElementById('qna_email').focus();
    //         }else if(document.getElementById('qna_company_name').value == ''){
    //             event.preventDefault();
    //             alert('회사명을 입력하세요');
    //             document.getElementById('qna_company_name').focus();
    //         }else{                
    //             // these IDs from the previous steps
    //             emailjs.sendForm('service_kqqkqbb', 'template_w8y29ag', this)
    //                 .then(function() {
    //                     console.log('SUCCESS!');
    //                     alert('전송이 완료되었습니다');
    //                     location.reload();
    //                 }, function(error) {
    //                     console.log('FAILED...', error);
    //                 });
    //         }
    //     });
    // }
</script>

<?php
include './footer.php';
?>