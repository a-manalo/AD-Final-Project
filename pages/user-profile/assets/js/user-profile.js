const sidebarItems = document.querySelectorAll(".sidebar-item");
const contentSections = document.querySelectorAll(".content-section");

sidebarItems.forEach((item) => {
  item.addEventListener("click", () => {
    sidebarItems.forEach((i) => i.classList.remove("active"));
    item.classList.add("active");

    const sectionToShow = "section-" + item.dataset.section;

    contentSections.forEach((section) => {
      section.classList.add("hidden");
    });

    const activeSection = document.getElementById(sectionToShow);
    if (activeSection) activeSection.classList.remove("hidden");
  });
});
