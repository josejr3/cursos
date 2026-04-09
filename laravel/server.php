<?php

// CAMBIO: Definimos la ruta a la carpeta 'web' de forma relativa al archivo
$publicPath = __DIR__ . '/../web';

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Este bloque permite emular el mod_rewrite de Apache. 
// Si el archivo existe físicamente en 'web', el servidor lo entrega directamente.
if ($uri !== '/' && file_exists($publicPath.$uri)) {
    return false;
}

$formattedDateTime = date('D M j H:i:s Y');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$remoteAddress = $_SERVER['REMOTE_ADDR'].':'.$_SERVER['REMOTE_PORT'];

// Esto mantiene los mensajes en tu terminal
file_put_contents('php://stdout', "[$formattedDateTime] $remoteAddress [$requestMethod] URI: $uri\n");

// CAMBIO: Carga el index.php desde la carpeta 'web'
require_once $publicPath.'/index.php';