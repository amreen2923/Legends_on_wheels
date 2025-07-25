<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Directory</title>
    <link rel="stylesheet" href="car-directory.css"> 
</head>
<body>
    <div class="header">
        <img class="logo" src="home/logo.png" alt="logo">
        <div class="head">
            <button class="menu-toggle">☰ Menu</button>
            <ul class="menu nav-links">
                <a href="index.php"><li>Home</li></a>
                <a href="car-directory.php"><li>Directory</li></a>
                <a href="gallery.php"><li>Gallery</li></a>
                <a href="blog.php"><li>Blog</li></a>
             <?php if (isset($_SESSION['email'])): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
            <li><a href="admin_page.php">Admin Dashboard</a></li>
            <?php else: ?>
            <li><a href="user_page.php">User Dashboard</a></li>
           <?php endif; ?>
           <li><a href="logout.php">Logout</a></li>
           <?php else: ?>
           <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        
            </ul>
        </div>
    </div>

    <h2>Car Directory</h2>
    <input type="text" id="searchBar" placeholder="Search for a car..." onkeyup="filterCars()">

    <!-- Classic American Vintage Cars -->
    <div class="car-category">
        <h3>Classic American Vintage Cars</h3>
        <div class="car-directory">
            <div class="car-card" onclick="redirectToCarDetails('Ford_Model_T')">
                Ford Model T <img src="american_cars/fordmodel-4.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Chevrolet_Bel_Air')">
                Chevrolet Bel Air <img src="american_cars/belair-3.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Ford_Mustang')">
                Ford Mustang <img src="american_cars/mustang-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Cadillac_Eldorado')">
                Cadillac Eldorado <img src="american_cars/cadillac-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Dodge_Charger')">
                Dodge Charger <img src="american_cars/dodge-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Plymouth_Road_Runner')">
                Plymouth Road Runner <img src="american_cars/roadrunner-1.png" alt="">
            </div>
        </div>
    </div>

    <!-- European Vintage Cars -->
    <div class="car-category">
        <h3>European Vintage Cars</h3>
        <div class="car-directory">
            <div class="car-card" onclick="redirectToCarDetails('Jaguar_E_Type')">
                Jaguar E Type <img src="europeon_cars/jaguar-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Mercedes-Benz_300SL_Gullwing')">
                Mercedes-Benz 300SL Gullwing <img src="europeon_cars/gullwing-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Porsche_356')">
                Porsche 356 <img src="europeon_cars/porsche-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Volkswagen_Beetle')">
                Volkswagen Beetle <img src="europeon_cars/beetle-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Ferrari_250_GTO')">
                Ferrari 250 GTO <img src="europeon_cars/ferrari-1.png" alt="">
            </div>
        </div>
    </div>

    <!-- Japanese Vintage Cars -->
    <div class="car-category">
        <h3>Japanese Vintage Cars</h3>
        <div class="car-directory">
            <div class="car-card" onclick="redirectToCarDetails('Toyota_2000GT')">
                Toyota 2000GT <img src="japnese_cars/toyota-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Datsun_240Z')">
                Datsun 240Z <img src="japnese_cars/datsun-1.png" alt="">
            </div>
            <div class="car-card" onclick="redirectToCarDetails('Mazda_Cosmo')">
                Mazda Cosmo <img src="japnese_cars/mazda-1.png" alt="">
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="links">
            <a href="#">Home</a>
            <a href="#">Vintage Cars</a>
            <a href="#">Community</a>
            <a href="#">Contact</a>
        </div>
        <p>&copy; 2025 Vintage Car Blog. All rights reserved.</p>
    </footer>

    <script src="car-directory.js"></script>
</body>
</html>
