<?php
require_once 'helpers.php';
require_once 'dal.php';

cors();
require_post();

$data = get_json_input();

DAL::logEvent([
    'type' => 'page_view',
    'uid'  => $data['uid'] ?? get_uid(),
    'path' => $data['path'] ?? '',
    'ref'  => $data['referrer'] ?? '',
    'ip'   => get_ip()
]);

header('Content-Type: application/json');
echo json_encode(['status' => 'ok']);
