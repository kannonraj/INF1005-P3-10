<?php
session_start();
require_once "db/db.php";

// Require login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["booking_id"])) {
    $booking_id = intval($_POST["booking_id"]);
    $user_email = $_SESSION["user_email"];

    $conn = connectToDatabase();

    // Get user ID from email
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Check if the booking belongs to the logged-in user and is still active
    $stmt = $conn->prepare("SELECT id FROM bookings WHERE id = ? AND user_id = ? AND status = 'active'");
    $stmt->bind_param("ii", $booking_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->close();

        // Update booking status to cancelled
        $update = $conn->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = ?");
        $update->bind_param("i", $booking_id);
        $update->execute();
        $update->close();

        // Update payment status to failed
        $update_payment = $conn->prepare("UPDATE payments SET status = 'failed' WHERE booking_id = ?");
        $update_payment->bind_param("i", $booking_id);
        $update_payment->execute();
        $update_payment->close();

        $conn->close();
        header("Location: account.php?cancel=success");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        echo "Invalid booking or already cancelled.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>