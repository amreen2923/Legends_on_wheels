
const modal = document.getElementById("shareModal");
const openBtn = document.getElementById("openModalBtn");
const closeBtn = document.querySelector(".close-btn");

openBtn.onclick = () => modal.style.display = "flex";
closeBtn.onclick = () => modal.style.display = "none";
window.onclick = (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
};

 let angle = 0;
    function rotate(direction) {
      if (direction === 'left') {
        angle -= 45;
      } else {
        angle += 45;
      }
      document.getElementById('imageContainer').style.transform = `perspective(1000px) rotateY(${angle}deg)`;
    }
  
    let startX = 0;
    let endX = 0;

    document.getElementById('imageContainer').addEventListener('touchstart', (e) => {
      startX = e.touches[0].clientX;
    });

    document.getElementById('imageContainer').addEventListener('touchend', (e) => {
      endX = e.changedTouches[0].clientX;
      if (startX > endX + 30) {
        rotate('right');
      } else if (startX < endX - 30) {
        rotate('left');
      }
    });

     function scrollToSection(sectionId) {
      document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
    }
    let toggleButton = document.querySelector('.menu-toggle');
let navLinks = document.querySelector('.nav-links');

    toggleButton.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });