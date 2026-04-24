<?php
session_start();
require_once 'db.php';
require_once 'helpers.php';

cors();

// -- this is a get call to trigger the download

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, X-Download-Token");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    http_response_code(200);
    exit;
}

$clientToken = $_SERVER['HTTP_X_DOWNLOAD_TOKEN'] ?? '';

// Security Check
if (!$clientToken || $clientToken !== ($_SESSION['download_token'] ?? '')) {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Forbidden: Invalid Token", "detail_header"=>"clientToken:".$clientToken, "detail_session"=>$_SESSION['download_token']]);
    exit;
}


$data = getJsonInput();



$id = $data['file'] ?? null;

if (!$id) {
    jsonResponse(["error" => "Missing file"], 400);    
}

$visitor = sanitize($_COOKIE['bb_id'] ?? '');
$ip = getIP();


$db = getDB();

// -- log the download attempt (even if file is missing, we want to track it)
$stmt = $db->prepare("
    INSERT INTO downloads (file, visitor_id, ip_address)
    VALUES (?, ?, ?)
");

$stmt->execute([$id, $visitor, $ip]);



// 1. Lookup file in DB
$stmt = $db->prepare("SELECT file_path, title, mime_type FROM downloadables WHERE uuid = ?");
$stmt->execute([$id]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$file) {
    http_response_code(404);
    exit("File not found");
}

// 2. Resolve real path (IMPORTANT: outside web root ideally)
$path = '/home/www/10minutebiblebrew.com/assets/downloads/' . $file['file_path'] ;

if (!file_exists($path)) {
    http_response_code(404);
    exit("Missing file on disk.");
}

// 4. Stream
    header('Content-Description: File Transfer');
    header('Content-Type: ' . ($file['mime_type'] ?? 'application/octet-stream'));
    header('Content-Disposition: attachment; filename="' . basename($file['file_path']) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path));
    
    readfile($path);
    exit;