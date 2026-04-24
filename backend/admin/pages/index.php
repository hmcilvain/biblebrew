<?php
require_once '../../api/bootstrap.php';

$db = getDB();

// --- KPI Queries ---
$pageViews7 = $db->query("SELECT COUNT(*) FROM page_views WHERE created_at >= NOW() - INTERVAL 7 DAY")->fetchColumn();
$downloads7 = $db->query("SELECT COUNT(*) FROM downloads WHERE created_at >= NOW() - INTERVAL 7 DAY")->fetchColumn();
$subs7 = $db->query("SELECT COUNT(*) FROM subscribers WHERE created_at >= NOW() - INTERVAL 7 DAY")->fetchColumn();

$topPages = $db->query("SELECT path, COUNT(*) as views FROM page_views GROUP BY path ORDER BY views DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

$topDownloads = $db->query("SELECT d.title, COUNT(dl.id) AS downloads
FROM downloads dl
JOIN downloadables d ON dl.file = d.uuid
GROUP BY dl.file
ORDER BY downloads DESC
LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once '_header.php'; ?>

<h1>📊 BibleBrew Admin Dashboard</h1>

<div class="grid" style="--grid-cols: 3;">
    <div class="card">
        <h2><?php echo $pageViews7; ?></h2>
        <p>Page Views (7 days)</p>
    </div>

    <div class="card">
        <h2><?php echo $downloads7; ?></h2>
        <p>Downloads (7 days)</p>
    </div>

    <div class="card">
        <h2><?php echo $subs7; ?></h2>
        <p>New Subscribers (7 days)</p>
    </div>
</div>

<br><br>

<div class="grid">
    <div class="card">
        <h3>Top Pages</h3>
        <table class="admin-table">
            <tr>
                <th>Path</th>
                <th>Views</th>
            </tr>
            <?php foreach ($topPages as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['path']); ?></td>
                    <td><?php echo $row['views']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h3>Top Downloads</h3>
        <table class="admin-table">
            <tr>
                <th>Title</th>
                <th>Downloads</th>
            </tr>
            <?php foreach ($topDownloads as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo $row['downloads']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php require_once '_footer.php'; ?>