<?php
session_start();
require_once("config.php");

if (!isset($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM blog_posts WHERE id = $id");

if ($result->num_rows === 0) {
    echo "<p class='text-danger'>Post not found.</p>";
    exit();
}

$post = $result->fetch_assoc();

// Handle comment submission
if (isset($_POST['comment']) && isset($_SESSION['name'])) {
    $comment = $_POST['comment'];
    $author = $_SESSION['name'];
    $stmt = $conn->prepare("INSERT INTO comments (post_id, author, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $author, $comment);
    $stmt->execute();
    header("Location: view_post.php?id=$id");
    exit();
}

// Fetch comments
$comments = $conn->query("SELECT * FROM comments WHERE post_id = $id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($post['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2><?= htmlspecialchars($post['title']); ?></h2>
    <h6 class="text-muted">By <?= htmlspecialchars($post['author']); ?> on <?= $post['created_at']; ?></h6>
    <p class="mt-4"><?= nl2br(htmlspecialchars($post['content'])); ?></p>
    <a href="blog.php" class="btn btn-primary mt-3">Back to Blog</a>

    <hr>
    <h4>Comments</h4>

    <?php if ($comments->num_rows > 0): ?>
        <?php while ($c = $comments->fetch_assoc()): ?>
            <div class="card mb-2">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">By <?= htmlspecialchars($c['author']); ?> on <?= $c['created_at']; ?></h6>
                    <p class="card-text"><?= nl2br(htmlspecialchars($c['comment'])); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['name'])): ?>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Add a Comment</label>
            <textarea name="comment" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Comment</button>
    </form>
    <?php else: ?>
        <p class="mt-3">Please <a href="login.php">login</a> to comment.</p>
    <?php endif; ?>
</div>
</body>
</html>