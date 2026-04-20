<?php
require_once 'auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        $_POST['username'] === ADMIN_USER &&
        $_POST['password'] === ADMIN_PASS
    ) {
        $_SESSION['logged_in'] = true;
        header('Location: /admin/');
        exit;
    } else {
        $error = "Invalid login";
    }
}
?>

<!doctype html>
<html>

<head>
    <title>Admin Login</title>
</head>

<body>

    <h2>Login</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input name="username" placeholder="Username">
        <input name="password" type="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>

</body>

</html>
