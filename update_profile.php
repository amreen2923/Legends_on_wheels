<?php
session_start();
require_once "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Only hash if password is provided
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $new_name, $new_email, $hashed_password, $_SESSION['user_id']);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_name, $new_email, $_SESSION['user_id']);
    }

    if ($stmt->execute()) {
        $_SESSION['name'] = $new_name;
        $_SESSION['email'] = $new_email;
        $success_message = "Profile updated successfully!";
    } else {
        $error_message = "Something went wrong. Try again.";
    }
}

// Fetch current user data
$stmt = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
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
                    <li><a href="#edit-profile">Edit Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </aside>
        <main class="content">
            <div class="welcome-card">
                <h1>Hello, <?= htmlspecialchars($_SESSION['name']) ?> 👋</h1>
                <p>This is your dashboard. You can update your account details below.</p>

                <?php if (!empty($success_message)): ?>
                    <p class="success"><?= $success_message ?></p>
                <?php elseif (!empty($error_message)): ?>
                    <p class="error"><?= $error_message ?></p>
                <?php endif; ?>

                <form id="edit-profile" method="POST">
                    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" placeholder="Full Name" required>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" placeholder="Email" required>
                    <input type="password" name="password" placeholder="New Password (leave blank to keep old)">
                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
