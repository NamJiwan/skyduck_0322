document.addEventListener("DOMContentLoaded", () => {
    const btn_board_list = document.querySelector("#btn_board_list");

    btn_board_list.addEventListener("click", () => {
        self.location.href = "./board.php";
    });

    const btn_board_view = document.querySelector("#btn_board_view");
    const idx = btn_board_view.dataset.idx;
    btn_board_view.addEventListener("click", () => {
        self.location.href = "./board_check_password.php?idx=" + idx;
    })
})