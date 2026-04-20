<?php
session_start();

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'hm0698');

function require_login()
{
    if (empty($_SESSION['logged_in'])) {
        header('Location: /admin/login.php');
        exit;
    }
}
