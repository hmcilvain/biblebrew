<?php
require_once 'db.php';
require_once 'helpers.php';

cors();
requirePost();

$email = sanitize($_POST['email'] ?? '');
$ip = getIP();

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    jsonResponse(["error" => "Invalid email"], 400);
}

$db = getDB();

try {
    $stmt = $db->prepare("
        INSERT INTO subscribers (email, ip_address)
        VALUES (?, ?)
    ");
    $stmt->execute([$email, $ip]);

    jsonResponse(["status" => "subscribed"]);
} catch (PDOException $e) {
    jsonResponse(["error" => "Already subscribed"], 409);
}
