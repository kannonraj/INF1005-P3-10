<?php
// Connect to the database
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    // Simple validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Insert into DB
        $sql = "INSERT INTO contact_submissions (name, email, phone, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $phone, $message);

        if ($stmt->execute()) {
            // Optional: Flash message (requires session)
            echo "<script>alert('Message submitted successfully!'); window.location.href='contact.php';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Please fill in all required fields.'); history.back();</script>";
    }

    $conn->close();
} else {
    // If not POST, redirect
    header("Location: contact.php?status=success");
    exit;    
}
?>
