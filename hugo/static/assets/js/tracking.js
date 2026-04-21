function getCookie(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? match[2] : null;
}

function setCookie(name, value, days = 365) {
    const expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = `${name}=${value}; expires=${expires}; path=/`;
}

function initTracking() {
    let visitorId = getCookie("bb_id");

    if (!visitorId) {
        visitorId = crypto.randomUUID();
        setCookie("bb_id", visitorId);
    }

    fetch("/api/track.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            visitor_id: visitorId,
            path: window.location.pathname,
            referrer: document.referrer
        })
    });
}