<?php
require_once 'helpers.php';
require_once 'dal.php';

cors();
require_post();

$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit('Invalid email');
}

DAL::addSubscriber([
    'email' => $email,
    'uid'   => get_uid(),
    'ip'    => get_ip()
]);

header('Location: /subscribe/?success=1');
exit;
