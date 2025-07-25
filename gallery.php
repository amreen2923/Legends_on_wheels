<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "vintage_cars";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['email']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $allowedTypes = ["jpg", "jpeg", "png", "gif"];

    foreach ($_FILES["fileToUpload"]["name"] as $key => $fileName) {
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes)) {
            $newFileName = uniqid() . "_" . basename($fileName);
            $targetFilePath = $targetDir . $newFileName;

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $targetFilePath)) {
                $stmt = $conn->prepare("INSERT INTO images (image_path) VALUES (?)");
                $stmt->bind_param("s", $targetFilePath);

                $stmt->execute();
                $stmt->close();
            } else {
                echo "Error uploading $fileName.<br>";
            }
        } else {
            echo "Only JPG, JPEG, PNG, & GIF files are allowed for $fileName.<br>";
        }
    }
}

$images = [];
$result = $conn->query("SELECT image_path FROM images ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
    $images[] = $row['image_path'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery</title>
    <link rel="stylesheet" href="gallery.css">
    <script>
        function previewImages(event) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = "";

            Array.from(event.target.files).forEach(file => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement("img");
                    img.src = e.target.result;
                    img.style.maxWidth = "150px";
                    img.style.margin = "5px";
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    </script>
</head>
<body>
    <div class="header">
        <img class="logo" src="home/logo.png" alt="logo">
        <div class="head">
               <button class="menu-toggle">☰ Menu</button>
            <ul class="menu nav-links">
                <a href="index.php"><li>Home</li></a>
                <a href="car-directory.php"><li>Directory</li></a>
                <a href="gallery.php"><li>Gallery</li></a>
                <a href="blog.php"><li>Blog</li></a>
            <?php if (isset($_SESSION['email'])): ?>
            <?php if ($_SESSION['role'] === 'admin'): ?>
            <li><a href="admin_page.php">Admin Dashboard</a></li>
            <?php else: ?>
            <li><a href="user_page.php">User Dashboard</a></li>
           <?php endif; ?>
           <li><a href="logout.php">Logout</a></li>
           <?php else: ?>
           <li><a href="login.php">Login</a></li>
            <?php endif; ?>

            </ul>
        </div>
    </div>


<h2 style="text-align: center; font-size: 3em;">Gallery</h2>
<div class="gallery">
    <?php foreach ($images as $image): ?>
        <img src="<?php echo htmlspecialchars($image); ?>" alt="Uploaded Image">
    <?php endforeach; ?>
</div>

<?php if (isset($_SESSION['email'])): ?>
<h2 style="text-align: center;">Upload your Story</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload[]" multiple onchange="previewImages(event)" required>
    <br><br>
    <div id="imagePreviewContainer" style="display: flex; flex-wrap: wrap;"></div>
    <br>
    <button type="submit">Upload</button>
</form>
<?php else: ?>
<p style="text-align: center; margin-top: 20px;">You must be logged in to upload images.</p>
<?php endif; ?>

<footer class="footer">
    <div class="links">
        <a href="#">Home</a>
        <a href="#">Vintage Cars</a>
        <a href="#">Community</a>
        <a href="#">Contact</a>
    </div>
    <p>&copy; 2025 Vintage Car Blog. All rights reserved.</p>
</footer>
<script src="gallery.js"></script>
</body>
</html>
