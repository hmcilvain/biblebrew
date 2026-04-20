<?php
// api/config.php

define('DB_HOST', 'localhost');
define('DB_NAME', 'hmcilvain_biblebrew');
define('DB_USER', 'hmcilvain_biblebrew');
define('DB_PASS', '220TEOczd!');

// downloads map

define('DATA_PATH', __DIR__ . '/../data/');
define('LOG_PATH', __DIR__ . '/../logs/');
define('DOWNLOAD_PATH', __DIR__ . '/../downloads/');

// Allowed files map (never trust user input directly)
$DOWNLOAD_FILES = [
    'study-guide-1' => 'study-guide-1.pdf',
    'episode-1' => 'episode-1.pdf'
];

// Security
define('MAX_POST_SIZE', 1024 * 10); // 10KB
define('ALLOWED_ORIGIN', 'https://10minutebiblebrew.com'); // change for local dev if needed
