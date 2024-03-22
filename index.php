<?php
include './header.php';
?>

<?php
$currentPath = $_SERVER['REQUEST_URI'];
if ($currentPath == '/index.php') {
    header("Location: /");
    exit();
}
?>



<section class="relative w-full h-screen flex justify-center">
    <video class="z-0 absolute top-0 left-0 w-full h-full object-cover" autoplay muted>
        <source src="./video/mainBgmp4.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="absolute flex flex-col w-full max-w-[1280px] h-full z-1 text-3xl text-[#d9d9d9] items-center top-[25%] gap-16">
        <div class="w-[50%]"><img src="./image/mainpage/subtitle.png" alt=""></div>
        <div class="w-[50%] flex justify-center ">
            <div class="w-full min-[390px]:w-[50%] flex flex-col min-[390px]:flex-row justify-center items-center">
                <img src="./image/mainpage/title-1.png" alt="">
                <img src="./image/mainpage/title-2.png" alt="">
            </div>
        </div>
    </div>
</section>

<div class=" flex  flex-col justify-center items-center mt-[170px] mb-[60px]">
    <h1 class="font-bold text-[44px] text-mblack mb-[12px]">Service Scope</h1>
    <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
    <p class="text-xl text-grayService font-bold md:block hidden">원스탑(One-Stop) 디자인 컨설팅 서비스</p>
</div>

<!-- <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-700 bg-white hover:bg-gray-300 focus:ring-1 drop-shadow-[0_0px_6px_rgba(0,0,0,0.25)] focus:outline-none focus:ring-blue-100 font-medium rounded-full text-sm px-3 py-1.5 text-center inline-flex items-center" type="button">
    <div class="w-8 h-8 mr-2">
        <img src="./image/icon/user_icon.jpg" alt="">
    </div>
    <?php
    // print_r($ses_id);
    ?><span>&nbsp;님</span>
    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
</button> -->

<!-- Dropdown menu -->
<!-- <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
        </li>
        <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
        </li>
    </ul>
</div> -->

<div class="w-[91%] justify-center items-center  h-[420px] m-auto sm:block hidden transition-all duration-700 ">
    <div class="m-auto flex justify-center items-center w-full max-w-[1440px]  h-full service overflow-hidden">
        <div class="w-1/4  bg-blend-darken bg-black bg-opacity-50 h-full bg-[url('./image/main/service-mainmak.png')] bg-cover bg-center rounded-s-[20px] transition-all duration-700 ">
            <div class="flex justify-center items-center gap-[20px] mt-[80px] fourtitle">
                <img class="w-[55px]" src="./image/icon/mak.png" alt="">
                <p class="text-[#ffff] font-bold text-2xl">마케팅·광고</p>
            </div>
            <div class="w-4/5 fourcard overflow-hidden whitespace-nowrap">
                <div class="m-auto w-full flex-col items-start rounded-[20px] bg-blend-darken bg-black bg-opacity-50 py-[40px] px-[60px]">
                    <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                        <img class="w-[50px]" src="./image/icon/mak.png" alt="">
                        <p class="text-[#ffff] font-bold text-2xl ps-2">마케팅·광고</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4">
                        <p class="font-medium text-[#ffff] text-xl">디자인은 예술이 아닌 생활입니다.</p>
                        <p class="font-medium text-[#ffff] text-xl">누구나 보고싶게 만들어 주세요</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                        <ul class="list-disc">
                            <li>홍보물(브로슈어, 리플렛, 전단지 외)</li>
                            <li>사인제품(현수막, 배너 외)</li>
                            <li>판촉물(기념품 외)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/4 bg-blend-darken bg-black bg-opacity-50 h-full bg-[url('./image/main/service-mainvisual.png')] bg-cover bg-center transition-all duration-700">
            <div class="flex justify-center items-center gap-[20px] mt-[80px] fourtitle">
                <img class="w-[55px]" src="./image/icon/visual.png" alt="">
                <p class="text-[#ffff] font-bold text-2xl">비주얼 아이덴티티</p>
            </div>
            <div class="w-4/5 fourcard overflow-hidden whitespace-nowrap">
                <div class="m-auto w-full flex-col items-start rounded-[20px] bg-blend-darken bg-black bg-opacity-50 py-[40px] px-[60px]">
                    <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                        <img class="w-[55px]" src="./image/icon/visual.png" alt="">
                        <p class="text-[#ffff] font-bold text-2xl ps-2">비주얼 아이덴티티</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4">
                        <p class="font-medium text-[#ffff] text-xl">몸에 맞는 옷을 입듯</p>
                        <p class="font-medium text-[#ffff] text-xl">브랜드에도 맞는 디자인을 입히세요.</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                        <ul class="list-disc">
                            <li>BI, CI, Package 디자인</li>
                            <li>서류 양식 디자인 </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/4 bg-blend-darken bg-black bg-opacity-50 h-full bg-[url('./image/main/service-mainpublishing.png')]  bg-cover bg-center transition-all duration-700 ">
            <div class="flex justify-center items-center gap-[20px] mt-[80px] fourtitle">
                <img class="w-[55px]" src="./image/icon/publishing.png" alt="">
                <p class="text-[#ffff] font-bold text-2xl">환경그래픽</p>
            </div>
            <div class="w-4/5 fourcard overflow-hidden whitespace-nowrap">
                <div class="m-auto w-full flex-col items-start rounded-[20px] bg-blend-darken bg-black bg-opacity-50 py-[40px] px-[60px]">
                    <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                        <img class="w-[55px]" src="./image/icon/publishing.png" alt="">
                        <p class="text-[#ffff] font-bold text-2xl ps-2">환경그래픽</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4">
                        <p class="font-medium text-[#ffff] text-xl">가장 오래 머무는 사무실과 학교,</p>
                        <p class="font-medium text-[#ffff] text-xl">눈이 피로하지 않게 디자인해 주세요</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                        <ul class="list-disc">
                            <li>학교 현황판, 입간판, 게시대</li>
                            <li>표찰, 유리창 시트, 스카시</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-1/4  bg-right bg-blend-darken bg-black bg-opacity-50 h-full  bg-[url('./image/main/service-mainInternet.png')] bg-cover  rounded-e-[20px] transition-all duration-700">
            <div class="flex justify-center items-center gap-[20px] mt-[80px] fourtitle">
                <img class="w-[55px]" src="./image/icon/Internet.png" alt="">
                <p class="text-[#ffff] font-bold text-2xl">웹디자인</p>
            </div>
            <div class="w-4/5 fourcard overflow-hidden whitespace-nowrap">
                <div class="m-auto w-full flex-col items-start rounded-[20px] bg-blend-darken bg-black bg-opacity-50 py-[40px] px-[60px]">
                    <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                        <img class="w-[55px]" src="./image/icon/Internet.png" alt="">
                        <p class="text-[#ffff] font-bold text-2xl ps-2">웹디자인</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4">
                        <p class="font-medium text-[#ffff] text-xl">고객과 소통하는 창구역할을 하는 </p>
                        <p class="font-medium text-[#ffff] text-xl"> 웹에 꼭 맞는 코디는 필수</p>
                    </div>
                    <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                        <ul class="list-disc">
                            <li>UX/UI 디자인</li>
                            <li>웹 퍼블리싱</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="sm:hidden mt-[60px] ">
    <div class="m-auto w-[91%] ">
        <div class="flex  items-center gap-[20px] mt-[30px] p-[40px] bg-blend-darken bg-black bg-opacity-50 h-full bg-[url('./image/main/service-mainmak.png')] bg-cover bg-center rounded-[20px]">
            <div class="m-auto w-full flex-col items-start ">
                <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                    <img class="w-[50px]" src="./image/icon/mak.png" alt="">
                    <p class="text-[#ffff] font-bold text-2xl ps-2">마케팅·광고</p>
                </div>
                <div class="flex-col items-center justify-start pt-4">
                    <p class="font-medium text-[#ffff] text-xl">디자인은 예술이 아닌 생활입니다.</p>
                    <p class="font-medium text-[#ffff] text-xl">누구나 보고싶게 만들어 주세요</p>
                </div>
                <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                    <ul class="list-disc">
                        <li>홍보물(브로슈어, 리플렛, 전단지 외)</li>
                        <li>사인제품(현수막, 배너 외)</li>
                        <li>판촉물(기념품 외)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="m-auto w-[91%]">
        <div class="flex  items-center gap-[20px] mt-[30px] p-[40px] bg-blend-darken bg-black bg-opacity-50 h-full bg-[url('./image/main/service-mainvisual.png')] bg-cover bg-center rounded-[20px]">
            <div class="m-auto w-full flex-col items-start ">
                <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                    <img class="w-[55px]" src="./image/icon/visual.png" alt="">
                    <p class="text-[#ffff] font-bold text-2xl ps-2">비주얼 아이덴티티</p>
                </div>
                <div class="flex-col items-center justify-start pt-4">
                    <p class="font-medium text-[#ffff] text-xl">몸에 맞는 옷을 입듯</p>
                    <p class="font-medium text-[#ffff] text-xl">브랜드에도 맞는 디자인을 입히세요.</p>
                </div>
                <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                    <ul class="list-disc">
                        <li>BI, CI, Package 디자인</li>
                        <li>서류 양식 디자인 </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="m-auto w-[91%]">
        <div class="flex  items-center gap-[20px] mt-[30px] p-[40px] bg-blend-darken bg-black bg-opacity-50 h-full bg-[url('./image/main/service-mainpublishing.png')] bg-cover bg-center rounded-[20px]">
            <div class="m-auto w-full flex-col items-start ">
                <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                    <img class="w-[55px]" src="./image/icon/publishing.png" alt="">
                    <p class="text-[#ffff] font-bold text-2xl ps-2">환경그래픽</p>
                </div>
                <div class="flex-col items-center justify-start pt-4">
                    <p class="font-medium text-[#ffff] text-xl">가장 오래 머무는 사무실과 학교,</p>
                    <p class="font-medium text-[#ffff] text-xl">눈이 피로하지 않게 디자인해 주세요</p>
                </div>
                <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                    <ul class="list-disc">
                        <li>학교 현황판, 입간판, 게시대</li>
                        <li>표찰, 유리창 시트, 스카시</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="m-auto w-[91%]">
        <div class="flex  items-center gap-[20px] mt-[30px] p-[40px] bg-blend-darken bg-black bg-opacity-50 h-full bg-[url('./image/main/service-mainInternet.png')] bg-cover bg-center rounded-[20px]">
            <div class="m-auto w-full flex-col items-start">
                <div class="flex items-center pb-4 border-b-2 border-[#ffff] transition-all duration-300 ">
                    <img class="w-[55px]" src="./image/icon/Internet.png" alt="">
                    <p class="text-[#ffff] font-bold text-2xl ps-2">웹디자인</p>
                </div>
                <div class="flex-col items-center justify-start pt-4">
                    <p class="font-medium text-[#ffff] text-xl">고객과 소통하는 창구역할을 하는 </p>
                    <p class="font-medium text-[#ffff] text-xl"> 웹에 꼭 맞는 코디는 필수</p>
                </div>
                <div class="flex-col items-center justify-start pt-4 font-medium text-[#ffff] text-lg ps-4">
                    <ul class="list-disc">
                        <li>UX/UI 디자인</li>
                        <li>웹 퍼블리싱</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="md:block hidden">
    <img class="w-full absolute transform -translate-y-[9rem] -z-10" src="./image/main/portfoliobg.png" alt="">
</div>
<div class=" flex  flex-col justify-center items-center mt-[170px] ">
    <h1 class="font-bold text-[44px] text-mblack mb-[12px]">Portfolio</h1>
    <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
</div>

<div class="mt-[60px]">
    <div class="m-auto  grid sm:grid-cols-2 md:grid-cols-3 w-[91%] max-w-[1440px] gap-[20px]">
        <div>
            <img class="w-full " src="./image/main/Portfolio1.png" alt="">
        </div>
        <div>
            <img class="w-full" src="./image/main/Portfolio2.png" alt="">
        </div>
        <div>
            <img class="w-full" src="./image/main/Portfolio3.png" alt="">
        </div>
        <div>
            <img class="w-full" src="./image/main/Portfolio4.png" alt="">
        </div>
        <div class="sm:block hidden">
            <img class="w-full" src="./image/main/Portfolio5.png" alt="">
        </div>
        <div class="sm:block hidden">
            <img class="w-full" src="./image/main/Portfolio6.png" alt="">
        </div>
    </div>
</div>

<div class="flex justify-center my-[50px]">
    <a class=" rounded-full py-[13px] px-[20px] bg-black text-white font-bold flex justify-center items-center" href="">
        포트폴리오 더보기
        <svg class="w-4 h-4 text-white ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
        </svg>
    </a>
</div>


<div class="w-full">
    <div class=" flex  flex-col justify-center items-center mt-[170px]">
        <h1 class="font-bold text-[44px] text-mblack mb-[12px]">Process</h1>
        <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
    </div>
    <div class="">
        <img class=" w-[50%] absolute transform translate-x-full -translate-y-16 -z-10 sm:block hidden" src="./image/main/processbg.png" alt="">
    </div>
    <div class=" w-[91%] m-auto flex justify-center items-center ">
        <div class=" sm:block hidden mt-[60px] w-full max-w-[1440px]">
            <img class="w-[80%] m-auto" src="./image/main/processmain.png" alt="">
        </div>
        <div class=" sm:hidden  mt-[60px] w-full max-w-[1440px]">
            <img class="w-[80%] m-auto" src="./image/main/processmobile.png" alt="">
        </div>
    </div>
</div>

<div class=" flex  flex-col justify-center items-center text-center mt-[200px] ">
    <h1 class="font-bold text-[44px] text-mblack mb-[12px]">Contact</h1>
    <div class="w-[150px] h-[10px] bg-gradient-to-r from-customblue to-custombluetransparent mb-[24px]"></div>
</div>

<div class="m-auto pb-[60px] sm:block hidden">
    <div class="w-[91%] max-w-[1440px] m-auto pt-[25px] pb-[35px] px-3 border-mblack border-b-[3px]">
        <p class="font-bold text-mblack text-2xl mb-3">무엇이든 편하게 물어보세요.</p>
        <p class="font-medium text-mblack text-lg">상담을 신청해 주시면 최대한 빠르게 연락드리겠습니다.</p>
    </div>
    <div class="flex justify-center items-center w-[91%] max-w-[1440px] m-auto pt-[25px] pb-[35px] px-3">
        <form class="w-full" action="" name="formname">
            <div class="lg:flex justify-between">
                <div class="flex lg:block">
                    <p class="font-semibold text-lg">상담에 필요한 기본정보를</p>
                    <p class="font-semibold text-lg ">입력해주세요.</p>
                </div>
                <div class=" grid grid-cols-3 gap-6 ">
                    <div class="relative">
                        <input class="w-full placeholder-slate-400 border rounded-[4px]" type="text" placeholder="이름" name="user_name">
                    </div>
                    <div class="relative">
                        <input class="w-full placeholder-slate-400 border rounded-[4px]" type="text" placeholder="연락처" name="user_phone" id="user_phone">
                        <div class="absolute inset-y-1 left-0 pl-16 flex items-center pointer-events-none text-red-600">
                            *
                        </div>
                    </div>
                    <div class="relative">
                        <input class="w-full placeholder-slate-400 border rounded-[4px]" type="text" placeholder="이메일" name="user_email" id="user_email">
                        <div class="absolute inset-y-1 left-0 pl-16 flex items-center pointer-events-none text-red-600">
                            *
                        </div>
                    </div>
                    <div class="relative">
                        <input class="w-full placeholder-slate-400 border rounded-[4px]" type="text" placeholder="회사명" name="company_name" id="company_name">
                        <div class="absolute inset-y-1 left-0 pl-16 flex items-center pointer-events-none text-red-600">
                            *
                        </div>
                    </div>
                    <div class="relative">
                        <input class="w-full placeholder-slate-400 border rounded-[4px]" type="text" placeholder="내용" name="company_detail">

                    </div>

                </div>
            </div>
            <div class="text-center pt-12">
                <button class="rounded-md py-3 px-16 bg-black text-white text-base font-semibold" type="submit">상담 신청</button>
            </div>
        </form>
    </div>
</div>
<div class="sm:hidden flex-col items-center justify-center w-[91%] m-auto">
    <div class=" border-b-4 border-black text-center">
        <p class="font-bold text-lg">당신의 프로젝트에 대해 이야기해주세요.</p>
        <p class="py-3 text-xs">문의를 남겨주시면 최대한 빠르게 답변드리겠습니다.</p>
    </div>
    <div class="m-auto pt-10  text-center">
        <a class="rounded-md w-full  bg-black text-white font-bold text-xl px-[60px] py-[23px]" href="">견적문의</a>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
<script>
    // Email JS
    (function() {
        // https://dashboard.emailjs.com/admin/account
        emailjs.init('lwVwvssxtK8-d1g-b');
    })();

    window.onload = function() {
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();

            if (document.getElementById('user_phone').value == '') {
                event.preventDefault();
                alert('연락처를 입력하세요');
                document.getElementById('user_phone').focus();
            } else if (document.getElementById('user_email').value == '') {
                event.preventDefault();
                alert('이메일을 입력하세요');
                document.getElementById('user_email').focus();
            } else if (document.getElementById('company_name').value == '') {
                event.preventDefault();
                alert('회사명을 입력하세요');
                document.getElementById('company_name').focus();
            } else {

                // these IDs from the previous steps
                emailjs.sendForm('service_7deictp', 'template_ikqaxfi', this)
                    .then(function() {
                        console.log('SUCCESS!');
                        alert('전송이 완료되었습니다');
                        location.reload();
                    }, function(error) {
                        console.log('FAILED...', error);
                    });
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.service > div').mouseover(function() {
            $(this).removeClass('w-1/4').removeClass('bg-opacity-50');
            $(this).addClass('w-1/2').addClass('bg-opacity-25').addClass('on').addClass('flex').addClass('justify-center').addClass('items-center');
            $('.service > div').not(this).addClass('w-1/6').not(this).addClass('off');
            $('.service > div').not(this).removeClass('w-1/4').not(this).removeClass('w-1/2');

        });
        $('.service > div').mouseleave(function() {
            $(this).addClass('w-1/4').addClass('bg-blend-darken').addClass('bg-black').addClass('bg-opacity-50');
            $(this).removeClass('w-1/2').removeClass('bg-opacity-25').removeClass('on').removeClass('flex').removeClass('justify-center').removeClass('items-center');
            $('.service > div').not(this).addClass('w-1/4');
            $('.service > div').not(this).removeClass('w-1/6').removeClass('w-1/2').removeClass('off');
        });
    });
</script>





<?php $currentPath = $_SERVER['REQUEST_URI'];
$isIndexPage = (strpos($currentPath, '/') !== false); ?> <?php if ($isIndexPage) : ?>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            let header = document.getElementById('mainHeader');
            let isScrolled = false;

            window.addEventListener('scroll', function() {
                if (!isScrolled && window.pageYOffset > 0) {
                    header.classList.add('bg-white');
                    header.classList.add('shadow-md');
                    header.classList.remove('text-white');
                    isScrolled = true;
                } else if (isScrolled && window.pageYOffset === 0) {
                    header.classList.remove('bg-white');
                    header.classList.remove('shadow-md');
                    header.classList.add('text-white');
                    isScrolled = false;
                }
            });

            if (window.pageYOffset > 0) {
                header.classList.add('bg-white');
                header.classList.add('shadow-md');
                header.classList.remove('text-white');
                isScrolled = true;
            } else {
                header.classList.remove('bg-white');
                header.classList.remove('shadow-md');
                header.classList.add('text-white');
                isScrolled = false;
            }
        });
    </script>
<?php endif; ?>

<?php
include './footer.php';
?>