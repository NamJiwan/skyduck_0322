document.addEventListener("DOMContentLoaded", () => {
    const qna_submit = document.querySelector("#qna_submit");
    qna_submit.addEventListener("click", () => {
        history.go(-1);
    });
})