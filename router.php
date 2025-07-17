<?php
ob_start();
require __DIR__ . '/bootstrap.php';

if (php_sapi_name() === 'cli-server') {
    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $file = BASE_PATH . $urlPath;
    if (is_file($file)) {
        return false;
    }

    if (!is_file($file)) {
        http_response_code(404);
        require ERRORS_PATH . '/_404.error.php';
        exit;
    }
}

require BASE_PATH . '/index.php';
exit;
ob_end_flush();