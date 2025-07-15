const filterLinks = document.querySelectorAll("[data-filter]");
const productCards = document.querySelectorAll(".product-card");
const title = document.getElementById("category-title");

filterLinks.forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const filter = this.getAttribute("data-filter");

    // Toggle active class
    filterLinks.forEach((l) => l.classList.remove("active"));
    this.classList.add("active");

    //Updates Category Title
    //Ex: User click on artifacts title will display "Artifacts"
    title.textContent =
      filter === "all"
        ? "All Products"
        : filter.charAt(0).toUpperCase() + filter.slice(1); // Capitalize

    //Filters Product to show products in each category
    productCards.forEach((card) => {
      const category = card.getAttribute("data-category");
      card.style.display =
        filter === "all" || filter === category ? "block" : "none";
    });
  });
});
