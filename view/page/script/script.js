document.querySelectorAll("[data-overlay-open]").forEach(function (button) {
    const overlayId = button.dataset.overlayOpen;
    const overlay = document.getElementById(overlayId);

    if (!overlay) {
        throw new Error("Overlay tidak ditemukan: " + overlayId);
    }

    button.addEventListener("click", function () {
        overlay.classList.add("aktif");
    });
});

document.querySelectorAll("[data-overlay-close]").forEach(function (button) {
    const overlayId = button.dataset.overlayClose;
    const overlay = document.getElementById(overlayId);

    if (!overlay) {
        throw new Error("Overlay tidak ditemukan: " + overlayId);
    }

    button.addEventListener("click", function () {
        overlay.classList.remove("aktif");
    });
});