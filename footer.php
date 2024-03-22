<!-- 헤더 관련 스크립트 -->
<footer class="absolute bottom-0 w-full h-[400px] flex justify-center bg-[#333333]">
    <div class="max-w-[1440px] w-full h-full  flex flex-col min-[790px]:flex-row justify-around min-[790px]:justify-between px-8 min-[390px]:px-6 items-start min-[790px]:items-end min-[790px]:pb-24">
        <div class="text-[#c7c1c1] flex flex-col gap-4">
            <div><img class="w-[138px]" src="./image/logo/footer_logo.png" alt=""></div>
            <div class="flex flex-col gap-1 ">
                <div>대구광역시 북구 산격로 OOO길 OOO</div>
                <div class="flex flex-col min-[500px]:flex-row gap-2">
                    <div>Mobile : 010-7540-0153</div>
                    <div>Fax : 0508-957-0153</div>
                </div>
                <div>E-mail : skyduck_ds@naver.com</div>
                <div>Copyright © SKYDUCKDESIGN Co.</div>
            </div>
        </div>
        <div class=" text-white min-[790px]:h-full flex items-end max-[790px]:w-full max-[790px]:justify-center">
            <div class="flex flex-row gap-4 ">
                <a href="tel:01075400153">
                    <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_call_icon.png" alt=""></div>
                </a>

                <a href="tel:01075400153">
                    <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_kakao_icon.png" alt=""></div>
                </a>

                <a href="tel:01075400153">
                    <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_insta_icon.png" alt=""></div>
                </a>

                <a href="tel:01075400153">
                    <div class="w-10 h-10"><img class="w-full h-full" src="./image/icon/footer_blog_icon.png" alt=""></div>
                </a>
            </div>
        </div>
    </div>
</footer>




<!-- 부트스트랩 CDN 스크립트 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>
    if (window.location.pathname == '/index.php') {
        window.location.href = "/";
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>


<!-- 헤더 토글 스크립트 -->
<script>
        document.getElementById('MenuToggleBtn').addEventListener('click', function() {
            document.getElementById('ToggleMenu').classList.remove('left-[100%]');
            document.getElementById('ToggleMenu').classList.add('left-0');
        });
    </script>
    <script>
        document.getElementById('ToggleCloseBtn').addEventListener('click', function() {
            document.getElementById('ToggleMenu').classList.remove('left-0');
            document.getElementById('ToggleMenu').classList.add('left-[100%]');
        });
    </script>

</body>

</html>