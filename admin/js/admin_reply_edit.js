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
    const btn_cancel = document.querySelector("#btn_cancel");
    btn_cancel.addEventListener("click", () => {
        history.go(-1);
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

        const params = getUrlParams();

        const f = new FormData();
        f.append("subject", id_subject.value); // 게시물 제목
        f.append("content", markupStr); // 게시물 내용
        f.append("target_idx", params["idx"]);
        f.append("mode", "reply_edit"); // 모드 : 글 등록

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
                    alert("답글이 수정되었습니다.");
                    self.location.href = './admin_reply_view.php?idx=' + params['idx'];
                };
            } else if (xhr.status == 404) {
                alert("접근실패, 존재하지 않는 파일입니다.");
                self.location.reload();
                return false;
            };
        };
    });
});