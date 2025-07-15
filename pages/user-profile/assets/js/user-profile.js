const sidebarItems = document.querySelectorAll(".sidebar-item");
const contentSections = document.querySelectorAll(".content-section");

sidebarItems.forEach((item) => {
  item.addEventListener("click", () => {
    // Remove 'active' class from all sidebar items
    sidebarItems.forEach((i) => i.classList.remove("active"));
    item.classList.add("active");

    const sectionToShow = "section-" + item.dataset.section;

    // Hide all sections
    contentSections.forEach((section) => {
      section.classList.add("hidden");
    });

    // Show the selected section
    const activeSection = document.getElementById(sectionToShow);
    if (activeSection) activeSection.classList.remove("hidden");
  });
});
