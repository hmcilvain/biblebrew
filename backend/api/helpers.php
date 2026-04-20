<?php
// api/helpers.php
require_once 'config.php';

function cors()
{
    global $ALLOWED_ORIGINS;
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '';

    if (in_array($origin, $ALLOWED_ORIGINS, true)) {
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

function get_json_input()
{
    $raw = file_get_contents("php://input");
    if (strlen($raw) > MAX_POST_SIZE) {
        http_response_code(413);
        exit;
    }
    return json_decode($raw, true) ?? [];
}

function get_ip()
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
    return 'anon_' . substr(md5(get_ip()), 0, 8);
}

function require_post()
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
