<?php
session_start();
require_once("config.php");

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $email = $_SESSION['email'];

    $stmt = $conn->prepare("UPDATE users SET name = ? WHERE email = ?");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();

    $_SESSION['name'] = $name;
}
header("Location: user_page.php");
exit();
?>