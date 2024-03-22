document.addEventListener("DOMContentLoaded", () => {
    const btn_write_edit = document.querySelector("#btn_write_edit");
    const btn_board_list = document.querySelector("#btn_board_list");

    btn_write_edit.addEventListener("click", () => {
        const idx = btn_write_edit.dataset.idx;
        self.location.href = "./admin_reply_edit.php?idx=" + idx;
    });

    btn_board_list.addEventListener("click", () => {
        const idx = btn_board_list.dataset.idx;
        self.location.href = "./admin_board_view.php?idx=" + idx;
    });

    const btn_delete = document.querySelector("#btn_delete");
    btn_delete.addEventListener("click", () => {
        if (confirm("이 답글을 삭제하시겠습니까?")) {
            const idx = btn_delete.dataset.idx;

            const f = new FormData();
            f.append("idx", idx);

            const xhr = new XMLHttpRequest();

            xhr.open("POST", "./admin_reply_delete.php", true);
            xhr.send(f);

            xhr.onload = () => {
                if (xhr.status == 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.result == 'access_denied') {
                        alert("권한 없음");
                        self.location.href = "./admin_login.php";
                    } 
                    
                    if (data.result == 'empty_idx') {
                        alert("번호가 존재하지 않습니다.");
                        return false;
                    }
                    
                    if (data.result == 'success') {
                        alert("삭제 성공");
                        self.location.href = './admin_board.php';
                    };
                } else if (xhr.status == 404) {
                    alert("통신 실패");
                }
            }
        };
    })
})