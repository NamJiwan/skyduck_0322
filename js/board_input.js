function getExtensionOfFilename(filename) {
  // 파일 이름에서 마지막 점을 찾아 확장자를 추출
  const dotIndex = filename.lastIndexOf(".");
  
  // 점을 찾았고, 파일 이름에 점이 있으며 마지막 문자가 아닌 경우 확장자 반환
  if (dotIndex !== -1 && dotIndex < filename.length - 1) {
      return filename.substring(dotIndex + 1).toLowerCase();
  }
  
  // 그 외의 경우 확장자가 없음을 나타내는 빈 문자열 반환
  return "";
}


function getUrlParams() {
    const params = {};
  
    window.location.search.replace(
      /[?&]+([^=&]+)=([^&]*)/gi,
      function (str, key, value) {
        params[key] = value;
      }
    );
  
    return params;
  }
  

document.addEventListener("DOMContentLoaded", () => {
    const name = document.querySelector("#name");
    const password = document.querySelector("#password");
    const email = document.querySelector("#email");
    const phonenumber = document.querySelector("#phone_number");
    const title = document.querySelector("#title");
    const content = document.querySelector("#content");
    const attach = document.querySelector("#attachments");
    const board_write_submit = document.querySelector("#board_write_submit");

    board_write_submit.addEventListener("click", () => {
        if (name.value == '') {
          alert("이름을 입력해 주세요");
          name.focus();
          return false;
        };

        if (password.value == '') {
          alert("비밀번호 숫자 4자리를 입력해 주세요");
          password.focus();
          return false;
        };

        const regex = /^\d{4}$/;

        if (!(regex.test(password.value))) {
          alert("올바르지 않은 비밀번호 입니다. 다시 입력해 주세요");
          password.value = '';
          password.focus();
          return false;
        };

        // if (email.value == "") {
        //   alert("이메일이 비어있습니다. 입력해 주세요.");
        //   email.focus();
        //   return false;
        // };

        if (phonenumber.value == "") {
          alert("연락처가 비어있습니다. 입력해 주세요.");
          phonenumber.focus();
          return false;
        };

        if (title.value == "") {
          alert("제목이 비어있습니다. 입력해주세요");
          title.focus();
          return false;
        };

        if (content.value == "") {
          alert("내용이 없습니다. 입력해 주세요");
          content.focus();
          return false;
        };

        if (attach.files.length > 5) {
          alert("첨부할 수 있는 파일의 갯수는 5개 입니다.");
          attach.value = "";
          return false;
        };

        const f = new FormData();
        f.append("name", name.value);
        f.append("password", password.value);
        f.append("email", email.value);
        f.append("tel", phonenumber.value);
        f.append("title", title.value);
        f.append("content", content.value);
        f.append("mode", "board_input");

        let ext = "";

        for (const file of attach.files) {
          if (file.size > 40 * 1024 * 1024) {
            alert("파일 용량이 40메가를 초과했습니다.");
            attach.value = "";
            return false;
          };

          ext = getExtensionOfFilename(file.name);

          if (
            ext == "txt" ||
            ext == "exe" ||
            ext == "xls" ||
            ext == "dmg" ||
            ext == "php" ||
            ext == "js"
          ) {
            alert("첨부할 수 없는 포맷의 파일이 첨부되었습니다.(exe, txt 등)");
            attach.value = "";
            return false;
          }

          f.append("files[]", file);
        };

        console.log(f);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/question_board_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
          if (xhr.status == 200) {
            const responsText = xhr.responseText;
            try {
              const data = JSON.parse(responsText);

              if (data.result == 'empty_name') {
                alert("이름이 비어있습니다. 입력해주세요.");
                name.focus();
                return false;
              };

              if (data.result == 'empty_password') {
                alert("비밀번호가 비어있습니다. 입력해 주세요");
                password.focus();
                return false;
              };

              // if (data.result == 'empty_email') {
              //   alert("이메일이 비어있습니다. 다시 입력해 주세요.");
              //   email.focus();
              //   return false;
              // };

              if (data.result == 'empty_tel') {
                alert("연락처가 비어있습니다. 다시 입력해 주세요.");
                phonenumber.focus();
                return false;
              };

              if (data.result == 'empty_title') {
                alert("제목이 비어있습니다. 다시 입력해 주세요.");
                title.focus();
                return false;
              };

              if (data.result == 'empty_content') {
                alert("내용을 입력해 주세요");
                content.focus();
                return false;
              };

              if (data.result == 'empty_mode') {
                alert("잘못된 접근");
                return false;
              };

              if (data.result == 'fail') {
                alert("등록 실패");
                self.location.reload();
                return false;
              };

              if (data.result == 'success') {
                alert("문의글이 등록되었습니다.");
                self.location.href = './index.php';
              };

            } catch (error) {
              console.error("JSON parsing error:", error);
            }
          } else if (xhr.status == 404) {
            alert("실패 파일이 존재하지 않습니다.");
            return false;
          };
        };
    });
})