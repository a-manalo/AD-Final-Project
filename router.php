<?php
require __DIR__ . '/bootstrap.php';

if (php_sapi_name() === 'cli-server') {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = BASE_PATH . $urlPath;
    if (is_file($file)) {
        return false;
    }

    if (is_dir($file) && is_file($file . '/index.php')) {
        return false;
    }
}

http_response_code(404);
require ERRORS_PATH . '/_404.error.php';
exit;