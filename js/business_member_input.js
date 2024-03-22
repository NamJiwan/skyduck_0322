function isId(asValue) {
	var regExp = /^[a-z]+[a-z0-9]{5,19}$/g;
 
	return regExp.test(asValue);
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

function isValidEmailDomain(emailDomain) {
    // 이메일 도메인을 검사하는 정규식
    const domainRegex = /^[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)+$/;
    
    // 정규식 검사
    return domainRegex.test(emailDomain);
}

// 파일 선택을 처리하는 함수
function handleFileSelect(event) {
    return new Promise((resolve, reject) => {
        // 선택된 파일 가져오기
        var selectedFile = event.target.files[0];

        // 선택된 파일과 관련된 추가 작업 수행(서버에 업로드하는 등)

        // 성공적으로 작업을 수행한 경우 선택된 파일을 resolve로 반환
        resolve(selectedFile);

        // 작업이 실패한 경우 reject를 사용하여 에러를 전달할 수도 있습니다.
        // reject("작업 실패");
    });
}


document.addEventListener("DOMContentLoaded", () => {
    const businessImageInput = document.getElementById('business_image');
    let b_image;

    businessImageInput.addEventListener('change', async (event) => {
        try {
            const selectedFile = await handleFileSelect(event);
            console.log('선택된 파일:', selectedFile);
            b_image = selectedFile;
            // 여기서 선택된 파일을 이용한 추가 작업을 수행할 수 있습니다.
        } catch (error) {
            console.error('에러 발생:', error);
        }
    });

    let idCheck = false;
    let emailChecked = false;
    let emailToCheck = "";
    let b_number_chk = false;


    const business_member_id = document.querySelector("#business_member_id");
    const btn_member_id_check = document.querySelector("#btn_member_id_check");
    const business_member_password = document.querySelector("#business_member_password");
    const business_member_password_chk = document.querySelector("#business_member_password_chk");
    const company_name = document.querySelector("#company_name");
    const ceo_name = document.querySelector("#ceo_name");
    const business_member_email = document.getElementById("business_member_email");
    const manual_email_input = document.getElementById("manual_email_input");
    const email_domain = document.getElementById("email_domain");
    const btn_member_email_check = document.getElementById("btn_member_email_check");
    const btn_zipcode = document.querySelector("#btn_zipicode");
    const business_member_mobile = document.querySelector("#business_member_mobile");
    const business_member_mobile2 = document.querySelector("#business_member_mobile2");
    const business_member_mobile3 = document.querySelector("#business_member_mobile3");
    const business_member_phone = document.querySelector("#business_member_phone");
    const business_member_phone2 = document.querySelector("#business_member_phone2");
    const business_member_phone3 = document.querySelector("#business_member_phone3");
    const business_member_fax = document.querySelector("#business_member_fax");
    const business_member_fax2 = document.querySelector("#business_member_fax2");
    const business_member_fax3 = document.querySelector("#business_member_fax3");
    const business_registration_number = document.querySelector("#business_registration_number");
    const btn_business_number_chk = document.querySelector("#btn_business_number_chk");
    const business_type = document.querySelector("#business_type");
    const business_category = document.querySelector("#business_category");
    const input_submit = document.querySelector("#input_submit");

    btn_member_id_check.addEventListener("click", () => {
        if (business_member_id.value == "") {
            alert("아이디를 입력해 주세요");
            business_member_id.focus();
            return false;
        }

        if (!isId(business_member_id.value)) {
            alert("잘못된 형식의 아이디 입니다.");
            business_member_id.value = '';
            business_member_id.focus();
            return false;
        }

        const f = new FormData();
        f.append("id", business_member_id.value);
        f.append("mode", "id_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status === 200) {
                const responseText = xhr.responseText;
                console.log(responseText);
                try {
                    const data = JSON.parse(responseText);
                    console.log(data);
                    if (data.result === 'success') {
                        alert("사용이 가능한 아이디 입니다.");
                        document.getElementById("id_chk").value = "1";
                        idCheck = true;
                    } else if (data.result === "fail") {
                        alert("이미 사용중인 아이디 입니다. 다른 아이디를 입력해 주세요.");
                        document.getElementById("id_chk").value = "0";
                        idCheck = false;
                        business_member_id.value = "";
                        business_member_id.foucus();
                    } else if (data.result === "empty_id") {
                        alert("아이디가 비어있습니다.");
                        business_member_id.foucus();
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("연결 실패 파일이 존재하지 않습니다.");
            }
        }
    });

    btn_member_email_check.addEventListener("click", () => {
        if (business_member_email.value === '') {
            alert("이메일을 입력해 주세요");
            business_member_email.focus();
            return false;
        }

        if (email_domain.value == "manual_input") {

            if (manual_email_input.value == "") {
                alert("이메일 주소를 입력해 주세요");
                manual_email_input.focus();
                return false;
            };

            if (!isValidEmailDomain(manual_email_input.value)) {
                alert("잘못된 형식의 이메일 도메인입니다. 다시 입력해 주세요.");
                manual_email_input.value = "";
                manual_email_input.focus();
                return false;
            };
            
            emailToCheck = business_member_email.value + "@" + manual_email_input.value;
        } else {
            emailToCheck = business_member_email.value + "@" + email_domain.value;
        }
        console.log(emailToCheck);
        
        const f = new FormData();
        f.append("email", emailToCheck);
        f.append("mode", "email_chk");

        console.log(f.get("email"));
        console.log(f.get("mode"));


        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {

                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result == "success") {
                        alert("사용가능한 이메일 입니다.");
                        document.getElementById("email_chk").value = "1";
                        emailChecked = true;
                    } else if (data.result === "fail") {
                        alert("중복된 이메일 입니다.");
                        document.getElementById("email_chk").value = "0";
                        emailChecked = false;
                        business_member_email.value = "";
                        business_member_email.focus();
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        }
                        email_domain.value = "gmail.com";
                    } else if (data.result === "empty_email") {
                        alert("이메일이 비어있습니다.");
                        business_member_email.focus();
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        }
                        email_domain.value = "gmail.com";
                    } else if (data.result === "email_format_wrong") {
                        alert("이메일이 형식에 맞지 않습니다.");
                        business_member_email.value = "";
                        if (email_domain.value == "manual_input") {
                            manual_email_input.value = "";
                        }
                        email_domain.value = "gmail.com";
                        business_member_email.focus();
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("실패 존재하지 않는 파일입니다.");
            };
        };
    });

    btn_business_number_chk.addEventListener("click", () => {
        if (business_registration_number.value == "") {
            alert("사업자 등록번호를 입력해 주세요");
            business_registration_number.focus();
            return false;
        };

        const f = new FormData();
        f.append("b_number", business_registration_number.value);
        f.append("mode", "b_number_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result == "success") {
                        alert("사용가능한 사업자 등록번호 입니다.");
                        document.getElementById("business_number_chk").value = "1";
                        b_number_chk = true;
                    } else if (data.result == "fail") {
                        alert("중복된 사업자 번호입니다.");
                        document.getElementById("business_number_chk").value = "0";
                        b_number_chk = false;
                        business_registration_number.value = "";
                        business_registration_number.focus();
                    } else if (data.result == "empty_b_number") {
                        alert("사업자 번호가 비어있습니다.");
                        business_registration_number.focus();
                    };
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("전송 실패 존재하지 않는 파일입니다.");
            };
        };
    });

    input_submit.addEventListener("click", () => {
   
        // console.log(b_image);
        // alert("!");
        if (business_member_id.value == "") {
            alert("아이디를 입력해 주세요.");
            business_member_id.focus();
            return false;
        };

        if (!idCheck) {
            alert("아이디 중복확인을 해주세요");
            return false;
        };

        if (business_member_password == "") {
            alert("비밀번호를 입력해 주세요");
            business_member_password.focus();
            return false;
        };

        if (!validatePassword(business_member_password.value)) {
            alert("형식에 맞지않는 비밀번호입니다.");
            business_member_password.value = "";
            business_member_password.focus();
            business_member_password_chk.value();
            return false;
        };

        if (business_member_password_chk.value == "") {
            alert("비밀번호 확인을 입력해 주세요");
            business_member_password_chk.focus();
            return false;
        };

        if (business_member_password.value != business_member_password_chk.value) {
            alert("비밀번호가 일치하지 않습니다.");
            business_member_password.value = "";
            business_member_password_chk.value = "";
            business_member_password.focus();
            return false;
        };

        if (!emailChecked) {
            alert("이메일 중복확인을 해주세요");
            return false;
        };

        if (company_name.value == "") {
            alert("업체명을 입력해 주세요");
            company_name.focus();
            return false;
        };

        if (ceo_name.value == "") {
            alert("대표명을 입력해주세요.");
            ceo_name.focus();
            return false;
        };

        const b_mobile = business_member_mobile.value + "-" + business_member_mobile2.value + "-" + business_member_mobile3.value;
        const b_phone = business_member_phone.value + "-" + business_member_phone2.value + "-" + business_member_phone3.value;
        const b_fax = business_member_fax.value + "-" + business_member_fax2.value + "-" + business_member_fax3.value;

        // if (business_member_mobile.value == "" || business_member_mobile2.value == "" || business_member_mobile3.value == "") {
        //     alert("전화번호를 입력해 주세요");
        //     business_member_mobile.value = "";
        //     business_member_mobile2.value = "";
        //     business_member_mobile3.value = "";
        //     business_member_mobile.focus();
        //     return false;
        // };

        if (business_member_phone.value == "" || business_member_phone2.value == "" || business_member_phone3.value == "") {
            alert("휴대전화번호를 입력해주세요2");
            business_member_phone.value = "";
            business_member_phone2.value = "";
            business_member_phone3.value = "";
            business_member_phone.foucs();
            return false;
        };

        // if (business_member_fax.value == "" || business_member_fax2.value == "" || business_member_fax3.value == "") {
        //     alert("팩스번호를 입력해 주세요");
        //     business_member_fax.value = "";
        //     business_member_fax2.value = "";
        //     business_member_fax3.value = "";
        //     business_member_fax.focus();
        //     return false;
        // };

        const member_zipcode = document.getElementById("member_zipcode");
        const member_addr1 = document.getElementById("member_addr1");
        const member_addr2 = document.getElementById("member_addr2");

        if (member_zipcode.value == "") {
            alert("우편번호를 입력해 주세요");
            return false;
        };

        if (member_addr1.value == "") {
            alert("주소를 입력해주세요");
            return false;
        };

        if (member_addr2.value == "") {
            alert("상세주소를 입력해 주세요");
            return false;
        };

        if (business_registration_number.value == "") {
            alert("사업자 등록번호를 입력해 주세요");
            business_registration_number.focus();
            return false;
        };

        if (!b_number_chk) {
            alert("사업자번호 중복확인을 해주세요");
            return false;
        };

        if (business_type.value == "") {
            alert("업태를 입력해 주세요");
            business_type.focus();
            return false;
        };

        if (business_category.value == "") {
            alert("업종을 입력해 주세요");
            business_category.focus();
            return false;
        };

        // if (businessImageInput.files.length === 0) {
        //     alert("사업자 등록증을 첨부해 주세요");
        //     return false;
        // }

        const f = new FormData();
        f.append("id", business_member_id.value);
        f.append("password", business_member_password.value);
        f.append("b_name", company_name.value);
        f.append("ceo_name", ceo_name.value);
        f.append("email", emailToCheck);
        f.append("b_mobile", b_mobile);
        f.append("b_phone", b_phone);
        f.append("b_fax", b_fax);
        f.append("zipcode", member_zipcode.value);
        f.append("addr", member_addr1.value);
        f.append("detail_addr", member_addr2.value);
        f.append("b_number", business_registration_number.value);
        f.append("b_type", business_type.value);
        f.append("b_category", business_category.value);
        f.append("photo", b_image, b_image.name);
        f.append("mode", "input");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText
                try {
                    const data = JSON.parse(responseText);

                    if (data.result == "empty_id") {
                        alert("아이디가 비어있습니다.");
                        business_member_id.focus();
                        return false;
                    }

                    if (data.result == "empty_password") {
                        alert("비밀번호가 비어있습니다.");
                        business_member_password.focus();
                        return false;
                    }

                    if (data.result == "empty_bname") {
                        alert("회사명을 입력해 주세요");
                        company_name.focus();
                        return false;
                    }

                    if (data.result == "empty_ceo_name") {
                        alert("대표명을 입력해 주세요");
                        ceo_name.focus();
                        return false;
                    }

                    if (data.result == "empty_email") {
                        alert("이메일을 입력해 주세요");
                        business_member_email.focus();
                        return false;
                    }

                    // if (data.result == "empty_b_mobile") {
                    //     alert("전화번호를 입력해주세요");
                    //     business_member_mobile.focus();
                    //     return false;
                    // }

                    if (data.result == "empty_b_phone") {
                        alert("휴대전화번호를 입력해 주세요");
                        business_member_phone.focus();
                        return false;
                    }

                    // if (data.result == "empty_b_fax") {
                    //     alert("팩스 번호를 입력해 주세요");
                    //     business_member_fax.focus();
                    //     return false;
                    // }

                    if (data.result == "empty_zipcode") {
                        alert("우편번호를 입력해 주세요");
                        return false;
                    }

                    if (data.result == "empty_addr") {
                        alert("주소를 입력해 주세요");
                        return false;
                    }

                    if (data.result == "empty_detail_addr") {
                        alert("상세 주소를 입력해 주세요.");
                        member_addr2.focus();
                        return false;
                    }

                    if (data.result == "empty_b_number") {
                        alert("사업자 번호를 입력해 주세요");
                        business_registration_number.focus();
                        return false;
                    }

                    // if (data.result == "empty_b_type") {
                    //     alert("업태를 입력해 주세요.");
                    //     business_type.focus();
                    //     return false;
                    // }

                    // if (data.result == "empty_b_category") {
                    //     alert("업종을 입력해 주세요");
                    //     business_category.focus();
                    //     return false;
                    // }

                    if (data.result == "fail") {
                        alert("회원가입에 실패했습니다. 다시 한번 시도해 주세요");
                        self.location.reload();
                    }

                    if (data.result == "success") {
                        alert("가입 성공");
                        self.location.href = "./login.php";
                    }
                } catch (error) {
                    console.error("JSON parsing error : ", error);
                }
            } else if (xhr.status == 404) {
                alert("전송 실패 파일이 존재하지 않습니다.");
            };
        };
    });

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
})