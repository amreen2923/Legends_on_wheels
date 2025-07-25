let toggleButton = document.querySelector('.menu-toggle');
let navLinks = document.querySelector('.nav-links');

    toggleButton.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });

    