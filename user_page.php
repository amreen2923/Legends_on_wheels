<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user_page.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>Welcome</h2>
            <p><?= htmlspecialchars($_SESSION['name']) ?></p>
            <nav>
             <ul>
             <li><a href="index.php"> Home</a></li>
             <li><a href="gallery.php">Gallery</a></li>
             <li><a href="update_profile.php"> Edit Profile</a></li>
             <li><a href="logout.php"> Logout</a></li>
         </ul>
</nav>

        </aside>
        <main class="content">
            <div class="welcome-card">
                <h1>Hello, <?= htmlspecialchars($_SESSION['name']) ?> 👋</h1>
                <p>This is your user dashboard. You can manage your account and personal details here.</p>
            </div>
        </main>
    </div>
</body>
</html>
