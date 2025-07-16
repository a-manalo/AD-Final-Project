// Toggle mobile menu
const hamburgerBtn = document.getElementById("hamburger-btn");
const navbarMenu = document.getElementById("navbar-menu");

hamburgerBtn.addEventListener("click", () => {
  navbarMenu.classList.toggle("active");
  hamburgerBtn.classList.toggle("active");
});

// Close menu when clicking on a link (mobile)
const navLinks = document.querySelectorAll(".navbar-links a");
navLinks.forEach((link) => {
  link.addEventListener("click", () => {
    navbarMenu.classList.remove("active");
    hamburgerBtn.classList.remove("active");
  });
});

// Close menu when clicking outside (mobile)
document.addEventListener("click", (e) => {
  if (!hamburgerBtn.contains(e.target) && !navbarMenu.contains(e.target)) {
    navbarMenu.classList.remove("active");
    hamburgerBtn.classList.remove("active");
  }
});
