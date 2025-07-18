<!-- ADMIN PAGE: admin_page.php -->
<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
require_once("config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand">Admin Dashboard</span>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
</nav>

<div class="container mt-4">
    <h3>Welcome, <?= $_SESSION['name']; ?> (Admin)</h3>

    <div class="card mt-3">
        <div class="card-header">User List</div>
        <div class="card-body">
            <?php
            $result = $conn->query("SELECT * FROM users");
            if ($result->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr></thead><tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                          </tr>";
                }
                echo '</tbody></table>';
            } else {
                echo "<p>No users found.</p>";
            }
            ?>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">Add New Blog Post</div>
    <div class="card-body">
        <form action="add_post.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
             <div class="mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="5" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Image (optional)</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Publish Post</button>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
