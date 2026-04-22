<?php
require_once 'db.php';
require_once 'helpers.php';

$db = getDB();

$data = $db->query("
    SELECT email, created_at
    FROM subscribers
    ORDER BY created_at DESC
    LIMIT 100
")->fetchAll();

jsonResponse($data);
