<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email";
        exit;
    }
    $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        echo "<script>alert('Thank you for subscribing!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Something went wrong'); window.location='index.php';</script>";
    }
    $stmt->close();
}
$conn->close();
?>
