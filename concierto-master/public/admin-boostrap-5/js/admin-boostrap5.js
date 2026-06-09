window.addEventListener("load", (function() {
    const t = document.getElementById("loader");
    setTimeout((function() {
        t.classList.add("fadeOut")
    }), 300)
}))