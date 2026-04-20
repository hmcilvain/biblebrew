async function loadDashboard() {
  const res = await fetch('/admin/api.php');
  const data = await res.json();

  // Subscribers
  document.getElementById('subs').innerText = data.subscribers;

  // Downloads
  const dlList = document.getElementById('downloads');
  dlList.innerHTML = '';
  data.downloads.forEach(d => {
    const li = document.createElement('li');
    li.textContent = `${d.file_key}: ${d.total}`;
    dlList.appendChild(li);
  });

  // Events
  const evList = document.getElementById('events');
  evList.innerHTML = '';
  data.events.forEach(e => {
    const li = document.createElement('li');
    li.textContent = `${e.type} | ${e.path} | ${e.created_at}`;
    evList.appendChild(li);
  });
}

loadDashboard();
