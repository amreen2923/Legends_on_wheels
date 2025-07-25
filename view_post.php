<?php
session_start();
require_once("config.php");

if (!isset($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$postResult = $stmt->get_result();
if ($postResult->num_rows === 0) {
    echo "<p>Post not found.</p>";
    exit();
}
$post = $postResult->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_SESSION['name'])) {
    $comment = $_POST['comment'];
    $author = $_SESSION['name'];
    $stmt = $conn->prepare("INSERT INTO comments (post_id, author, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $author, $comment);
    $stmt->execute();
    header("Location: view_post.php?id=$id");
    exit();
}

$comments = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC");
$comments->bind_param("i", $id);
$comments->execute();
$commentsResult = $comments->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']); ?></title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .post-img { width: 40%; max-height: 300px; object-fit: cover; border-radius: 5px; margin-left:30% }
        h2 { margin-top: 15px;}
        .btn { padding: 8px 15px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px; }
        .btn-success { background: #28a745; }
        .btn:hover { opacity: 0.9; }
        .comment-card { border-bottom: 1px solid #ddd; padding: 10px 0; }
        textarea { width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        .form-label { font-weight: bold; margin-bottom: 5px; display: block; }
    </style>
</head>
<body>
<div class="container">
    <?php $image = !empty($post['image_url']) ? $post['image_url'] : 'images/no-image.png'; ?>
    <img src="<?= htmlspecialchars($image); ?>" alt="Post Image" class="post-img">

    <h2><?= htmlspecialchars($post['title']); ?></h2>
    <h6>By <?= htmlspecialchars($post['author']); ?> on <?= htmlspecialchars($post['created_at']); ?></h6>
    <p><?= nl2br(htmlspecialchars($post['content'])); ?></p>
    <a href="blog.php" class="btn">Back to Blog</a>

    <hr>
    <h4>Comments</h4>
    <?php if ($commentsResult->num_rows > 0): ?>
        <?php while ($c = $commentsResult->fetch_assoc()): ?>
            <div class="comment-card">
                <strong><?= htmlspecialchars($c['author']); ?></strong> <em>(<?= $c['created_at']; ?>)</em>
                <p><?= nl2br(htmlspecialchars($c['comment'])); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['name'])): ?>
        <form method="POST" class="mt-3">
            <label class="form-label">Add a Comment</label>
            <textarea name="comment" rows="3" required></textarea>
            <button type="submit" class="btn btn-success">Comment</button>
        </form>
    <?php else: ?>
        <p class="mt-3">Please <a href="login.php">login</a> to comment.</p>
    <?php endif; ?>
</div>
</body>
</html>
