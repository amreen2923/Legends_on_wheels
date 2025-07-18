<?php
session_start();
require_once("config.php");

if (isset($_GET['delete_id']) && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM blog_posts WHERE id = $delete_id");
    header("Location: blog.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>

<div class="header">
    <img class="logo" src="home/logo.png" alt="logo">
    <div class="head">
          <button class="menu-toggle">☰ Menu</button>
        <ul class="menu nav-links">
            <a href="index.php"><li>Home</li></a>
                <a href="car-directory.html"><li>Directory</li></a>
                <a href="gallery.php"><li>Gallery</li></a>
                <a href="blog.php"><li>Blog</li></a>
            <?php if (isset($_SESSION['email'])): ?>
                <a href="user_page.php"><li>Dashboard</li></a>
                <a href="logout.php"><li>Logout</li></a>
            <?php else: ?>
                <a href="login.php"><li>Login</li></a>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="main-content">
    <h3>Recent Posts</h3>

    <?php
    $result = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()):

        $image = "";
        if (stripos($row['title'], 'mustang') !== false) {
            $image = "american_cars/mustang-1.png";
        } elseif (stripos($row['title'], 'beetle') !== false) {
            $image = "europeon_cars/beetle-2.png";
        } elseif (stripos($row['title'], 'chevelle') !== false) {
            $image = "https://upload.wikimedia.org/wikipedia/commons/9/9c/1972_Chevrolet_Chevelle_Malibu_350.jpg";
        }
    ?>

        <div class="card">
            <?php if ($image): ?>
                <img src="<?= $image; ?>" alt="Post Image">
            <?php endif; ?>
            <div class="card-body">
                <h5><?= htmlspecialchars($row['title']); ?></h5>
                <h6>By <?= htmlspecialchars($row['author']); ?> on <?= $row['created_at']; ?></h6>
                <p><?= nl2br(substr($row['content'], 0, 200)); ?>...</p>
                <a href="view_post.php?id=<?= $row['id']; ?>" class="btn">Read More</a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="blog.php?delete_id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    <?php
        endwhile;
    else:
        echo "<p>No blog posts found.</p>";
    endif;
    ?>
</div>
<script src="blog.js"></script>
</body>
</html>

