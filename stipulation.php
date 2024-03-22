<?php
include './header.php';
?>


<script src="./js/member_agree.js"></script>



<div class="m-auto w-4/5 sm:w-1/2 pt-20">
  <h1 class="font-bold text-4xl py-4 border-b-[3px] border-black">회원가입</h1>
  <p class="font-bold pt-3 ps-3">SkyDuck Design에 오신 것을 환영합니다. </p>
</div>

<div class="m-auto w-4/5 sm:w-1/2 ">
  <div class="border-black border-b pb-4 pt-12">
    <input class="text-gray-500  rounded-sm " type="checkbox" id="checkAll">
    <label for="checkAll">
      <p class="ps-2 text-lg">전체 동의</p>
    </label>
    <p class="ps-[27px]">이용약관, 개인정보수집 및 이용, 쇼핑정보 수신(선택)에 모두 동의합니다.</p>
  </div>
  <div class="mt-5">
    <input type="checkbox" class="chk text-gray-500  rounded-sm" id="chk_member1">
    <label class="ps-2 text-lg" for="chk_member1">이용약관 동의(필수)</label>
  </div>
  <textarea class="w-full rounded-md py-[15px] ps-[20px] bg-[#f1f1f1] border-none  text-[#7d7d7d] mt-3" readonly name="" id="" cols="30" rows="8">
할인쿠폰 및 혜택, 이벤트, 신상품 소식 등 쇼핑몰에서 제공하는 유익한 쇼핑정보를 SMS와 이메일로 받아보실 수 있습니다.

단, 주문/거래 정보 및 주요 정책과 관련된 내용은 수신동의 여부와 관계없이 발송됩니다.

선택 약관에 동의하지 않으셔도 회원가입은 가능하며, 회원가입 후 회원정보수정 페이지에서 언제든지 수신여부를 변경하실 수 있습니다.
할인쿠폰 및 혜택, 이벤트, 신상품 소식 등 쇼핑몰에서 제공하는 유익한 쇼핑정보를 SMS와 이메일로 받아보실 수 있습니다.

단, 주문/거래 정보 및 주요 정책과 관련된 내용은 수신동의 여부와 관계없이 발송됩니다.

선택 약관에 동의하지 않으셔도 회원가입은 가능하며, 회원가입 후 회원정보수정 페이지에서 언제든지 수신여부를 변경하실 수 있습니다.
할인쿠폰 및 혜택, 이벤트, 신상품 소식 등 쇼핑몰에서 제공하는 유익한 쇼핑정보를 SMS와 이메일로 받아보실 수 있습니다.

단, 주문/거래 정보 및 주요 정책과 관련된 내용은 수신동의 여부와 관계없이 발송됩니다.

선택 약관에 동의하지 않으셔도 회원가입은 가능하며, 회원가입 후 회원정보수정 페이지에서 언제든지 수신여부를 변경하실 수 있습니다.
할인쿠폰 및 혜택, 이벤트, 신상품 소식 등 쇼핑몰에서 제공하는 유익한 쇼핑정보를 SMS와 이메일로 받아보실 수 있습니다.

단, 주문/거래 정보 및 주요 정책과 관련된 내용은 수신동의 여부와 관계없이 발송됩니다.

선택 약관에 동의하지 않으셔도 회원가입은 가능하며, 회원가입 후 회원정보수정 페이지에서 언제든지 수신여부를 변경하실 수 있습니다.
  </textarea>
  <div class="mt-5">
    <input type="checkbox" class="chk text-gray-500  rounded-sm" id="chk_member2">
    <label class="text-lg ps-2" for="chk_member2">개인정보 수집 및 이용에 대한 안내(필수)</label>
  </div>
  <textarea class="w-full rounded-md py-[15px] ps-[20px] bg-[#f1f1f1] border-none text-[#7d7d7d] mt-3"  readonly name="" id="" cols="30" rows="8">
할인쿠폰 및 혜택, 이벤트, 신상품 소식 등 쇼핑몰에서 제공하는 유익한 쇼핑정보를 SMS와 이메일로 받아보실 수 있습니다.

단, 주문/거래 정보 및 주요 정책과 관련된 내용은 수신동의 여부와 관계없이 발송됩니다.

선택 약관에 동의하지 않으셔도 회원가입은 가능하며, 회원가입 후 회원정보수정 페이지에서 언제든지 수신여부를 변경하실 수 있습니다.
  </textarea>
  <div class="mt-5">
    <input type="checkbox" class="chk text-gray-500  rounded-sm" id="chk_member3">
    <label class="text-lg ps-2" for="chk_member3">이메일 수신 동의(선택)</label>
  </div>
  <textarea class="w-full rounded-md py-[15px] ps-[20px] bg-[#f1f1f1] border-none pointer-events-none text-[#7d7d7d] mt-3" readonly name="" id="" cols="30" rows="8">
할인쿠폰 및 혜택, 이벤트, 신상품 소식 등 쇼핑몰에서 제공하는 유익한 쇼핑정보를 SMS와 이메일로 받아보실 수 있습니다.

단, 주문/거래 정보 및 주요 정책과 관련된 내용은 수신동의 여부와 관계없이 발송됩니다.

선택 약관에 동의하지 않으셔도 회원가입은 가능하며, 회원가입 후 회원정보수정 페이지에서 언제든지 수신여부를 변경하실 수 있습니다.
  </textarea>

  <div class="flex gap-1">
    <button class="w-full rounded-md bg-mblack text-white font-bold text-xl p-3 my-8" id="btn_stipulation_person" type="button">개인 회원가입</button>
    <button class="w-full rounded-md bg-mblack text-white font-bold text-xl p-3 my-8" id="btn_stipulation_buiness" type="button">사업자 회원가입</button>
  </div>
  <form action="person_member_input.php" method="post" name="stipulation_form" style="display:none">
    <input type="hidden" name="chk" value="0">
  </form>
  <form action="buiness_member_input.php" method="post" name="stipulation_form2" style="display:none">
    <input type="hidden" name="chk" value="0">
  </form>
</div>



<?php
include './footer.php';
?>