<?php
require_once 'auth.php';
require_login();
?>

<!doctype html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            margin: 0;
        }

        header {
            background: #111;
            color: #fff;
            padding: 1rem;
        }

        .container {
            padding: 2rem;
        }

        .card {
            background: white;
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <header>
        <h2>📊 Bible Brew Dashboard</h2>
        <a href="/admin/logout.php" style="color:white;">Logout</a>
    </header>

    <div class="container">

        <div class="card">
            <h3>Total Subscribers</h3>
            <div id="subs">Loading...</div>
        </div>

        <div class="card">
            <h3>Download Counts</h3>
            <ul id="downloads"></ul>
        </div>

        <div class="card">
            <h3>Recent Activity</h3>
            <ul id="events"></ul>
        </div>

    </div>

    <script src="/admin/assets/admin.js"></script>

</body>

</html>
