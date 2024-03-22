<?php
include './header.php';
?>





<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="./js/person_member_input.js"></script>


<div class="m-auto w-4/5 md:w-1/2 pt-20">
    <h1 class="font-bold text-4xl py-4 border-b-[3px] border-black">개인 회원가입</h1>

</div>
<div class="pt-10 m-auto w-4/5 md:w-1/2 max-[1004px]:w-4/5">
    <div id="inputform">
        <input type="hidden" name="id_chk" id="id_chk" value="0">
        <input type="hidden" name="email_chk" id="email_chk" value="0">

        <div class="flex max-[369px]:block ">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_id">아이디 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <div class="flex justify-between gap-1 max-[369px]:block max-[369px]:space-y-2 ">
                    <input class="rounded-md border-[#D9D9D9] w-4/6 max-[369px]:w-full " type="text" name="id" id="member_id">
                    <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 max-[369px]:w-full" id="btn_member_id_check" type="button">아이디 중복확인</button>
                </div>
                <p class="text-[#7D7D7D] text-xs">(영문소문자/숫자, 4~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_password">비밀번호 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <input class="w-full rounded-md border-[#D9D9D9]" type="password" name="password" id="member_password" placeholder="비밀번호를 입력해 주세요">
                <p class="text-[#7D7D7D] text-xs">(영문 대소문자/숫자/특수문자 중 2가지 이상 조합, 8자~16자)</p>
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_password_check">비밀번호확인 <p class="text-red-600">*</p></label></div>
            <input class="w-full  rounded-md border-[#D9D9D9]" type="password" name="password_check" id="member_password_check" placeholder="비밀번호를 다시 입력해 주세요">
        </div>

        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5"><label class="flex pt-2" for="member_email">이메일 <p class="text-red-600">*</p></label></div>
            <div class="w-full">
                <div class="flex justify-between items-center gap-4 max-[369px]:block">
                    <input class="w-1/4 max-[369px]:w-1/3  rounded-md border-[#D9D9D9]" type="text" id="member_email" name="email" placeholder="이메일을 입력해주세요">@
                    <input class="w-1/4  max-[369px]:w-1/4   rounded-md border-[#D9D9D9]" type="text" id="manual_email_input" placeholder="이메일을 입력해 주세요">
                    <select class="w-1/4  max-[369px]:w-1/3   rounded-md border-[#D9D9D9]" name="email_domain" id="email_domain">
                        <option value="manual_input">직접입력</option>
                        <option value="gmail.com">gmail.com</option>
                        <option value="naver.com">naver.com</option>
                        <option value="kakao.com">kakao.com</option>
                        <option value="hanmail.net">hanmail.net</option>
                    </select>
                </div>
                <button class="mt-2 rounded-md bg-[#182548] w-full text-white font-bold text-base py-2 px-3 " id="btn_member_email_check" type="button">이메일 중복확인</button>
            </div>
        </div>
       
        <div class="flex mt-4 max-[369px]:block">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_name">이름 <p class="text-red-600">*</p></label></div>
            <input class="rounded-md border-[#D9D9D9] w-full" type="text" name="name" id="member_name" placeholder="이름을 입력해 주세요">
        </div>

        <div class="flex mt-4 max-[369px]:block" id="mobileWrap">
            <div class="w-1/5 pt-2 max-[369px]:w-full"><label for="member_mobile">전화 번호</label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_mobile" name="member_mobile" pattern="[0-9]{3}">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="member_mobile2" name="member_mobile2" pattern="[0-9]{4}">
                <input class="w-1/3 rounded-md border-[#D9D9D9]" type="text" id="member_mobile3" name="member_mobile3" pattern="[0-9]{4}">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="phoneWrap">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">휴대전화 <p class="text-red-600">*</p></label></div>
            <div class="w-full flex justify-between items-center gap-2">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone" name="member_phone" pattern="[0-9]{3}">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone2" name="member_phone2" pattern="[0-9]{4}">
                <input class="w-1/3 rounded-md border-[#D9D9D9] " type="text" id="member_phone3" name="member_phone3" pattern="[0-9]{4}">
            </div>
        </div>

        <div class="flex mt-4 max-[369px]:block" id="addressWrap">
            <div class="w-1/5 max-[369px]:w-full"><label class="flex pt-2" for="member_phone">주소 <p class="text-red-600">*</p></label></div>
            <div class="w-full space-y-2">
                <div class="flex justify-between">
                    <input class=" w-3/5 rounded-md border-[#D9D9D9]" type="text" name="zipcode" id="member_zipcode" readonly>
                    <button class="rounded-md bg-[#182548] w-2/6 text-white font-bold text-base py-2 px-3 " id="btn_zipicode" type="button">우편번호 찾기</button>
                </div>
    
                <div class="w-full">
                    <input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr1" id="member_addr1" placeholder="">
        
                </div>
    
                <div class="w-full"><input class="w-full rounded-md border-[#D9D9D9]" type="text" name="member_addr2" id="member_addr2" placeholder="상세주소를 입력해 주세요"></div>
    
            </div>
        </div>
        
        <div id="buttonwrap">
            <button class="w-full rounded-md bg-mblack text-white font-bold text-xl p-3 my-8" id="input_btn" type="button">회원가입</button>
        </div>
    </div>

</div>






<?php
include './footer.php';
?>