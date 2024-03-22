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

    let emailChecked = false;
    const business_member_id = document.querySelector("#business_member_id");
    const business_member_password = document.querySelector("#business_member_password");
    const business_member_password_chk = document.querySelector("#business_member_password_chk");
    const company_name = document.querySelector("#company_name");
    const old_b_name = document.querySelector("#old_b_name");
    const ceo_name = document.querySelector("#ceo_name");
    const old_email = document.querySelector("#old_email");
    const business_member_email = document.querySelector("#business_member_email");
    const email_domain = document.querySelector("#email_domain");
    const manual_email_input = document.querySelector("#manual_email_input");
    const btn_member_email_check = document.querySelector("#btn_member_email_check");
    const old_bnum = document.querySelector("#old_bnum");
    const business_registration_number = document.querySelector("#business_registration_number");
    const business_number_chk = document.querySelector("#business_number_chk");
    let b_number_chk = false;
    const btn_business_number_chk = document.querySelector("#btn_business_number_chk");
    const old_photo = document.querySelector("#old_photo");
    const input_submit = document.querySelector("#input_submit");

    const btn_zipcode = document.querySelector("#btn_zipicode");
    let new_email = '';

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

    email_domain.addEventListener("change", () => {
        manual_email_input.value = "";
    });

    if (email_domain.value === "manual_input") {
        new_email = business_member_email.value + "@" + manual_email_input.value;
    } else {
        new_email = business_member_email.value + "@" + email_domain.value;
    };

    btn_member_email_check.addEventListener("click", () => {
        if (email_domain.value === "manual_input") {
            new_email = business_member_email.value + "@" + manual_email_input.value;
        } else {
            new_email = business_member_email.value + "@" + email_domain.value;
        };

        if (old_email.value == new_email) {
            alert("이메일 중복확인이 필요없습니다. 새로운 이메일로 변경시 이메일 중복확인을 해주세요.");
            return false;
        };

        if (business_member_email.value == "") {
            alert("이메일을 입력해 주세요.");
            business_member_email.focus();
            return false;
        };

        if (email_domain.value == "manual_input") {
            if (manual_email_input.value == "") {
                alert("직접입력을 선택하셨습니다. 이메일 도메인을 입력해 주세요");
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
        if (old_bnum.value == business_registration_number.value) {
            alert("동일한 사업자 번호입니다. 사업자 번호 변경시 입력해 주세요.");
            return false;
        };

        if (isNaN(business_registration_number.value)) {
            alert("잘못된 사업자 번호입니다. 다시 입력해주세요");
            business_registration_number.value = "";
            business_registration_number.focus();
            return false;
        };

        const f = new FormData();
        f.append("b_number", business_registration_number.value);
        f.append("mode", "b_number_chk");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./../pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result == "success") {
                        alert("사용가능한 사업자 등록번호 입니다.");
                        business_number_chk.value = "1";
                        b_number_chk = true;
                    } else if (data.result == "fail") {
                        alert("중복된 사업자 번호입니다.");
                        business_number_chk.value = "0";
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
        if (business_member_id.value == "") {
            alert("아이디가 비어있습니다. 다시 입력해주세요.")
        };

        if (business_member_password.value != '') {
            if (business_member_password.value != business_member_password_chk.value) {
                alert("비밀번호가 서로 일치하지 않습니다. 다시 입력해 주세요.");
                business_member_password.value = '';
                business_member_password_chk.value = '';
                business_member_password.focus();
                return false;
            };

            if (business_member_password_chk.value != '' && !validatePassword(business_member_password.value)) {
                alert("잘못된 형식의 비밀번호입니다. 다시 입력해주세요");
                business_member_password.value = '';
                business_member_password_chk.value = '';
                business_member_password.focus();
                return false;
            };
        };

        if (company_name.value == "") {
            alert("회사명이 비어있습니다. 다시 입력해주세요.");
            company_name.focus();
            return false;
        };

        if (ceo_name.value == "") {
            alert("대표명이 비어있습니다. 다시입력해주세요");
            ceo_name.focus();
            return false;
        };
        
        if (business_member_email.value == "") {
            alert("이메일을 입력해 주세요");
            business_member_email.focus();
            return false;
        };

        if (email_domain.value == "manual_input") {
            if (manual_email_input.value == "") {
                alert("직접입력을 선택하셨습니다. 도메인을 입력해주세요");
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

                   // Get mobile number values
    const MOBILE_PART_1 = document.getElementById('business_member_mobile');
    const MOBILE_PART_2 = document.getElementById('business_member_mobile2');
    const MOBILE_PART_3 = document.getElementById('business_member_mobile3');

    // Get phone number values
    const PHONE_PART_1 = document.getElementById('business_member_phone');
    const PHONE_PART_2 = document.getElementById('business_member_phone2');
    const PHONE_PART_3 = document.getElementById('business_member_phone3');

    // Get fax number values
    const FAX_PART_1 = document.getElementById('business_member_fax');
    const FAX_PART_2 = document.getElementById('business_member_fax2');
    const FAX_PART_3 = document.getElementById('business_member_fax3');
   
        if (MOBILE_PART_1.value == "" || MOBILE_PART_2.value == "" || MOBILE_PART_3.value == "") {
            alert("연락처가 비어있습니다. 다시 입력해주세요.");
            MOBILE_PART_1.value = "";
            MOBILE_PART_2.value = "";
            MOBILE_PART_3.vlaue = "";
            MOBILE_PART_1.focus();
            return false;
        };

        const b_mobile = MOBILE_PART_1.value + "-" + MOBILE_PART_2.value + "-" + MOBILE_PART_3.value;
        console.log(b_mobile)


        if (PHONE_PART_1.value == "" || PHONE_PART_2.value == "" || PHONE_PART_3.value == "") {
            alert("연락처가 비어있습니다. 다시 입력해주세요.");
            PHONE_PART_1.value = "";
            PHONE_PART_2.value = "";
            PHONE_PART_3.value = "";
            PHONE_PART_1.focus();
            return false;
        };

        const b_phone = PHONE_PART_1.value + "-" + PHONE_PART_2.value + "-" + PHONE_PART_3.value;



        if (FAX_PART_1.value == "" || FAX_PART_2.value == "" || FAX_PART_3.value == "") {
            alert("연락처가 비어있습니다. 다시 입력해주세요.");
            FAX_PART_1.value = "";
            FAX_PART_2.value = "";
            FAX_PART_3.value = "";
            FAX_PART_1.focus();
            return false;
        };

        const b_fax = FAX_PART_1.value + "-" + FAX_PART_2.value + "-" + FAX_PART_3.value;
        const member_zipcode = document.querySelector("#member_zipcode");
        const member_addr1 = document.querySelector("#member_addr1");
        const member_addr2 = document.querySelector("#member_addr2");

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

        if (business_registration_number.vlaue == "") {
            alert("사업자 등록번호가 비어있습니다. 다시 입력해주세요");
            business_registration_number.focus();
            return false;
        };

        if (business_registration_number.value != '' && old_bnum.value != business_registration_number.value) {
            if (business_number_chk.value == "0" && !b_number_chk) {
                alert("사업자등록번호 중복조회를 해주세요");
                return false;
            };

            if (business_image.value == "") {
                alert("사업자 등록증을 첨부해주세요");
                return false;
            };
        };



        const f = new FormData();
        f.append("id", business_member_id.value);
        f.append("password", business_member_password.value);
        f.append("b_name", company_name.value);
        f.append("old_b_name", old_b_name.value)
        f.append("ceo_name", ceo_name.value);
        f.append("email", new_email);
        f.append("b_mobile", b_mobile);
        f.append("b_phone", b_phone);
        f.append("b_fax", b_fax);
        f.append("zipcode", member_zipcode.value);
        f.append("addr", member_addr1.value);
        f.append("detail_addr", member_addr2.value);
        f.append("b_number", business_registration_number.value);
        f.append("b_type", business_type.value);
        f.append("b_category", business_category.value);
        f.append("photo", b_image);
        f.append("old_photo", old_photo.value);
        f.append("mode", "business_edit");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/business_member_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
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

                    if (data.result == "empty_b_mobile") {
                        alert("전화번호를 입력해주세요");
                        business_member_mobile.focus();
                        return false;
                    }

                    if (data.result == "empty_b_phone") {
                        alert("연락처를 입력해 주세요");
                        business_member_phone.focus();
                        return false;
                    }

                    if (data.result == "empty_b_fax") {
                        alert("팩스 번호를 입력해 주세요");
                        business_member_fax.focus();
                        return false;
                    }

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

                    if (data.result == "empty_b_type") {
                        alert("업태를 입력해 주세요.");
                        business_type.focus();
                        return false;
                    }

                    if (data.result == "empty_b_category") {
                        alert("업종을 입력해 주세요");
                        business_category.focus();
                        return false;
                    }

                    if (data.result == 'success') {
                        alert("수정되었습니다.");
                        self.location.href = "./index.php";
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