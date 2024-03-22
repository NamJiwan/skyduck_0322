document.addEventListener("DOMContentLoaded", () => {
  document.querySelector('#checkAll')

  document.querySelector('#checkAll').addEventListener('click', function(){
  
      const isChecked = checkAll.checked;
  
      if(isChecked){
          const checkboxes = document.querySelectorAll('.chk');
  
          for(const checkbox of checkboxes){
              checkbox.checked = true;
          }
      }
  
      else{
          const checkboxes = document.querySelectorAll('.chk');
          for(const checkbox of checkboxes){
              checkbox.checked = false;
          }
      }
  })
  ////////////////////////////////////////////////////////////
  const checkboxes = document.querySelectorAll('.chk');
  for(const checkbox of checkboxes){
    checkbox.addEventListener('click',function(){
      
      const totalCnt = checkboxes.length;
    
      const checkedCnt = document.querySelectorAll('.chk:checked').length;
      
      if(totalCnt == checkedCnt){
        document.querySelector('#checkAll').checked = true;
      }
      else{
        document.querySelector('#checkAll').checked = false;
      }
      
    });
    
  }

  const btn_person_member = document.querySelector("#btn_stipulation_person");
  const btn_buiness_member = document.querySelector("#btn_stipulation_buiness");
  
    // stipulation.php에서만 실행되어야 하는 코드
    btn_person_member.addEventListener("click", () => {
      const chk_member1 = document.querySelector("#chk_member1");
      if (chk_member1.checked != true) {
        alert("이용약관에 동의해 주셔야 가입이 가능합니다.");
        return false;
      }

      const chk_member2 = document.querySelector("#chk_member2");
      if (chk_member2.checked != true) {
        alert("개인정보 수집 및 이용에 대한 안내에 동의해 주셔야 가입이 가능합니다.");
        return false;
      }

      const f = document.stipulation_form;
      f.chk.value = 1;
      f.submit();
    });
    btn_buiness_member.addEventListener("click", () => {
      const chk_member1 = document.querySelector("#chk_member1");
      if (chk_member1.checked != true) {
        alert("이용약관에 동의해 주셔야 가입이 가능합니다.");
        return false;
      }

      const chk_member2 = document.querySelector("#chk_member2");
      if (chk_member2.checked != true) {
        alert("개인정보 수집 및 이용에 대한 안내에 동의해 주셔야 가입이 가능합니다.");
        return false;
      }

      const f = document.stipulation_form2;
      f.chk.value = 1;
      f.submit();
    });
  
});
