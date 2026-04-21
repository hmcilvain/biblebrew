function initSubscribeForm() {
    const form = document.querySelector(".subscribe-form");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        const res = await fetch("/api/subscribe.php", {
            method: "POST",
            body: formData
        });

        if (res.ok) {
            form.innerHTML = "<p>✅ You're subscribed!</p>";
        } else {
            alert("Something went wrong. Try again.");
        }
    });
}