document.addEventListener("DOMContentLoaded", () => {
    const idx = document.querySelector("#target_idx").value;


    const btn_board_list = document.querySelector("#btn_board_list");

    btn_board_list.addEventListener("click", () => {
        self.location.href = "./admin_board.php";
    });

    const btn_write_submit = document.querySelector("#btn_write_submit");
    btn_write_submit.addEventListener("click", () => {
        const id_subject = document.querySelector("#id_subject");
        if (id_subject.value == "") {
            alert("제목을 입력해 주세요.");
            id_subject.focus();
            return false;
        };

        const markupStr = $("#summernote").summernote("code");
        if (markupStr == "<p><br></p>") {
            alert("내용을 입력해 주세요.");
            return false;
        };

        const f = new FormData();
        f.append("subject", id_subject.value);
        f.append("content", markupStr);
        f.append("target_idx", idx);
        f.append("mode", "reply_input");

        const xhr = new XMLHttpRequest();
        
        xhr.open("POST", "./pg/admin_reply_process.php", true);
        xhr.send(f);

        xhr.onload = () => {
            if (xhr.status == 200) {
                const data = JSON.parse(xhr.responseText);

                if (data.result == 'empty_mode') {
                    alert("잘못된 접근");
                    self.location.reload();
                };

                if (data.result == 'empty_title') {
                    alert('제목이 비어있습니다. 다시 입력해주세요.');
                    id_subject.focus();
                    return false;
                };

                if (data.result == 'empty_content') {
                    alert('내용이 비어있습니다. 다시 입력해주세요.');
                    markupStr.focus();
                    return false;
                };

                if (data.result == 'empty_target_idx') {
                    alert('본문 번호가 비어있습니다. 다시 입력해주세요');
                    self.location.href = './admin_board.php';
                };

                if (data.result == 'success') {
                    alert("답글이 등록되었습니다.");
                    self.location.href = './admin_board.php';
                };
            } else if (xhr.status == 404) {
                alert("접근실패, 존재하지 않는 파일입니다.");
                self.location.reload();
                return false;
            };
        };
    });
})