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

        $title = "회사소개";
        $subtitle = "HOME / 회사소개";
        $filename = "intro";
        $textColor = "";

        render_header($title, $subtitle, $filename,$textColor);
        ?>
    </div>

    <div class=""></div>

    <div class="pt-[80px]">
    </div>
</section>

<section class="w-full relative flex flex-col justify-center items-center">
    <article id="introduction" class="w-full max-w-[1440px] flex flex-col justify-center items-center px-10 max-[390px]:px-5 py-20" style="background-image: url(./image/Page_intro/Bg_1-1.png); background-size:contain; background-repeat:no-repeat">
        <div class="w-full max-w-[1196px] my-12 border-[#001C7E] border-b-4">
            <div class="text-[46px] max-[720px]:text-[32px] max-[390px]:text-[28px]">S<span class="text-[34px] max-[720px]:text-[20px] max-[390px]:text-[16px]">KY</span>D<span class="text-[34px] max-[720px]:text-[20px] max-[390px]:text-[16px]">UCK</span>DESIGN <span class=" font-bold">소개</span></div>
        </div>

        <div class="w-full max-w-[1196px] my-8 flex flex-col text-[32px] max-[720px]:text-[24px] max-[390px]:text-[18px] gap-[1em] break-keep">
            <div>
                스카이덕 디자인은 일반 기업 및 각종 단체의 다양한 디자인제작에 대한 <span class="font-bold  ">디자인 컨설팅</span>을 하는 디자인 전문회사입니다
            </div>
            <div>
                <span class="font-bold  ">풍부한 노하우</span>를 갖춘 디자인 전문 인력들로 디자인이 필요한 모든 프로젝트들에 대해 <span class="font-bold  ">감각적인 창의성</span>을 바탕으로 <span class="font-bold  ">세련</span>되며 콘셉과 실용성, 그리고 심미성을 고려한 <span class="font-bold  ">완성도 높은 결과물</span>을 만나실 수 있습니다.
            </div>
            <div>
                카달로그, 리플렛, 브로슈어 등 콘텐츠기획부터 디자인, 촬영과 인쇄를 포함하는 <span class="font-bold  ">원스탑(ONE-STOP) 디자인 컨설팅 서비스</span>를 <span class="font-bold  ">스카이덕 디자인</span>에서 경험해 보세요.
            </div>
        </div>
    </article>
    <article id="classification">
        <div class="w-full max-w-[1440px] flex flex-col justify-center items-center px-10 py-20 max-[720px]:hidden">
            <img src="./image/Page_intro/classification.png" alt="">
        </div>
        <div class="w-full max-w-[1440px] flex flex-col justify-center items-center px-10 py-20 min-[720px]:hidden max-[390px]:hidden">
            <img src="./image/Page_intro/classification_t.png" alt="">
        </div>
        <div class="w-full max-w-[1440px] flex flex-col justify-center items-center px-10 py-20 min-[390px]:hidden">
            <img src="./image/Page_intro/classification_m.png" alt="">
        </div>
    </article>
    <article id="howToCome" class="w-full max-w-[1440px] flex flex-col justify-center items-center px-10 max-[390px]:px-5 py-20">
        <div class="w-full max-w-[1196px] my-12 border-[#001C7E] border-b-4">
            <div class="text-[46px] max-[720px]:text-[32px] max-[390px]:text-[28px]"><span class=" font-bold">오시는길</span></div>
        </div>

        <div id="map" class="w-full h-[550px] max-h-[400px] "></div>

    </article>
</section>



<!-- kakao map -->



<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=55022bcd2525beeddd280db1f43f0dbd"></script>



<script>
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
        mapOption = {
            center: new kakao.maps.LatLng(35.8847927, 128.612648), // 지도의 중심좌표
            level: 3 // 지도의 확대 레벨
        };

    var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

    var imageSrc = './image/icon/mapIcon_2.png', // 마커이미지의 주소입니다    
        imageSize = new kakao.maps.Size(82, 62), // 마커이미지의 크기입니다
        imageOption = {
            offset: new kakao.maps.Point(27, 69)
        }; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

    // 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
        markerPosition = new kakao.maps.LatLng(35.8847927, 128.612610); // 마커가 표시될 위치입니다

    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        position: markerPosition,
        image: markerImage // 마커이미지 설정 
    });

    // 마커가 지도 위에 표시되도록 설정합니다
    marker.setMap(map);
</script>

<?php
include './footer.php';
?>