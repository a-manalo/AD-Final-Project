<?php
http_response_code(404);

require_once LAYOUTS_PATH . '/main.layout.php';

renderMainLayout(function () {
    ?>
    <section class="error-section">
        <div class="error-container">
            <h1>404 – You Are Lost</h1>
            <p>The scroll you seek has vanished into the void.</p>
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