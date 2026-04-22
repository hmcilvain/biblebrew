<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    if ($user === 'admin' && $pass === 'hm0698') {
        $_SESSION['admin'] = true;
        header("Location: /admin/");
        exit;
    }

    $error = "Invalid login";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body class="container-reading section">
    <h2>Admin Login</h2>

    <?php if (!empty($error)) echo "<p>$error</p>"; ?>

    <form method="POST">
        <input name="username" placeholder="Username"><br><br>
        <input name="password" type="password" placeholder="Password"><br><br>
        <button class="btn">Login</button>
    </form>
</body>

</html>
