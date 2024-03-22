document.addEventListener("DOMContentLoaded", () => {
  // 개인로그인
  const btn_login = document.querySelector("#btn_login_person");
  btn_login.addEventListener("click", () => {
      const member_login_id = document.querySelector("#member_login_id_person");
      const member_login_password = document.querySelector("#member_login_password_person");

      if (member_login_id.value == "") {
          alert("아이디를 입력해 주세요");
          member_login_id.focus();
          return false;
      }

      if (member_login_password.value == "") {
          alert("비밀번호를 입력해 주세요");
          member_login_password.focus();
          return false;
      }

      const f = new FormData();
      f.append("id", member_login_id.value);
      f.append("password", member_login_password.value);

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "./pg/login_process.php", true);
      xhr.send(f);

      xhr.onload = () => {
          if (xhr.status == 200) {
              const responseText = xhr.responseText;
              try {
                  const data = JSON.parse(responseText);
                  if (data.result == "login_success") {
                      alert("로그인에 성공");
                      self.location.href = "./index.php";
                  } else if (data.result == "login_fail") {
                      alert("아이디 혹은 비밀번호가 잘못되었습니다.");
                      member_login_id.value = "";
                      member_login_password.value = "";
                      member_login_id.focus();
                      return false;
                  } else if (data.result == "empty_id") {
                      alert("아이디가 비어있습니다.");
                      member_login_id.focus();
                      return false;
                  } else if (data.result == "empty_password") {
                      alert("비밀번호가 비어있습니다.");
                      member_login_password.focus();
                      return false;
                  }
              } catch (error) {
                  console.error("JSON parsing error:", error);
              }
          } else if (xhr.status == 404) {
              alert("연결실패 파일이 존재하지 않습니다.");
          } else {
              alert("알수없는 오류가 발생.");
          }
      }
  })

  // 비지니스 로그인
  const btn_login_b = document.querySelector("#btn_login_buiness");
  btn_login_b.addEventListener("click", () => {
      const member_login_id = document.querySelector("#member_login_id_buiness");
      const b_number = document.querySelector("#b_number");
      const member_login_password = document.querySelector("#member_login_password_buiness");

      if (member_login_id.value == "") {
          alert("아이디를 입력해 주세요");
          member_login_id.focus();
          return false;
      };

      if (b_number.value == "") {
          alert("사업자 번호를 입력해 주세요");
          b_number.focus();
          return false;
      };

      if (member_login_password.value == "") {
          alert("비밀번호를 입력해 주세요");
          member_login_password.focus();
          return false;
      };

      const f = new FormData();
      f.append("id", member_login_id.value);
      f.append("b_number", b_number.value);
      f.append("password", member_login_password.value);

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "./pg/business_login_process.php", true);
      xhr.send(f);

      xhr.onload = () => {
          if (xhr.status == 200) {
              const data = JSON.parse(xhr.responseText);
              if (data.result == "login_success") {
                  alert("로그인에 성공했습니다.");
                  self.location = "./index.php";
              } else if (data.result == "login_fail") {
                  alert("아이디 혹은 비밀번호가 잘못되었습니다.");
                  member_login_id.value = "";
                  b_number.value  = "";
                  member_login_password.value = "";
                  member_login_id.focus();
                  return false;
              } else if (data.result == "empty_id") {
                  alert("아이디가 비어있습니다.");
                  member_login_id.focus();
                  return false;
              } else if (data.result == "empty_password") {
                  alert("비밀번호가 비어있습니다.");
                  member_login_password.focus();
                  return false;
              } else if (data.result == "empty_bnum") {
                  alert("사업자번호가 비어있습니다.");
                  b_number.focus();
                  return false;
              }
          } else if (xhr.status == 404) {
              alert("연결 실패 파일이 존재하지않습니다.");
          } else {
              alert("알 수 없는 오류발생.");
          }
      }
  });
})