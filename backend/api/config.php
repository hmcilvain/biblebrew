<?php
// api/config.php


//------------------ DB credentials ------------------//
define('DB_HOST', 'localhost');
define('DB_NAME', 'hmcilvain_biblebrew');
define('DB_USER', 'hmcilvain_biblebrew');
define('DB_PASS', '220TEOczd!');

//------------------ Security ------------------//
define('API_KEY', 'change_this_secret_key');

//------------------ CORS (adjust later if needed) ------------------//
define('MAX_POST_SIZE', 1024 * 10); // 10KB
define('ALLOWED_ORIGIN', '*');
define('ALLOWED_ORIGINS', [
    'https://10minutebiblebrew.com',
    'https://www.10minutebiblebrew.com',
    'http://localhost:1313'
]);

// change for local dev if needed
// define('ALLOWED_ORIGIN', 'https://10minutebiblebrew.com'); 
