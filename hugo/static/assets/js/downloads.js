function initDownloadTracking() {
    document.querySelectorAll("[data-download]").forEach(link => {
        link.addEventListener("click", () => {
            fetch("/api/download.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    file: link.getAttribute("data-download"),
                    path: window.location.pathname
                })
            });
        });
    });
}
