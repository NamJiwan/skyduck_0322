<?php
include './header.php';
?>


<script src="./js/login.js"></script>

<div class="pt-40 m-auto w-4/5 sm:w-1/2">
  <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist" data-tabs-active-classes="bg-loginblue text-white border-none">
    <li class="w-1/2 border border-slate-400 " role="presentation">
      <button class="inline-block w-full p-4 text-xl text-[#7D7D7D] font-bold " id="login-tab" data-tabs-target="#person" type="button" role="tab" aria-controls="profile" aria-selected="false">개인</button>
    </li>
    <li class="w-1/2 border border-slate-400" role="presentation">
      <button class="inline-block w-full p-4 text-xl text-[#7D7D7D] font-bold onShow:bg-blue-600 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 " id="buiness-tab" data-tabs-target="#buiness" type="button" role="tab" aria-controls="dashboard" aria-selected="false">사업자</button>
    </li>
  </ul>
</div>
<div class="m-auto w-4/5 sm:w-1/2" id="default-tab-content">
  <div class="hidden  mt-8 " id="person" role="tabpanel" aria-labelledby="person-tab">
    
      <div class="py-3  border-b-2 border-black">
        <h1 class="text-4xl font-medium">개인 로그인 </h1>
      </div>
      <input class="w-full mt-10 p-3 placeholder-slate-400 border rounded-md" type="text" placeholder="아이디" name="user_id" id="member_login_id_person">
      <input class="w-full my-2 p-3 placeholder-slate-400 border rounded-md" type="password" placeholder="비밀번호" name="user_password" id="member_login_password_person">
      <button class="w-full rounded-md bg-mblack text-white font-bold text-xl p-3 my-8" id="btn_login_person" type="button">로그인</button>
    
    <div class="flex justify-between">
      <a href="./stipulation.php">회원가입</a>
      <a href="">비밀번호 찾기</a>
    </div>
  </div>
  <div class="hidden mt-8" id="buiness" role="tabpanel" aria-labelledby="buiness-tab">
    <form action="">
      <div class="py-3  border-b-2 border-black">
        <h1 class="text-4xl font-medium">사업자 로그인 </h1>
      </div>
      <input class="w-full mt-10 p-3 placeholder-slate-400 border rounded-md" type="text" placeholder="사업자등록번호" name="buiness_number" id="b_number">
      <input class="w-full mt-2 p-3 placeholder-slate-400 border rounded-md" type="text" placeholder="아이디" name="buiness_id" id="member_login_id_buiness">
      <input class="w-full my-2 p-3 placeholder-slate-400 border rounded-md" type="password" placeholder="비밀번호" name="buiness_password" id="member_login_password_buiness">
      <button class="w-full rounded-md bg-mblack text-white font-bold text-xl p-3 my-8" id="btn_login_buiness" type="button">로그인</button>
    </form>
    <div class="flex justify-between">
      <a href="./stipulation.php">회원가입</a>
      <a href="">비밀번호 찾기</a>
    </div>
  </div>

</div>






<?php
include './footer.php';
?>