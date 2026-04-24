<?php
session_start();
header('Content-Type: application/json');

// Generate a token if it doesn't exist
if (empty($_SESSION['download_token'])) {
    $_SESSION['download_token'] = bin2hex(random_bytes(32));
}

echo json_encode(['token' => $_SESSION['download_token']]);