<?php
// server.php (router para php -S)
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$public = __DIR__ . '/public' . $uri;

// Si el archivo solicitado existe físicamente en /public, que lo sirva tal cual
if ($uri !== '/' && file_exists($public)) {
    return false;
}

// Si no existe, redirige todo a Laravel
require __DIR__ . '/public/index.php';
