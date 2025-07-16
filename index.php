<?php
require_once LAYOUTS_PATH . "/main.layout.php";

renderMainLayout(function () {
    ?>
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
            <div class="carousel-item active">
                <img src="/assets/img/hero_no_text.png" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 text-center">
                    <h5>Welcome to The Forbidden Codex</h5>
                    <p>Unveil hidden knowledge and mysteries.</p>
                    <a href="/pages/Signup/index.php" class="btn btn-primary">Get Started</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item">
                <img src="/assets/img/hero_no_text.png" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100 text-center">
                    <h5>Explore the Archives</h5>
                    <p>Discover forgotten truths.</p>
                    <a href="/pages/product/index.php" class="btn btn-warning">View Forbidden Wares</a>
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

    <div class="offer-section">
        <h2 class="offer-title">Our Offers</h2>
        <p class="offer-subtitle">Discover powerful artifacts, potent elixirs, and forbidden services.</p>
        <div class="image-gallery-section">
            <img src="/assets/img/Heading/4.png" alt="Artifacts of the Damned" >
            <img src="/assets/img/Heading/1.png" alt="Weapons of High Beings" >
            <img src="/assets/img/Heading/3.png" alt="Forbidden Services" > 
            <img src="/assets/img/Heading/2.png" alt="Rare Powerful Elixirs" >
        </div>
    </div>
    

    <div class="rules-guidelines">
        <div class="rules-image">
            <img src="/assets/img/greekstuff.png" alt="Forbidden Rules" />
        </div>
        <div class="rules-content">
            <h2>The Forbidden Codex of Conduct</h2>
            <ul>
            <li>No refunds once a pact is sealed.</li>
            <li>All summoning rituals are final.</li>
            <li>Dead drops must be retrieved within 48 hours.</li>
            <li>Weapons are sold as-is. No enchantment guarantees.</li>
            <li>Artifacts must not be duplicated or resold.</li>
            <li>Do not speak of the Codex in public forums.<br>If caught, the Gods will punish you.</li>
            <li>Strictly bitcoin or In-person payment only.</li>

            </ul>
        </div>
    </div>

    

    <?php
},
    "The Forbidden Codex",
    [
        'css' => [
            '/assets/css/hero.css',
            '/assets/css/main.css',
            '/assets/css/navbar.css',
            '/assets/css/footer.css',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'
        ],
        'js' => [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'
        ]
    ]
);