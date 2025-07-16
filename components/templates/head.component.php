<?php
require_once UTILS_PATH . "/htmlEscape.util.php";

function head($pageTitle, array $pageCss = [])
{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlEscape($pageTitle) ?></title>

        <!-- Page-specific CSS -->
        <?php
        if (!empty($pageCss)) {
            foreach ($pageCss as $cssFile) {
                echo "<link rel=\"stylesheet\" href=\"{$cssFile}\">\n";
            }
        }
        ?>
    </head>
    <?php
}
?>
