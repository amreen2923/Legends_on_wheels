
  let toggleButton = document.querySelector('.menu-toggle');
let navLinks = document.querySelector('.nav-links');

    toggleButton.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
           
    
    function redirectToCarDetails(carName) {
            window.location.href = `car-details.html?car=${carName}`;
        }

        function filterCars() {
            let filter = document.getElementById('searchBar').value.toLowerCase();
            let cars = document.querySelectorAll('.car-card');

            cars.forEach(car => {
                let text = car.textContent.toLowerCase();
                car.style.display = text.includes(filter) ? '' : 'none';
            });
        }