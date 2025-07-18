<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: #f0f0f0;
        }

        .sidebar {
            width: 220px;
            background: linear-gradient(135deg, #243B55, #141E30);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
        }

        .sidebar .logo {
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid #444;
        }

        .sidebar nav {
            flex-grow: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar nav a {
            color: white;
            text-decoration: none;
            padding: 12px 0;
        }

        .sidebar nav a:hover {
            background: #2C3E50;
            border-radius: 5px;
            padding-left: 10px;
        }

        .sidebar .logout {
            padding: 20px;
        }

        .sidebar .logout button {
            width: 100%;
            padding: 12px;
            background: red;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .main-content {
            margin-left: 220px;
            flex: 1;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        .card h3 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            padding: 12px;
            width: 100%;
            background: green;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        form button:hover {
            background: #0b7b32;
        }
     .logo img{
        height: 11vh;
        width: 7.5vw;

     }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">
        <img src="home/logo.png" alt="logo"></div>
        <nav>
            <a href="#"><li>Profile</li></a>
            <a href="blog.php"><li>Blog</li></a>
            <a href="gallery.php"><li>Gallery</li></a>
            <a href="index.html"><li>Home</li></a>
        </nav>
        <div class="logout">
            <form action="logout.php" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="card">
            <h3>Welcome, <?= htmlspecialchars($_SESSION['name']); ?></h3>
            <form action="update_profile.php" method="POST">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['name']); ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['email']); ?>" readonly>

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </div>

</body>
</html>
