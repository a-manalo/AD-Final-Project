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
</body>

<script>
  const filterLinks = document.querySelectorAll('[data-filter]');
  const productCards = document.querySelectorAll('.product-card');
  const title = document.getElementById('category-title');

  filterLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const filter = this.getAttribute('data-filter');

      // Toggle active class
      filterLinks.forEach(l => l.classList.remove('active'));
      this.classList.add('active');

      // Update category title
      title.textContent = filter === 'all'
        ? 'All Products'
        : filter.charAt(0).toUpperCase() + filter.slice(1); // Capitalize

      // Filter product cards
      productCards.forEach(card => {
        const category = card.getAttribute('data-category');
        card.style.display = (filter === 'all' || filter === category) ? 'block' : 'none';
      });
    });
  });
</script>


</html>