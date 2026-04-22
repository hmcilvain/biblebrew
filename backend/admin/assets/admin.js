async function loadStats() {
    const res = await fetch("/api/stats.php");
    const data = await res.json();

    document.getElementById("views").textContent = data.views;
    document.getElementById("downloads").textContent = data.downloads;
    document.getElementById("subs").textContent = data.subscribers;

    const pages = document.getElementById("top-pages");
    pages.innerHTML = "";

    data.top_pages.forEach(p => {
        const li = document.createElement("li");
        li.textContent = `${p.path} (${p.count})`;
        pages.appendChild(li);
    });
}

async function loadSubscribers() {
    const res = await fetch("/api/subscribers_list.php");
    const data = await res.json();

    const list = document.getElementById("subscriber-list");
    list.innerHTML = "";

    data.forEach(s => {
        const li = document.createElement("li");
        li.textContent = s.email;
        list.appendChild(li);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    loadStats();
    loadSubscribers();
});