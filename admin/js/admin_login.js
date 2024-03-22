document.addEventListener("DOMContentLoaded", () => {
    const admin_id = document.querySelector("#admin_id");
    const admin_password = document.querySelector("#admin_password");
    const admin_login = document.querySelector("#admin_login");
    admin_login.addEventListener("click", () => {
        if (admin_id.value == "") {
            alert("아이디가 비어있습니다. 다시 입력해 주세요.");
            admin_id.focus();
            return false;
        };

        if (admin_password.value == "") {
            alert("비밀번호가 비어있습니다. 다시 입력해 주세요.");
            admin_password.focus();
            return false;
        };

        const f = new FormData();
        f.append("admin_id", admin_id.value);
        f.append("admin_password", admin_password.value);
        f.append("mode", "admin_login");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/admin_login_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);

                    if (data.result == 'empty_mode') {
                        alert("잘못된 접근");
                        return false;
                    };
                    
                    if (data.result == 'empty_admin_id') {
                        alert("아이디가 비어있습니다. 다시 입력해 주세요");
                        admin_id.focus();
                        return false;
                    };

                    if (data.result == 'empty_admin_password') {
                        alert("비밀번호가 비어있습니다. 다시 입력해 주세요.");
                        admin_password.focus();
                        return false;
                    };

                    if (data.result == 'login_fail') {
                        alert("로그인에 실패했습니다. 아이디 혹은 비밀번호를 확인해 주세요");
                        admin_id.value = '';
                        admin_password.value = '';
                        admin_id.focus();
                        return false;
                    };

                    if (data.result == 'admin_login_success') {
                        alert("로그인 성공");
                        self.location.href = './admin_main.php';
                    };

                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("연결 실패 존재하지 않는 파일입니다.");
                return false;
            };
        }
    });
});