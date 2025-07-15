<?php
if (!defined('BASE_PATH')) {
    define('BASE_PATH', realpath(__DIR__));
}
define('HANDLERS_PATH', realpath(BASE_PATH . "/handlers"));
define('UTILS_PATH', realpath(BASE_PATH . "/utils"));
define('DUMMIES_PATH', realpath(BASE_PATH . "/staticDatas/dummies"));
define('COMPONENTS_PATH', realpath(BASE_PATH . "/components"));
define('LAYOUTS_PATH', realpath(BASE_PATH . "/layouts"));
define('PAGES_PATH', realpath(BASE_PATH . "/pages"));
define('STATICDATAS_PATH', realpath(BASE_PATH . "/staticDatas"));
define('ERRORS_PATH', realpath(BASE_PATH . "/errors"));
define('SQL_PATH', realpath(BASE_PATH . "/sql"));
define('TEMPLATES_PATH', realpath(BASE_PATH . "/components/templates"));
define('COMPONENTS_GROUP_PATH', realpath(BASE_PATH . "/components/componentGroup"));

define('DATABASE_PATH', realpath(BASE_PATH . "/database"));

chdir(BASE_PATH);
