<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="header">
        <img class="logo" src="home/logo.png" alt="logo">
        <div class="head">
            <button class="menu-toggle">☰ Menu</button>
            <ul class="menu nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="car-directory.php">Directory</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="blog.php">Blog</a></li>
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

<section class="hero">
    <div class="overlay">
      <h2>"For the love of classics—join the journey."</h2>
      <p>Explore the timeless beauty, history, and culture of vintage automobiles from around the world.</p>
      <button onclick="scrollToSection('features')">Explore Features</button>
    </div>
</section>

    <div class="car-dic">
    <h3>Car Directory</h3>
    <div class="car-directory">
        <div class="car-card" >Ford Mustang
            <img src="home/ford.png">
        </div>
        <div class="car-card">Chevrolet Camaro
            <img src="home/chev.png" alt="">
        </div>
        <div class="car-card">Dodge Charger
            <img src="home/dodge.png" alt="">
        </div>
        <div class="car-card">Porche 911
            <img src="home/porche.png" alt="">
        </div>
        <div class="car-card">BMW M3
            <img src="home/bmw.png" alt="">
        </div>
    </div>
   <a href="car-directory.php"> <button class="car-button">See More</button></a>
</div>


<div class="feature_container">
    <section class="features" id="features">
        <div class="feature_overlay">
    <h2>Our Features</h2>
    <div class="features_grid">
      <div class="feature">
        <a href="blog.php">Interactive Blog</a></div>
      <div class="feature">
        <a href="car-directory.html">Vintage Car Directory</a></div>
      <div class="feature">
        <a href="gallery.php">Photo Gallery</a></div>
    </div>
        </div>
  </section>

  <section class="explore" id="explore">
    <div class="feature_overlay">
    <h2>Explore Our Collection</h2>
    <div class="explore-grid">
      <div class="explore-card">
        <a href="car-directory.html">American Classics</a></div>
      <div class="explore-card"><a href="car-directory.html">European Legends</a></div>
      <div class="explore-card"><a href="car-directory.html">Japanese Icons</a></div>
    </div>
    </div>
  </section>  
</div>


<div class="image-container" id="imageContainer">
    <span style="--i:0;"><img src="home/car-1.png" alt=""></span>
    <span style="--i:1;"><img src="home/car-2.png" alt=""></span>
    <span style="--i:2;"><img src="home/car-3.png" alt=""></span>
    <span style="--i:3;"><img src="home/car-4.png" alt=""></span>
    <span style="--i:4;"><img src="home/car-5.png" alt=""></span>
    <span style="--i:5;"><img src="home/car-6.png" alt=""></span>
    <span style="--i:6;"><img src="home/car-7.png" alt=""></span>
    <span style="--i:7;"><img src="home/car-8.png" alt=""></span>
  </div>
  <div class="btn-container">
    <button class="btn" onclick="rotate('right')">Right</button>
    <button class="btn" onclick="rotate('left')">Left</button>
 </div>

 <div class="gallery-button">
    <button><a href="gallery.php">Explore the Gallery</a></button>
 </div>


<button id="openModalBtn">Share Your Blog</button>

<div id="shareModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Share Your Blog</h2>
       <form action="index.html" method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="story" placeholder="Your Story" rows="5" required></textarea>
    <button type="submit">Submit</button>
</form>

    </div>
</div>


<h3>MUSTANG 1967</h3>

<div class="features-container">
    <div class="features-grid">
        <div class="feature-card positive">
            <div class="feature-title">Iconic muscle car design</div>
            <div class="feature-desc">Timeless, aggressive styling that defined American muscle cars</div>
        </div>
        
        <div class="feature-card positive">
            <div class="feature-title">Powerful engine options</div>
            <div class="feature-desc">Available 289ci V8 or 390ci V8 with up to 320 horsepower</div>
        </div>
        
        <div class="feature-card positive">
            <div class="feature-title">Sporty handling</div>
            <div class="feature-desc">Responsive steering and balanced weight distribution for its era</div>
        </div>
        
        <div class="feature-card negative">
            <div class="feature-title">Limited safety features</div>
            <div class="feature-desc">Lacks modern safety equipment like airbags or crumple zones</div>
        </div>
    </div>
    
    <img src="home/mustang67.png" alt="1967 Ford Mustang" class="mustang-image">
    
    <div class="features-grid">
        <div class="feature-card positive">
            <div class="feature-title">Classic interior</div>
            <div class="feature-desc">Retro styling with comfortable bucket seats and woodgrain accents</div>
        </div>
        
        <div class="feature-card positive">
            <div class="feature-title">Strong aftermarket support</div>
            <div class="feature-desc">Extensive parts availability for restoration and customization</div>
        </div>
        
        <div class="feature-card negative">
            <div class="feature-title">Fuel efficiency</div>
            <div class="feature-desc">Low MPG compared to modern vehicles (typically 10-15 mpg)</div>
        </div>
        
        <div class="feature-card negative">
            <div class="feature-title">Older technology</div>
            <div class="feature-desc">No modern conveniences like Bluetooth, navigation, or backup cameras</div>
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

<script src="home.js"></script>
</body>
</html>