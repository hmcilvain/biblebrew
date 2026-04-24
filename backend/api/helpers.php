<?php
// api/helpers.php
require_once 'config.php';

function cors()
{
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

    if (in_array($origin, ALLOWED_ORIGINS, true)) {
        header("Access-Control-Allow-Origin: $origin");
        header("Vary: Origin");
    }

    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }
}

function checkApiKey()
{
    $headers = getallheaders();
    if (($headers['X-API-KEY'] ?? '') !== API_KEY) {
        jsonResponse(["error" => "Unauthorized"], 401);
    }
}


function getJsonInput()
{
    $raw = file_get_contents("php://input");
    if (strlen($raw) > MAX_POST_SIZE) {
        http_response_code(413);
        exit;
    }
    return json_decode($raw, true) ?? [];
}

function getIP()
{
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

function now_iso()
{
    return date("c");
}

function get_uid()
{
    if (!empty($_COOKIE['bb_uid'])) return $_COOKIE['bb_uid'];
    return 'anon_' . substr(md5(getIP()), 0, 8);
}

function requirePost()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit;
    }
}

function ensure_dir($path)
{
    if (!is_dir($path)) mkdir($path, 0775, true);
}

function jsonResponse($data, $code = 200)
{
    header("Content-Type: application/json");
    http_response_code($code);
    echo json_encode($data);
    exit;
}

function sanitize($str)
{
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}