<?php
include './header.php';
?>

<?php
$filename = basename(__FILE__, '.php');
?>

<?php
include "./inc/dbconfig.php";

$db = $pdo;

include "./inc/portfolio.php";
include "./inc/lib.php";

$sn = (isset($_GET['sn']) && $_GET['sn'] != '' && is_numeric($_GET['sn'])) ? $_GET['sn'] : '';
$sf = (isset($_GET['sf']) && $_GET['sf'] != '') ? $_GET['sf'] : '';

$port = new Portfolio($db);

$paramArr = ['sn' => $sn, 'sf' => $sf];

$total = $port->total($paramArr);
$limit = $total; // 각 페이지당 표시되는 항목 수

$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$param = '';

$portArr = $port->list($page, $limit, $paramArr);
?>


<section class="portfolioPage">
    <div id="Title" class="">
        <?php
        include 'pageTitle.php';

        $title = "포트폴리오";
        $subtitle = "";
        $filename = "portfolio";
        $textColor = "";

        render_header($title, $subtitle, $filename, $textColor);
        ?>
    </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



<section class="relative w-full flex flex-col justify-center items-center mt-24">

    <article class="w-full max-w-[1440px] max-[740px]:px-4">
        <div class="mb-4 ">
            <ul class="flex flex-wrap justify-center -mb-px text-[#333333] text-[20px] font-medium text-center space-x-10 max-[740px]:space-x-2" id="default-tab" data-tabs-active-classes="text-[#333333] hover:text-[#333333] font-bold border-[#001C7E] border-b-0 border-t-4" data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1 text-[#333333]" id="listAll-tab" data-tabs-target="#listAll" type="button" role="tab" aria-controls="listAll" aria-selected="false">전체보기</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listAd-tab" data-tabs-target="#listAd" type="button" role="tab" aria-controls="listAd" aria-selected="false">광고·편집</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listVi-tab" data-tabs-target="#listVi" type="button" role="tab" aria-controls="listVi" aria-selected="false">비주얼아이덴티티</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listEnv-tab" data-tabs-target="#listEnv" type="button" role="tab" aria-controls="listEnv" aria-selected="false">환경디자인</button>
                </li>
                <li class="me-2 flex justify-center max-[740px]:w-[140px]" role="presentation2">
                    <button class="inline-block py-1" id="listWeb-tab" data-tabs-target="#listWeb" type="button" role="tab" aria-controls="listWeb" aria-selected="false">웹디자인</button>
                </li>
                <li class=" flex justify-center max-[740px]:w-[140px]" role="presentation">
                    <button class="inline-block py-1" id="listEct-tab" data-tabs-target="#listEct" type="button" role="tab" aria-controls="listEct" aria-selected="false">기타</button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg" id="listAll" role="tabpanel" aria-labelledby="listAll-tab">
                <div id="divAll" class="grid grid-cols-3 max-[600px]:grid-cols-2 gap-4 max-[600px]:gap-1 items-center">
                    <?php foreach ($portArr as $portfolio) : ?>
                        <?php $imageRoutes = explode(',', $portfolio['ImageRoute']); ?>
                        <?php foreach ($imageRoutes as $index => $imageRoute) : ?>
                            <?php if ($index < 1) : ?> <!-- 각 포트폴리오 항목에서 최대 3개의 이미지만 표시 -->
                                <div class="relative">
                                    <img src="./data/admin_portfolio/<?php echo $imageRoute; ?>" alt="포트폴리오 이미지" class="w-full cursor-pointer" onclick="openModal('./data/portfolio/<?php echo $imageRoute; ?>', '<?php echo $portfolio['Name']; ?>', '<?php echo $portfolio['Category']; ?>', '<?php echo $portfolio['ImageRoute']; ?>')">
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg" id="listAd" role="tabpanel" aria-labelledby="listAd-tab">
                <div id="divAll" class="grid grid-cols-3 max-[600px]:grid-cols-2 gap-4 max-[600px]:gap-1 items-center">
                    <?php foreach ($portArr as $portfolio) : ?>
                        <?php if ($portfolio['Category'] === '광고·편집') : ?>
                            <div class="relative">
                                <?php $imageRoutes = explode(',', $portfolio['ImageRoute']); ?>
                                <?php foreach ($imageRoutes as $index => $imageRoute) : ?>
                                    <?php if ($index < 1) : ?>
                                        <img src="./data/admin_portfolio/<?php echo $imageRoute; ?>" alt="포트폴리오 이미지" class="w-full cursor-pointer" onclick="openModal('./data/portfolio/<?php echo $imageRoute; ?>', '<?php echo $portfolio['Name']; ?>', '<?php echo $portfolio['Category']; ?>', '<?php echo $portfolio['ImageRoute']; ?>')">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg" id="listVi" role="tabpanel" aria-labelledby="listVi-tab">
                <div id="divAll" class="grid grid-cols-3 max-[600px]:grid-cols-2 gap-4 max-[600px]:gap-1 items-center">
                    <?php foreach ($portArr as $portfolio) : ?>
                        <?php if ($portfolio['Category'] === '비쥬얼아이덴티티') : ?>
                            <div class="relative">
                                <?php $imageRoutes = explode(',', $portfolio['ImageRoute']); ?>
                                <?php foreach ($imageRoutes as $index => $imageRoute) : ?>
                                    <?php if ($index < 1) : ?>
                                        <img src="./data/admin_portfolio/<?php echo $imageRoute; ?>" alt="포트폴리오 이미지" class="w-full cursor-pointer" onclick="openModal('./data/portfolio/<?php echo $imageRoute; ?>', '<?php echo $portfolio['Name']; ?>', '<?php echo $portfolio['Category']; ?>', '<?php echo $portfolio['ImageRoute']; ?>')">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg" id="listEnv" role="tabpanel" aria-labelledby="listEnv-tab">
                <div id="divAll" class="grid grid-cols-3 max-[600px]:grid-cols-2 gap-4 max-[600px]:gap-1 items-center">
                    <?php foreach ($portArr as $portfolio) : ?>
                        <?php if ($portfolio['Category'] === '환경디자인') : ?>
                            <div class="relative">
                                <?php $imageRoutes = explode(',', $portfolio['ImageRoute']); ?>
                                <?php foreach ($imageRoutes as $index => $imageRoute) : ?>
                                    <?php if ($index < 1) : ?>
                                        <img src="./data/admin_portfolio/<?php echo $imageRoute; ?>" alt="포트폴리오 이미지" class="w-full cursor-pointer" onclick="openModal('./data/portfolio/<?php echo $imageRoute; ?>', '<?php echo $portfolio['Name']; ?>', '<?php echo $portfolio['Category']; ?>', '<?php echo $portfolio['ImageRoute']; ?>')">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg" id="listWeb" role="tabpanel" aria-labelledby="listWeb-tab">
                <div id="divAll" class="grid grid-cols-3 max-[600px]:grid-cols-2 gap-4 max-[600px]:gap-1 items-center">
                    <?php foreach ($portArr as $portfolio) : ?>
                        <?php if ($portfolio['Category'] === '웹디자인') : ?>
                            <div class="relative">
                                <?php $imageRoutes = explode(',', $portfolio['ImageRoute']); ?>
                                <?php foreach ($imageRoutes as $index => $imageRoute) : ?>
                                    <?php if ($index < 1) : ?>
                                        <img src="./data/admin_portfolio/<?php echo $imageRoute; ?>" alt="포트폴리오 이미지" class="w-full cursor-pointer" onclick="openModal('./data/portfolio/<?php echo $imageRoute; ?>', '<?php echo $portfolio['Name']; ?>', '<?php echo $portfolio['Category']; ?>', '<?php echo $portfolio['ImageRoute']; ?>')">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg" id="listEct" role="tabpanel" aria-labelledby="listEct-tab">
                <div id="divAll" class="grid grid-cols-3 max-[600px]:grid-cols-2 gap-4 max-[600px]:gap-1 items-center">
                    <?php foreach ($portArr as $portfolio) : ?>
                        <?php if ($portfolio['Category'] === '기타') : ?>
                            <div class="relative">
                                <?php $imageRoutes = explode(',', $portfolio['ImageRoute']); ?>
                                <?php foreach ($imageRoutes as $index => $imageRoute) : ?>
                                    <?php if ($index < 1) : ?>
                                        <img src="./data/admin_portfolio/<?php echo $imageRoute; ?>" alt="포트폴리오 이미지" class="w-full cursor-pointer" onclick="openModal('./data/portfolio/<?php echo $imageRoute; ?>', '<?php echo $portfolio['Name']; ?>', '<?php echo $portfolio['Category']; ?>', '<?php echo $portfolio['ImageRoute']; ?>')">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- 모달 -->
            <div id="imageModal" class="z-[1000] fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="modal-content bg-white rounded-lg pb-5 shadow-lg w-[90%] max-[400px]:w-[95%] max-w-[1080px] h-[90%] max-h-[900px] flex justify-center items-center">
                    <div class="w-full max-w-[630px]">
                        <div id="modalCategory" class="w-full pt-3 text-xl text-gray-700 text-left"></div>
                        <div id="modalName" class="w-full pt-1 pb-2 text-3xl text-gray-800 text-left font-semibold"></div>
                        <!-- <div id="modalImageRoute" class="w-full pt-1 pb-3 text-gray-600 text-left"></div> -->
                    </div>
                    <div id="closeModal" class="absolute top-2 right-2 p-2 cursor-pointer rounded-lg overflow-hidden bg-white/25 hover:bg-white/50 w-10 h-10"><img src="./image/icon/btn_X.png" alt="" class="w-full h-full"></div>
                    <div class="w-full max-w-[630px] max-h-[600px]">
                        <swiper-container id="swiper-container" class="mySwiper w-full " pagination="true" navigation="true" loop="true">

                        </swiper-container>
                    </div>
                </div>
            </div>
    </article>
</section>

<script>
    // 스와이퍼 객체를 저장할 전역 변수
    let mySwiper;

    // 모달 열기
    function openModal(imageSrc, name, category, imageRoute) {
        const modal = document.getElementById('imageModal');
        const modalName = document.getElementById('modalName');
        const modalCategory = document.getElementById('modalCategory');
        const modalImageRoute = document.getElementById('modalImageRoute');
        modalName.textContent = name;
        modalCategory.textContent = category;
        // modalImageRoute.textContent = imageRoute;

        // Swiper 슬라이드에 이미지 동적으로 추가
        const swiperWrapper = document.getElementById('swiper-container');
        const imageRoutes = imageRoute.split(','); // 쉼표로 구분된 이미지 경로를 배열로 분할
        swiperWrapper.innerHTML = ''; // 기존에 있는 슬라이드 삭제
        imageRoutes.forEach(route => {
            const swiperSlide = document.createElement('div'); // swiper-slide 태그 대신 div 태그 사용
            swiperSlide.classList.add('swiper-slide');
            swiperSlide.innerHTML = `<img src="./data/admin_portfolio/${route.trim()}" alt="" class="m-auto w-full object-cover">`;
            swiperWrapper.appendChild(swiperSlide);
        });

        // 이전에 생성된 swiper 삭제
        if (mySwiper) {
            mySwiper.destroy();
        }

        // Swiper 초기화
        mySwiper = new Swiper('.mySwiper', {
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            loop: true,
        });

        modal.classList.remove('hidden');
    }

    // 모달 닫기
    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<?php
include './footer.php';
?>