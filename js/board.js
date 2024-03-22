document.addEventListener("DOMContentLoaded", () => {
    const detail_page = document.querySelectorAll(".detail_page");

    detail_page.forEach((box) => {
        const idx = box.dataset.idx;
        box.addEventListener("click", () => {
            self.location.href = "./board_check_password.php?idx=" + idx;
        });
    });

    const replies = document.querySelectorAll(".replies");
    replies.forEach((box) => {
        box.addEventListener("click", () => {
            const idx = box.dataset.idx;
            self.location.href = "./board_reply_view.php?qusetion_idx=" + idx;
        })
    })


    const btn_search = document.querySelector("#btn_search");

    btn_search.addEventListener("click", () => {
        const sf = document.querySelector("#sf");
        if (sf.value == "") {
            alert("검색어를 입력해 주세요.");
            sf.focus();
            return false;
        }

        const sn = document.querySelector("#sn");

        self.location.href = "./board.php?sn=" + sn.value + "&sf=" + sf.value;
    });

    const btn_all = document.querySelector("#btn_all");

    btn_all.addEventListener("click", () => {
        self.location.href = "./board.php";
    });

})