<?php
define('BASE_PATH', realpath(_DIR_));
define('HANDLERS_PATH', realpath(BASE_PATH . "/handlers"));
define('UTILS_PATH', realpath(BASE_PATH . "/utils"));
define('DUMMIES_PATH', realpath(BASE_PATH . "/staticDatas/dummies"));

chdir(BASE_PATH);