<?php
function renderHero($title = "The Hydra Network", $description = "A smart site that is filled with treasures and services from the darkest world. Explore with caution and precision.") {
    ob_start();
    ?>
    <section class="hero">
        <div class="container">
            <div class="hero-container">
                <div class="hero-text">
                    <h1><?php echo htmlspecialchars($title); ?></h1>
                    <p><?php echo htmlspecialchars($description); ?></p>
                </div>
                <div class="hero-images">
                    <div class="bust" data-bust="1"></div>
                    <div class="bust" data-bust="2"></div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
?>