<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}


$conn = new mysqli("localhost", "root", "", "users_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$userResult = $conn->query("SELECT id, name, email, role FROM users ORDER BY id ASC");


$postResult = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_page.css">
  
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="index.php" style="background:#d9534f;">Home</a>
            <a href="logout.php" style="background:#d9534f;">Logout</a>
        </nav>
    </header>

    <div class="container">
        <h2>Welcome, <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin'; ?></h2>

        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($userResult && $userResult->num_rows > 0): ?>
                    <?php while ($user = $userResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><?= htmlspecialchars($user['name']); ?></td>
                            <td><?= htmlspecialchars($user['email']); ?></td>
                            <td><?= htmlspecialchars($user['role']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Add New Blog Post</h2>
        <form action="submit_blog.php" method="POST" enctype="multipart/form-data">
            <label>Title:</label>
            <input type="text" name="title" required>
            <label>Author:</label>
            <input type="text" name="author" required>
            <label>Content:</label>
            <textarea name="content" rows="6" required></textarea>
            <label>Upload Image (optional):</label>
            <input type="file" name="image" accept="image/*">
            <button type="submit">Publish Post</button>
        </form>

        <h2>Recent Blog Posts</h2>
        <?php if ($postResult && $postResult->num_rows > 0): ?>
            <?php while ($row = $postResult->fetch_assoc()): ?>
                <div class="card">
                    <?php
                    $image = !empty($row['image_url']) ? $row['image_url'] : 'images/no-image.png';
                    ?>
                    <img src="<?= htmlspecialchars($image); ?>" alt="Blog Image">
                    <div class="card-body">
                        <h5><?= htmlspecialchars($row['title']); ?></h5>
                        <p><strong>By:</strong> <?= htmlspecialchars($row['author']); ?> on <?= htmlspecialchars($row['created_at']); ?></p>
                        <p><?= htmlspecialchars(substr($row['content'], 0, 200)); ?>...</p>
                        <a href="view_post.php?id=<?= $row['id']; ?>" class="btn btn-primary">View</a>
                        <a href="delete_post.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this post?');">Delete</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No blog posts available.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
