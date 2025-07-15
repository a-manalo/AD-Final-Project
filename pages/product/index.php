<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sidebar Filter</title>
  <link rel="stylesheet" href="/pages/product/assets/css/product.css">
  
</head>
<body>
  <div class="main-container">
    <div class="container">
      <aside class="sidebar">
        <h2>Category</h2>
        <div class="filter-group">
          <ul>
            <li><a href="#" data-filter="all">All</a></li>
          <li><a href="#" data-filter="drugs">Drugs</a></li>
          <li><a href="#" data-filter="weapons">Weapons</a></li>
          <li><a href="#" data-filter="artifacts">Artifacts</a></li>
          <li><a href="#" data-filter="services">Services</a></li>
          </ul>
        </div>
      </aside>
      <main class="content">
        <h1 id="category-title">Products</h1>
        <?php include COMPONENTS_GROUP_PATH . "/productList.component.php"; ?>
      </main>
    </div>
  </div>
  <script src="/pages/product/assets/js/category_filter.js"></script>
</body>
</html>