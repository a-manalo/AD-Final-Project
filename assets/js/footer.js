function handleNewsletter(event) {
  event.preventDefault();
  const email = event.target.querySelector('input[type="email"]').value;
  alert(
    `Thank you for subscribing with ${email}! You'll receive our latest deals and updates.`
  );
  event.target.reset();
}

// Add hover effects for social links
document.querySelectorAll(".social-links a").forEach((link) => {
  link.addEventListener("mouseenter", function () {
    this.style.transform = "scale(1.1)";
  });

  link.addEventListener("mouseleave", function () {
    this.style.transform = "scale(1)";
  });
});
