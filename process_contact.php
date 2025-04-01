<?php
require_once "db/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    if (!$name || !$email || !$phone || !$message) {
        die("Please fill in all fields.");
    }

    $conn = connectToDatabase();

    $stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: contact.php?status=success");
    exit();
} else {
    header("Location: contact.php");
    exit();
}
