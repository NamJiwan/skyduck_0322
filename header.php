<?php
include './inc/common.php';

// print_r($ses_grade);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- 부트스트랩 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!--테일윈드 CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <!-- 제이쿼리 -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <style type="text/tailwindcss">
        @layer utilities {
      .content-auto {
        content-visibility: auto;
      }
    }
    </style>
    <!-- 폰트 -->
    <style>
        @font-face {
            font-family: 'Pretendard-Regular';
            src: url('https://cdn.jsdelivr.net/gh/Project-Noonnu/noonfonts_2107@1.1/Pretendard-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
        }
    </style>

    <style>
        .off p {
            display: none;
        }

        .on .fourtitle {
            display: none;
        }

        .fourcard {
            display: none;
            opacity: 0;
            transition: all 0.3s;
        }

        .on .fourcard {
            display: block;
            opacity: 1;
        }

        .underline-custom::after {
            content: '';
            display: block;
            width: 168px;
            /* 밑줄의 길이를 조절합니다. */
            height: 2px;
            background: #fff;
            /* 밑줄의 색상을 설정합니다. */
            position: absolute;
            bottom: -3px;
        }

        .underline-custom-visual::after {
            content: '';
            display: block;
            width: 168px;
            /* 밑줄의 길이를 조절합니다. */
            height: 2px;
            background: #fff;
            /* 밑줄의 색상을 설정합니다. */
            position: absolute;
            bottom: -3px;
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                        iconred: 'E60A0A',
                        mblack: '#333',
                        loginblue: '#182548',
                        grayService: '#717171',
                        customblue: '#16214D',
                        custombluetransparent: 'rgba(22, 33, 77, 0.00)',
                    }
                }
            }
        }
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />


    <title>Document</title>

</head>

<body class=" relative transition-all font-[Pretendard-Regular] pb-[500px] ">
    <header id="mainHeader" class="z-[999] fixed w-full h-16 flex justify-center items-center bg-white duration-300 shadow-md">
        <div class="container max-w-[1024px] flex flex-row justify-between px-10">
            <a href="./">
                <div class="h-full ">
                    <img class="w-full h-full object-contain" src="./image/logo/SkyDuck_Logo.png" alt="">
                </div>
            </a>
            <div class="flex flex-row gap-4 items-center">
                <div class="flex flex-row gap-4 items-center max-[740px]:hidden">
                    <a href="./intro.php">
                        <div>회사소개</div>
                    </a>
                    <a href="./portfolio.php">
                        <div>포트폴리오</div>
                    </a>
                    <a href="./board.php">
                        <div>게시판</div>
                    </a>
                    <a href="./qna.php">
                        <div>견적문의</div>
                    </a>
                    <?php if ($ses_id != '') : ?>
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-gray-700 bg-opacity-50 bg-white hover:bg-gray-300 focus:ring-1 drop-shadow-[0_0px_6px_rgba(0,0,0,0.25)] focus:outline-none font-medium rounded-full text-sm px-2.5 py-1 text-center inline-flex items-center" type="button">
                            <div class="w-8 h-8 mr-2 rounded-full overflow-hidden">
                                <img src="./image/icon/user_icon.jpg" alt="">
                            </div>
                            <?php echo $ses_id; ?><span>&nbsp;님</span>
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                    <?php else : ?>
                        <a href="./login.php">
                            <div class="w-[65px] h-[39px] bg-[#333333] rounded-md flex justify-center items-center text-white">로그인</div>
                        </a>
                    <?php endif; ?>

                </div>
                <div id="MenuToggleBtn" class="hidden p-2 max-[740px]:block rounded-lg bg-[#004190] hover:bg-white hover:opacity-75"><img src="./image/icon/toggleBtn.png" alt=""></div>
            </div>
    </header>
    <div id="ToggleMenu" class="fixed w-screen h-full top-0 left-[100%] bg-[#F1F3F6] z-[1000] duration-150">
        <div class=" relative w-full h-full flex flex-col justify-start items-center">
            <div class=" absolute top-8 w-full flex justify-between px-10 items-center">
                <div><a href="./"><img src="./image/logo/SkyDuck_Logo.png" alt=""></a></div>
                <div id="ToggleCloseBtn" class="w-[22px] h-[22px]"><img src="./image/icon/btn_X.png" alt="X"></div>
            </div>
            <div class="w-full flex flex-col text-[16px] font-bold pt-24 px-4 gap-6">

                <?php if ($ses_id != '' && $ses_grade != '') : ?>
                    <?php if ($ses_grade == 'common_member') : ?>
                        <a href="./mypage.php" class="w-full h-[60px] flex justify-between items-center rounded-xl bg-white px-4">
                            <div>마이페이지</div>
                            <img src="./image/icon/bracket_R.png" alt="">
                        </a>
                        <a href="./my_qna_list.php" class="w-full h-[60px] flex justify-between items-center rounded-xl bg-white px-4">
                            <div>문의내역</div>
                            <img src="./image/icon/bracket_R.png" alt="">
                        </a>
                    <?php elseif ($ses_grade == 'business_member') : ?>
                        <a href="./business_mypage.php" class="w-full h-[60px] flex justify-between items-center rounded-xl bg-white px-4">
                            <div>마이페이지</div>
                            <img src="./image/icon/bracket_R.png" alt="">
                        </a>
                        <a href="./my_qna_list.php" class="w-full h-[60px] flex justify-between items-center rounded-xl bg-white px-4">
                            <div>문의내역</div>
                            <img src="./image/icon/bracket_R.png" alt="">
                        </a>
                    <?php endif; ?>
                <?php else : ?>
                    <a href="./login.php" class="w-full h-[60px] flex justify-between items-center rounded-xl bg-white px-4">
                        <div>로그인</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                <?php endif; ?>

                <div class="w-full flex flex-col bg-white px-2 rounded-xl py-3">
                    <a href="./intro.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>회사소개</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                    <a href="./portfolio.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>포트폴리오</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                    <a href="./board.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>게시판</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                    <a href="./qna.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>견적문의</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                </div>

                <div class="w-full flex flex-col bg-white px-2 rounded-xl py-3">
                    <a href="./logout.php" class="w-full flex justify-between items-center rounded-xl  px-3 py-2">
                        <div>로그아웃</div>
                        <img src="./image/icon/bracket_R.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 회원메뉴 드롭다운 -->
    <div id="dropdown" class="z-[1000] hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 border-2 border-gray-200 text-xl">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">

            <?php if ($ses_grade == 'common_member') : ?>
                <li>
                    <a href="./mypage.php" class="block px-4 py-2">마이페이지</a>
                </li>
                <li>
                    <a href="./my_qna_list.php" class="block px-4 py-2">문의내역</a>
                </li>
            <?php elseif ($ses_grade == 'business_member') : ?>
                <li>
                    <a href="./business_mypage.php" class="block px-4 py-2">마이페이지</a>
                </li>
                <li>
                    <a href="./my_qna_list.php" class="block px-4 py-2">문의내역</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="./logout.php" class="block px-4 py-2">로그아웃</a>
            </li>
        </ul>
    </div>