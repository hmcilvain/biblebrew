<?php
require_once '../api/helpers.php';
require_once '../api/dal.php';
require_once 'auth.php';

require_login();

header('Content-Type: application/json');

echo json_encode([
    'subscribers' => DAL::getSubscriberCount(),
    'downloads'   => DAL::getDownloadCounts(),
    'events'      => DAL::getRecentEvents(20)
]);
