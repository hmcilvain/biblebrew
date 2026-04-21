<?php
require_once 'db.php';
require_once 'helpers.php';

cors();
requirePost();

$data = getJsonInput();

$file = sanitize($data['file'] ?? '');
$visitor = sanitize($data['visitor_id'] ?? '');
$ip = getIP();

if (!$file) {
    jsonResponse(["error" => "Missing file"], 400);
}

$db = getDB();

$stmt = $db->prepare("
    INSERT INTO downloads (file, visitor_id, ip_address)
    VALUES (?, ?, ?)
");

$stmt->execute([$file, $visitor, $ip]);

jsonResponse(["status" => "logged"]);
