<?php
require_once '../../api/bootstrap.php';

$db = getDB();

// --- Helpers ---
function uuidv4()
{
    $data = random_bytes(16);
    $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
    $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$uploadDir = __DIR__ . '/../storage/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// --- Handle Create ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $uuid = uuidv4();
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';

    if (!empty($_FILES['file']['name'])) {
        $fileName = uniqid() . '_' . basename($_FILES['file']['name']);
        $targetPath = $uploadDir . $fileName;

        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $stmt = $db->prepare("INSERT INTO downloadables (uuid, title, description, file_path, file_name, mime_type, file_size, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $uuid,
            $title,
            $description,
            $fileName,
            $_FILES['file']['name'],
            $_FILES['file']['type'],
            $_FILES['file']['size'],
            $category
        ]);
    }

    header('Location: downloadables.php');
    exit;
}

// --- Handle Delete ---
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $stmt = $db->prepare("SELECT file_path FROM downloadables WHERE id = ?");
    $stmt->execute([$id]);
    $file = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($file) {
        $path = $uploadDir . $file['file_path'];
        if (file_exists($path)) unlink($path);

        $db->prepare("DELETE FROM downloadables WHERE id = ?")->execute([$id]);
    }

    header('Location: downloadables.php');
    exit;
}

// --- Toggle Active ---
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $db->query("UPDATE downloadables SET is_active = NOT is_active WHERE id = $id");
    header('Location: downloadables.php');
    exit;
}

// --- Fetch All ---
$rows = $db->query("SELECT * FROM downloadables ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once '_header.php'; ?>

<h1>📁 Downloadables Admin</h1>

<div class="card">
    <h2>Add New</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="text" name="category" placeholder="Category">
        <input type="file" name="file" required>
        <button type="submit" name="create">Upload</button>
    </form>
</div>

<div class="card">
    <h2>All Files</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?php echo htmlspecialchars($r['title']); ?></td>
                <td><?php echo htmlspecialchars($r['category']); ?></td>
                <td><?php echo $r['is_active'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <a href="?toggle=<?php echo $r['id']; ?>">Toggle</a>
                    <a href="?delete=<?php echo $r['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once '_footer.php'; ?>