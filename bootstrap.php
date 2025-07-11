<?php
if (!defined('BASE_PATH')) {
    define('BASE_PATH', realpath(__DIR__));
}

if (!defined('HANDLERS_PATH')) {
    define('HANDLERS_PATH', realpath(BASE_PATH . "/handlers"));
}

if (!defined('UTILS_PATH')) {
    define('UTILS_PATH', realpath(BASE_PATH . "/utils"));
}

if (!defined('DUMMIES_PATH')) {
    define('DUMMIES_PATH', realpath(BASE_PATH . "/staticDatas/dummies"));
}

chdir(BASE_PATH);