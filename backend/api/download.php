<?php
require_once 'helpers.php';
require_once 'dal.php';

global $DOWNLOAD_FILES;

$key = $_GET['file'] ?? '';

if (!isset($DOWNLOAD_FILES[$key])) {
    http_response_code(404);
    exit;
}

$file = DOWNLOAD_PATH . $DOWNLOAD_FILES[$key];

if (!file_exists($file)) {
    http_response_code(404);
    exit;
}

DAL::logDownload([
    'file' => $key,
    'uid'  => get_uid(),
    'ip'   => get_ip()
]);

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
readfile($file);
exit;
