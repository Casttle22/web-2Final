<?php
// server.php — router para el servidor embebido de PHP
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$public = __DIR__ . '/public';

// Si el archivo existe en /public, que lo sirva directamente
if ($uri !== '/' && file_exists($public . $uri)) {
    return false;
}

// Si no existe, que pase todo a Laravel
require $public . '/index.php';