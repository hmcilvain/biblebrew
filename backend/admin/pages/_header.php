<?php
// NOTE: Do NOT include config/db here unless needed per page.
// Keep header purely presentational.
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BibleBrew Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Cormorant:ital,wght@0,300..700;1,300..700&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Datatype:wght@100..900&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Gelasio:ital,wght@0,400..700;1,400..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&family=Libre+Franklin:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
</head>

<body>

    <div class="admin-shell">

        <aside class="admin-sidebar">
            <h2>BibleBrew</h2>

            <a href="/admin/pages/index.php">Dashboard</a>
            <a href="/admin/pages/episodes.php">Episodes</a>
            <a href="/admin/pages/downloadables.php">Downloadables</a>
            <a href="/admin/pages/subscribers.php">Subscribers</a>
        </aside>

        <main class="admin-main container">