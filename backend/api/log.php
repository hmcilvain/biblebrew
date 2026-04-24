<?php
require_once 'helpers.php';
require_once 'dal.php';

cors();
requirePost();

$data = getJsonInput();

DAL::logEvent([
    'type' => 'page_view',
    'uid'  => $data['uid'] ?? get_uid(),
    'path' => $data['path'] ?? '',
    'ref'  => $data['referrer'] ?? '',
    'ip'   => getIP()
]);

header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
