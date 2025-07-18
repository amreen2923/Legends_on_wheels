<?php
$conn = new mysqli("localhost", "root", "", "car_blog");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $story = $conn->real_escape_string($_POST['story']);

    $stmt = $conn->prepare("INSERT INTO blog_submissions (name, email, story) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $story);

    if ($stmt->execute()) {
        echo "<h2>Thank you for sharing your story, $name!</h2>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
