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
    const go_all = document.querySelector("#go_all");

    go_all.addEventListener("click", () => {
        self.location.href = "./board.php";
    });

    const view_reply = document.querySelector("#view_reply");
    const params = getUrlParams();

    view_reply.addEventListener("click", () => {
        self.location.href = "./board_reply_view.php?qusetion_idx=" + params['idx'];
    });
})