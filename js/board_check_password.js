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
    const password_check_submit = document.querySelector("#password_check_submit");
    const password = document.querySelector("#passwordcheck");

    password_check_submit.addEventListener("click", () => {
        if (password.value == '') {
            alert("비밀번호가 비어있습니다. 입력해 주세요.");
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

        const params = getUrlParams();

        const f = new FormData();
        f.append("password", password.value);
        f.append("idx", params["idx"]);
        f.append("mode", "board_password_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/question_board_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result == 'empty_idx') {
                        alert("잘못된 게시물 정보입니다. 다시 시도해주세요");
                        self.location.href = "./board.php";
                        return false;
                    };

                    if (data.result == 'empty_password') {
                        alert("비밀번호가 비어있습니다. 다시 입력해주세요.");
                        password.focus();
                        return false;
                    };

                    if (data.result == 'success') {
                        alert("인증 성공");
                        self.location.href = "./board_detail_view.php?idx=" + params["idx"];
                    } else if (data.result == 'fail') {
                        alert("인증 실패");
                        self.location.reload();
                    };
                } catch (error) {
                    console.error("JSON parsing error:", error);
                }
            } else if (xhr.status == 404) {
                alert("실패 파일이 존재하지 않습니다.");
                return false;
            }
        }
    });
});