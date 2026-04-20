(function () {
  let uid = localStorage.getItem("bb_uid");

  if (!uid) {
    uid = crypto.randomUUID();
    localStorage.setItem("bb_uid", uid);
  }

  fetch("/api/log.php", {
    method: "POST",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({
      uid,
      path: window.location.pathname,
      referrer: document.referrer
    })
  });
})();
