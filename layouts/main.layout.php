<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.util.php';
Auth::init();

require_once TEMPLATES_PATH . '/head.component.php';
require_once TEMPLATES_PATH . '/navbar.component.php';
require_once TEMPLATES_PATH . '/foot.component.php';
require_once UTILS_PATH . "/envSetter.util.php";

$user = Auth::user();

function renderMainLayout(callable $content, string $title, array $customJsCss = [], bool $showHeaderFooter = true): void
{
    global $user;
    head($title, $customJsCss['css'] ?? []);

    if ($showHeaderFooter) {
        navHeader($user);
    }

    $content();

    if ($showHeaderFooter) {
        footer($customJsCss['js'] ?? []);
    }
}
