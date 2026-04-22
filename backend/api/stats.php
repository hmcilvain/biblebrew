<?php
require_once 'db.php';
require_once 'helpers.php';

$db = getDB();

$views = $db->query("SELECT COUNT(*) FROM page_views")->fetchColumn();
$downloads = $db->query("SELECT COUNT(*) FROM downloads")->fetchColumn();
$subs = $db->query("SELECT COUNT(*) FROM subscribers")->fetchColumn();

$topPages = $db->query("
    SELECT path, COUNT(*) as count
    FROM page_views
    GROUP BY path
    ORDER BY count DESC
    LIMIT 5
")->fetchAll();

jsonResponse([
    "views" => $views,
    "downloads" => $downloads,
    "subscribers" => $subs,
    "top_pages" => $topPages
]);
