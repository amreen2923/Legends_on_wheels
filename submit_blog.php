<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "car_blog");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $title   = $conn->real_escape_string($_POST['title']);
    $author  = $conn->real_escape_string($_POST['author']);
    $content = $conn->real_escape_string($_POST['content']);


    $image_url = null;


    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";

    
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $filename  = time() . "_" . uniqid() . "." . $extension;
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image_url = $targetFile; 
        } else {
            echo "<p style='color:red;'>Error: Could not upload image.</p>";
        }
    }

    $stmt = $conn->prepare("INSERT INTO blog_posts (title, content, author, image_url, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $title, $content, $author, $image_url);

    if ($stmt->execute()) {
        echo "<h2 style='color:green;'>Blog post added successfully!</h2>";
        echo "<p><a href='blog.php'>View Blog</a></p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
$conn->close();
?>
