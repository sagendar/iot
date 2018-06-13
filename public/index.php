<?php

chdir(dirname(__DIR__));

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

// get environment from virtualhost
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'production');

require __DIR__ . '/../vendor/autoload.php';

//session_start();

$app = new IoT\Application();
$app->run();