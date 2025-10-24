<?php
// server.php — router para el servidor embebido de PHP
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$publicPath = __DIR__ . '/public' . $uri;

// Si el archivo existe en /public, que lo sirva directamente
if ($uri !== '/' && file_exists($publicPath)) {
    return false;
}

// Si no existe, que pase todo a Laravel
require __DIR__ . '/public/index.php';