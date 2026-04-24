async function getToken() {
    try {
        const response = await fetch('/api/get_token.php');
        const data = await response.json();
        apiToken = data.token;
    } catch (err) { console.error("Token error:", err); }
}

function initDownloadTracking() {  
    const links = document.querySelectorAll(".download-link:not(.tracked)");
    links.forEach(link => {
        link.classList.add('tracked'); // Mark it so we don't attach twice
        link.addEventListener("click", async (e) => {
            // 1. STOP the browser from following the link immediately
            e.preventDefault();
            
            const downloadUrl = link.href;
            const fileName = link.getAttribute("data-download");
            const downloadName = link.getAttribute("data-filename");

            if (!apiToken) await getToken();

            // 2. Perform the fetch
            try {
                // We use 'await' to make sure the server logs it 
                // BEFORE we let the user move on.
                const response = await fetch("/api/download.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Download-Token": apiToken
                    },
                    body: JSON.stringify({
                        file: fileName,
                        path: window.location.pathname
                    })
                });
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                	a.href = url;
                	a.download = downloadName;
                	a.click();
                
            } catch (err) {
                console.error("Tracking failed, but continuing download...", err);
            }

            // 3. NOW tell the browser to download the file
            //window.location.href = downloadUrl;
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    getToken();
    initDownloadTracking();
});