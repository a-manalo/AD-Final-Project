<?php
declare(strict_types=1);

require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.util.php';
Auth::init();

require_once LAYOUTS_PATH . '/main.layout.php';
renderMainLayout(
    function () {
        ?>
        <div class="main-container">
            <div class="product-container">
                <aside class="sidebar">
                    <h2>Category</h2>
                    <div class="filter-group">
                        <ul>
                            <li><a href="#" data-filter="all">All</a></li>
                            <li><a href="#" data-filter="elixirs">Elixirs</a></li>
                            <li><a href="#" data-filter="weapons">Weapons</a></li>
                            <li><a href="#" data-filter="artifacts">Artifacts</a></li>
                            <li><a href="#" data-filter="services">Services</a></li>
                        </ul>
                    </div>
                </aside>
                <main class="content">
                    <h1 id="category-title">Products</h1>
                    <?php require_once COMPONENTS_GROUP_PATH . "/productList.component.php";?>
                </main>
            </div>
        </div>
        <?php
    },
    "Products",
    [
        'css' => [
            '/pages/product/assets/css/product.css',
            '/assets/css/main.css',
            '/assets/css/navbar.css',
            '/assets/css/footer.css'
        ],
        'js' => [
            '/pages/product/assets/js/category_filter.js',
        ]
    ]
);
