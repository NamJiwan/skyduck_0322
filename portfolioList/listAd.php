<!-- 이미지 그리드 -->


<div class="d-flex mt-3 justify-content-between align-items-start">
    <?php
    if (isset($sn) && $sn != '' && isset($sf) && $sf != '') {
        $param = '&sn=' . $sn . '&sf=' . $sf;
    }
    echo my_pagination($total, $limit, $page_limit, $page, $param);
    ?>
</div>

<!-- <script>
    // 모달 열기
    function openModal(imageSrc, name, category, imageRoute) {
        const modal = document.getElementById('imageModal');
        const modalName = document.getElementById('modalName');
        const modalCategory = document.getElementById('modalCategory');
        // const modalImageRoute = document.getElementById('modalImageRoute');
        modalName.textContent = name;
        modalCategory.textContent = category;
        // modalImageRoute.textContent = imageRoute;

        // Swiper 슬라이드에 이미지 동적으로 추가
        const swiperWrapper = document.getElementById('swiper-container');
        colsole.log(swiperWrapper)
        const imageRoutes = imageRoute.split(','); // 쉼표로 구분된 이미지 경로를 배열로 분할
        swiperWrapper.innerHTML = ''; // 기존에 있는 슬라이드 삭제
        imageRoutes.forEach(route => {
            const swiperSlide = document.createElement('div'); // swiper-slide 태그 대신 div 태그 사용
            swiperSlide.classList.add('swiper-slide');
            swiperSlide.innerHTML = `<img src="./data/portfolio/${route.trim()}" alt="" class="m-auto w-full h-full object-cover">`;
            swiperWrapper.appendChild(swiperSlide);
        });

        // Swiper 초기화
        if (!mySwiper) {
            // Swiper 객체가 없는 경우에만 초기화
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
        }

        modal.classList.remove('hidden');
    }

    // 모달 닫기
    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    });
</script> -->




