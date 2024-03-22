document.addEventListener("DOMContentLoaded", () => {
    const btn_mem_edit = document.querySelectorAll(".btn_mem_edit");
    btn_mem_edit.forEach((box) => {
        box.addEventListener("click", () => {
            const idx = box.dataset.idx;
            self.location.href = "./qna_view.php?idx=" + idx;
        });
    })
})