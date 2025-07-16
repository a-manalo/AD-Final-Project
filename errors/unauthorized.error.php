<?php
http_response_code(404);

require_once LAYOUTS_PATH . '/main.layout.php';

renderMainLayout(function () {
    ?>
    <section class="error-section">
        <div class="error-container">
            <h1>Unauthorized</h1>
            <p>Oops! Your Unauthorized for the page you’re looking for.</p>
            <a href="/index.php" class="back-btn">Return to the Codex</a>
        </div>
    </section>
    <?php
}, 'Page Not Found', [
    'css' => [
        '/assets/css/error.css',
        '/assets/css/navbar.css',
        '/assets/css/footer.css',
        '/assets/css/main.css'
    ]
]);