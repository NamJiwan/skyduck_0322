document.addEventListener("DOMContentLoaded", () => {
    const view_all = document.querySelector("#view_all");
    view_all.addEventListener("click", () => {
        self.location.href = "./admin_board.php";
    });


    if (document.querySelector("#reply_view")) {
        const reply_view = document.querySelector("#reply_view");
        reply_view.addEventListener("click", () => {
            const idx = reply_view.dataset.idx;
            self.location.href = "admin_reply_view.php?idx=" + idx;
        });
    };


    if (document.querySelector("#reply")) {
        const reply = document.querySelector("#reply");
        reply.addEventListener("click", () => {
            const idx = reply.dataset.idx;
            self.location.href = "admin_reply_write.php?idx=" + idx;
        });
    };

});