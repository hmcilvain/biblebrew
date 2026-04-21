<?php
require_once 'db.php';
require_once 'helpers.php';

cors();
requirePost();

$data = getJsonInput();

$visitor = sanitize($data['visitor_id'] ?? '');
$path = sanitize($data['path'] ?? '');
$ref = sanitize($data['referrer'] ?? '');
$ip = getIP();

if (!$visitor || !$path) {
    jsonResponse(["error" => "Missing data"], 400);
}

$db = getDB();

$stmt = $db->prepare("
    INSERT INTO page_views (visitor_id, path, referrer, ip_address)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([$visitor, $path, $ref, $ip]);

jsonResponse(["status" => "ok"]);
