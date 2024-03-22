document.addEventListener("DOMContentLoaded", () => {
    const qna_name = document.querySelector("#qna_name");
    const qna_tel = document.querySelector("#qna_tel");
    const qna_email = document.querySelector("#qna_email");
    const qna_company_name = document.querySelector("#qna_company_name");
    const qna_garde = document.querySelector("#qna_grade");
    const qna_user_page = document.querySelector("#qna_user_page");
    const qna_budget = document.querySelector("#qna_budget");
    const qna_schedule = document.querySelector("#qna_schedule");
    const qna_content = document.querySelector("#qna_content");
    const qna_check = document.querySelector("#qna_check");
    const qna_submit = document.querySelector("#qna_submit");

    qna_submit.addEventListener("click", () => {
        if (qna_name.value == "") {
            alert("이름을 입력해주세요");
            qna_name.focus();
            return false;
        };

        if (qna_tel.value == "") {
            alert("연락처를 입력해 주세요");
            qna_tel.focus();
            return false;
        };

        if (qna_email.value == "") {
            alert("이메일을 입력해 주세요");
            qna_email.focus();
            return false;
        };

        if (qna_company_name.value == "") {
            alert("회사명을 입력해주세요");
            qna_company_name.focus();
            return false;
        };

        // if (qna_garde.value == "") {
        //     alert("직급을 입력해 주세요");
        //     qna_garde.focus();
        //     return false;
        // };

        // if (qna_user_page.value == "") {
        //     alert("홈페이지를 입력해 주세요");
        //     qna_user_page.focus();
        //     return false;
        // };

        const c_boxes = document.querySelectorAll("input[type='checkbox']");
        let checked = false;
        
        c_boxes.forEach(function(box) {
            if (box.checked) {
                checked = true;
            }
        });

        if (!checked) {
            alert("적어도 하나이상의 옵션을 선택해 주세요");
            return false;
        };

        if (qna_budget.value == "") {
            alert("예산을 입력해 주세요");
            qna_budget.focus();
            return false;
        };

        if (qna_schedule.value == "") {
            alert("일정을 입력해 주세요");
            qna_schedule.focus();
            return false;
        };

        if (qna_check.checked != true) {
            alert("개인정보 처리방침에 동의해주셔야 문의가 가능합니다.")
            return false;
        };

        const f = new FormData();
        f.append("name", qna_name.value);
        f.append("tel", qna_tel.value);
        f.append("email", qna_email.value);
        f.append("c_name", qna_company_name.value);
        f.append("grade", qna_garde.value);
        f.append("user_page", qna_user_page.value);
        const cBoxes = document.querySelectorAll("input[type='checkbox']:checked");
        let values = [];
        cBoxes.forEach(function(cBox) {
            values.push(cBox.value);
        });
        let joinedValues = values.join(','); // 배열을 쉼표로 구분된 문자열로 변환
        f.append("services", joinedValues);
        f.append("budget", qna_budget.value);
        f.append("schedule", qna_schedule.value);
        if (qna_content.value == "") {
            f.append("content", "특별한 요청 사항이 없습니다.");
        } else {
            f.append("content", qna_content.value);
        };

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "./pg/qna_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const responseText = xhr.responseText;
                try {
                    const data = JSON.parse(responseText);
                    if (data.result === 'empty_name') {
                        alert("이름이 비어있습니다. 다시 입력해 주세요");
                        qna_name.focus();
                        return false;
                    };

                    if (data.result === 'empty_tel') {
                        alert("연락처가 비어있습니다. 다시 입력해 주세요.");
                        qna_tel.focus();
                        return false;
                    };

                    if (data.result === 'empty_eamil') {
                        alert("이메일이 비어있습니다. 다시 입력해 주세요.");
                        qna_email.focus();
                        return false;
                    };

                    if (data.result === 'empty_cname') {
                        alert("회사명이 비어있습니다. 다시 입력해 주세요.");
                        qna_company_name.focus();
                        return false;
                    };

                    // if (data.result === 'empty_grade') {
                    //     alert("직급이 비어있습니다. 다시 입력해 주세요.");
                    //     qna_garde.focus();
                    //     return false;
                    // };

                    // if (data.result === 'empty_userpage') {
                    //     alert("사이트가 비어있습니다. 예시 사이트라도 넣어주세요");
                    //     qna_user_page.focus();
                    //     return false;
                    // };

                    if (data.result === 'empty_budget') {
                        alert("예산이 비어있습니다. 다시 입력해 주세요.");
                        qna_budget.focus();
                        return false;
                    };

                    if (data.result === 'empty_schedule') {
                        alert("일정이 비어있습니다. 다시 입력해 주세요");
                        qna_schedule.focus();
                        return false;
                    };

                    if (data.result === 'empty_services') {
                        alert("서비스를 선택해 주세요");
                        return false;
                    }

                    if (data.result === 'success') {
                        alert("견적문의 요청이 접수 되었습니다.");
                        self.location.reload();
                    };

                    if (data.result === 'fail') {
                        alert('견적 문의에 실패했습니다. 다시 입력해 주세요.');
                        return false;
                    };
                } catch (error) {
                    console.error("JSON parsing error:", error);
                }
            } else if (xhr.status == 404) {
                alert("연결 실패 존재하지 않는 파일입니다.");
            }
        }
    });
});