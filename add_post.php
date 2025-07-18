<?php
session_start();
require_once("config.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: blog.php");
    exit();
}

if (isset($_POST['title'], $_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['name'];
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : null;

    $stmt = $conn->prepare("INSERT INTO blog_posts (title, content, author, image_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $author, $image_url);
    $stmt->execute();

    header("Location: blog.php");
    exit();
}
?>
    

<!DOCTYPE html>
<html>
<head>
    <title>Add New Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Add New Blog Post</h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
       <div class="mb-3">
    <label class="form-label">Image URL</label>
    <input type="text" name="image_url" class="form-control" placeholder="Paste image link (optional)">
</div>
        <button type="submit" class="btn btn-success">Post</button>
        <a href="blog.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>