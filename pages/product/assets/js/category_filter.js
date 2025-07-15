const filterLinks = document.querySelectorAll("[data-filter]");
const sections = document.querySelectorAll(".product-section");
const title = document.getElementById("category-title");

filterLinks.forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const filter = this.getAttribute("data-filter");

    filterLinks.forEach((l) => l.classList.remove("active"));
    this.classList.add("active");

    title.textContent =
      filter === "all"
        ? "All Products"
        : filter.charAt(0).toUpperCase() + filter.slice(1);

    sections.forEach((section) => {
      const sectionCategory = section.getAttribute("data-category");
      section.style.display =
        filter === "all" || sectionCategory === filter ? "block" : "none";
    });
  });
});
