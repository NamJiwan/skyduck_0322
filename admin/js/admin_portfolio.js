document.addEventListener("DOMContentLoaded", () => {
    const btn_input = document.querySelector("#btn_input");

    btn_input.addEventListener("click", () => {
        self.location.href = "./admin_portfolio_input.php";
    });

    const btn_search = document.querySelector("#btn_search");

    btn_search.addEventListener("click", () => {
        const sf = document.querySelector("#sf");
        if (sf.value == "") {
            alert("검색어를 입력해 주세요.");
            sf.focus();
            return false;
        }

        const sn = document.querySelector("#sn");

        self.location.href = "./admin_portfolio.php?sn=" + sn.value + "&sf=" + sf.value;
    });

    const btn_all = document.querySelector("#btn_all");

    btn_all.addEventListener("click", () => {
        self.location.href = "./admin_portfolio.php";
    });

    const btn_excel = document.querySelector("#btn_excel");

    btn_excel.addEventListener("click", () => {
        self.location.href = "./admin_portfolio_to_excel.php";
    });

    const btn_mem_deletes = document.querySelectorAll(".btn_mem_delete");

    btn_mem_deletes.forEach((box) => {
        box.addEventListener("click", () => {
            if (confirm("본 포트폴리오를 삭제하시겠습니까?")) {
                const idx = box.dataset.idx;

                const f = new FormData();
                f.append("idx", idx);

                const xhr = new XMLHttpRequest();

                xhr.open("POST", "./admin_portfolio_delete.php", true);
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
                            self.location.reload();
                        };
                    } else if (xhr.status == 404) {
                        alert("통신 실패");
                    }
                }
            };
        });
    });

    const btn_mem_edit = document.querySelectorAll(".btn_mem_edit");

    btn_mem_edit.forEach((box) => {
        box.addEventListener("click", () => {
            const idx = box.dataset.idx;

            self.location.href = "admin_portfolio_edit.php?idx=" + idx;
        });
    });
});