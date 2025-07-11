<?php 
include 'layouts/main.layout.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Forbidden Codex</title>
    <link rel="stylesheet" href="/assets/css/hero.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <!-- Hero Section -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
        </div>
        <!-- Slides -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active position-relative text-center">
                <img src="/assets/img/hero-no-text.png" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to The Forbidden Codex</h5>
                    <p>Unveil hidden knowledge and mysteries.</p>
                    <a href="/pages/Login-SignUpPage/index.php" class="btn btn-primary">Get Started</a>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item text-center">
                <img src="/assets/img/hero-no-text.png" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Explore the Archives</h5>
                    <p>Discover forgotten truths.</p>
                    <a href="/pages" class="btn btn-warning">Browse Archives</a>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item text-center">
                <img src="/assets/img/hero-no-text.png" class="d-block w-100" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Join Our Guild</h5>
                    <p>Be part of the legacy.</p>
                    <a href="/pages" class="btn btn-success">Register Now</a>
                </div>
            </div>
        </div>
        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</body>
 <h1>DATABASE CONNECTION STATUS:</h1>
    <?php
        require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
        require_once HANDLERS_PATH . '/postgreChecker.handler.php';
    ?>
</body>
</html>