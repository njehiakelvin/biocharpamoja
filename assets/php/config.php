<?php
// config.php — reads .env from one level above the web root
$envPath = dirname($_SERVER['DOCUMENT_ROOT']) . '/.env';

if (!file_exists($envPath)) {
    die('Server configuration error. Contact the site administrator.');
}

$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    [$key, $value] = explode('=', $line, 2);
    $_ENV[trim($key)] = trim($value);
}
