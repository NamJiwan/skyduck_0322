function isValidEmailDomain(emailDomain) {
    // 이메일 도메인을 검사하는 정규식
    const domainRegex = /^[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$/;
    
    // 정규식 검사
    return domainRegex.test(emailDomain);
}

function validatePassword(password) {
    // 비밀번호가 영문, 숫자, 특수문자를 포함하고 8자에서 16자까지의 길이를 가지는지 확인하는 정규식
    const regex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=])[a-zA-Z\d!@#$%^&*()-_+=]{8,16}$/;

    if (regex.test(password)) {
        return true; // 비밀번호가 조건을 만족하는 경우
    } else {
        return false; // 비밀번호가 조건을 만족하지 않는 경우
    }
}

document.addEventListener("DOMContentLoaded", () => {
    let emailChecked = false;
    const member_id = document.querySelector("#member_id");
    const member_password = document.querySelector("#member_password");
    const member_password_check = document.querySelector("#member_password_check");
    const member_name = document.querySelector("#member_name");
    const btn_member_email_check = document.querySelector("#btn_member_email_check");
    const member_mobile = document.querySelector("#member_mobile");
    const member_mobile2 = document.querySelector("#member_mobile2");
    const member_mobile3 = document.querySelector("#member_mobile3");
    const member_phone = document.querySelector("#member_phone");
    const member_phone2 = document.querySelector("#member_phone2");
    const member_phone3 = document.querySelector("#member_phone3");
    const old_email = document.querySelector("#old_email");
    const email_id = document.querySelector("#member_email");
    const email_domain = document.querySelector("#email_domain");
    const manual_email_input = document.querySelector("#manual_email_input");
    const member_zipcode = document.querySelector("#member_zipcode");
    const member_addr1 = document.querySelector("#member_addr1");
    const member_addr2 = document.querySelector("#member_addr2");
    let new_email = '';

    email_domain.addEventListener("change", () => {
        manual_email_input.value = "";
    });

    if (email_domain.value === "manual_input") {
        new_email = email_id.value + "@" + manual_email_input.value;
    } else {
        new_email = email_id.value + "@" + email_domain.value;
    };

    btn_member_email_check.addEventListener("click", () => {

        if (email_domain.value === "manual_input") {
            new_email = email_id.value + "@" + manual_email_input.value;
        } else {
            new_email = email_id.value + "@" + email_domain.value;
        };
        
        console.log(new_email)
        if (old_email.value == new_email) {
            alert("이메일 중복확인이 필요없습니다. 새로운 이메일로 변경시 이메일 중복확인을 눌러주세요");
            return false;
        };

        if (email_id.value == "") {
            alert("이메일을 입력해 주세요.");
            email_id.focus();
            return false;
        };

        if (email_domain.value == "manual_input") {
            if (manual_email_input.value == "") {
                alert("직접입력을 선택하셨습니다. 이메일 도메인을 입력해 주세요.");
                manual_email_input.focus();
                return false;
            };

            if (!isValidEmailDomain(manual_email_input.value)) {
                alert("잘못된 형식의 이메일 도메인입니다. 다시 입력해 주세요.");
                manual_email_input.value = "";
                manual_email_input.focus();
                return false;
            };
        };

        const f = new FormData();
        f.append("email", new_email);
        f.append("mode", "email_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./../pg/member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);

                    if (data.result === "success") {
                        alert("사용가능한 이메일 입니다.");
                        // document.querySelector("#email_chk") = "1";
                        emailChecked = true;
                    } else if (data.result === "fail") {
                        alert("이미 사용중인 이메일입니다.");
                        // document.querySelector("#email_chk") = "0";
                        emailChecked = false;
                        email_id.value = "";
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        };
                        email_domain.value = "gmail.com";
                        return false;
                    } else if (data.result == "empty_email") {
                        alert("이메일을 입력해 주세요");
                        email_id.focus();
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        };
                        email_domain.value = "gmail.com";
                        return false;
                    } else if (data.result == "email_format_wrong") {
                        alert("이메일이 형식에 맞지않습니다.");
                        email_id.value = "";
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        };
                        email_domain.value = "gmail.com";
                        return false;
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("접근 실패 다시 시도해 주세요.");
                self.location.reload();
            };
        };
    });

    const btn_zipcode = document.querySelector("#btn_zipicode");

    btn_zipcode.addEventListener("click", () => {
        new daum.Postcode({
            oncomplete: function(data) {
                console.log(data);

                let addr = "";
                let extra_addr = "";

                if (data.userSelectType == "J") {
                    addr = data.jibunAddress;
                } else if (data.userSelectType == "R") {
                    addr = data.roadAddress;
                }

                if (data.bname != "") {
                    extra_addr = data.bname;
                }

                if (data.buildingName != "") {
                    if (extra_addr == "") {
                        extra_addr = data.buildingName;
                    } else {
                        extra_addr += ", " + data.buildingName;
                    }
                }

                if (extra_addr != "") {
                    extra_addr = " (" + extra_addr + ")";
                }

                const member_addr1 = document.querySelector("#member_addr1");
                member_addr1.value = addr + extra_addr;

                const member_zipcode = document.querySelector("#member_zipcode");
                member_zipcode.value = data.zonecode;

                const member_addr2 = document.querySelector("#member_addr2");
                member_addr2.focus();
            },
        }).open();
    });

    const edit_btn = document.querySelector("#edit_btn");
    
    edit_btn.addEventListener("click", () => {
        if (member_password.value != member_password_check.value) {
            alert("비밀번호가 서로 일치하지 않습니다. 다시 입력해 주세요.");
            member_password.value = "";
            member_password_check.value = "";
            member_password.focus();
            return false;
        };

        if (member_password.value != '' && member_password_check.value != '' && !validatePassword(member_password.value)) {
            alert("형식에 맞지않는 비밀번호 입니다.");
            member_password.value = "";
            member_password.focus();
            member_password_check.value = "";
            return false;
        };

        if (email_id.value == "") {
            alert("이메일을 입력해 주세요");
            email_id.focus();
            return false;
        };

        if (email_domain.value == "manual_input") {
            if (manual_email_input.value == "") {
                alert("직접입력을 선택하셧습니다. 도메인을 입력해 주세요");
                manual_email_input.focus();
                return false;
            };
        };

        if (old_email.value != new_email) {
            if (emailChecked == false && document.querySelector("#email_chk").value == "0") {
                alert("이메일 중복확인을 해주세요");
                return false;
            };
        };

        if (member_name.value == "") {
            alert("이름을 입력해 주세요");
            member_name.focus();
            return false;
        };

        if (member_mobile.value == "" || member_mobile2.value == "" || member_mobile3.value == "") {
            alert("연락처를 입력해 주세요");
            member_mobile.focus();
            return false;
        };

        if (member_phone.value == "" || member_phone2.value == "" || member_phone3.value == "") {
            alert("연락처를 입력해 주세요");
            member_mobile.focus();
            return false;
        };

        if (member_zipcode.value == "") {
            alert("우편번호가 비어있습니다. 다시 입력해 주세요");
            return false;
        };

        if (member_addr1.value == "") {
            alert("주소가 비어있습니다. 다시 입력해 주세요.");
            return false;
        };

        if (member_addr2.value == "") {
            alert("상세 주소를 입력해주세요.");
            member_addr2.focus();
            return false;
        };

        const mPhone = member_phone.value + "-" + member_phone2.value + "-" + member_phone3.value;
        const mMobile = member_mobile.value + "-" + member_mobile2.value + "-" + member_mobile3.value;

        // console.log(mPhone);
        // return;
        const f = new FormData();
        f.append("id", member_id.value);
        f.append("password", member_password.value);
        f.append("email", new_email);
        f.append("name", member_name.value);
        f.append("mobile", mMobile);
        f.append("phone", mPhone);
        f.append("zipcode", member_zipcode.value);
        f.append("addr", member_addr1.value);
        f.append("detail_addr", member_addr2.value);
        f.append("mode", "admin_edit");
        
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./../pg/member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result == 'success') {
                        alert("수정되었습니다.");
                        self.location.href = "./admin_member.php";
                    } else if (data.result == 'fail' ) {
                        alert("수정실패");
                        return false;
                    };
                } catch (error) {
                    console.error("JSON parsing error:", error);
                }
            } else if (xhr.status == 404) {
                alert("연결 실패: 파일이 존재하지 않습니다.");
            } else {
                alert("알 수 없는 오류가 발생했습니다.");
            }
        }
    });
});