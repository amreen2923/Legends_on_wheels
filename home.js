
let modal = document.getElementById("shareModal");
let openBtn = document.getElementById("openModalBtn");
let closeBtn = document.querySelector(".close-btn");

if (modal && openBtn && closeBtn) {
  openBtn.onclick = () => (modal.style.display = "flex");
  closeBtn.onclick = () => (modal.style.display = "none");
  window.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
  });

  window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") modal.style.display = "none";
  });
}

let angle = 0;
let imageContainer = document.getElementById("imageContainer");
function rotate(direction) {
  if (!imageContainer) return;
  angle += direction === "left" ? -45 : 45;
  imageContainer.style.transform = `perspective(1000px) rotateY(${angle}deg)`;
}

let startX = 0;
if (imageContainer) {
  imageContainer.addEventListener(
    "touchstart",
    (e) => {
      startX = e.touches[0].clientX;
    },
    { passive: true }
  );

  imageContainer.addEventListener(
    "touchend",
    (e) => {
      const endX = e.changedTouches[0].clientX;
      if (startX > endX + 30) rotate("right");
      else if (startX < endX - 30) rotate("left");
    },
    { passive: true }
  );
}

function scrollToSection(sectionId) {
  let el = document.getElementById(sectionId);
  if (el) el.scrollIntoView({ behavior: "smooth" });
}
let toggleButton = document.querySelector(".menu-toggle");
let navLinks = document.querySelector(".nav-links");
if (toggleButton && navLinks) {
  toggleButton.addEventListener("click", () => {
    navLinks.classList.toggle("active");
  });
}
