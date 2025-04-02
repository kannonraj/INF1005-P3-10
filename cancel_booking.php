<?php
session_start();
require_once "db/db.php";
require_once "send_email.php";
require_once "generate_cancellation_pdf.php";

// Require login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["booking_id"])) {
    $booking_id = intval($_POST["booking_id"]);
    $user_email = $_SESSION["user_email"];
    $fname = $_SESSION["fname"];

    $conn = connectToDatabase();

    // Get user ID
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Check if booking belongs to user and is active
    $stmt = $conn->prepare("SELECT car_id, start_date, end_date FROM bookings WHERE id = ? AND user_id = ? AND status = 'active'");
    $stmt->bind_param("ii", $booking_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($car_id, $start_date, $end_date);
        $stmt->fetch();
        $stmt->close();

        // ✅ Get car brand + model
        $stmt_car = $conn->prepare("SELECT brand, model FROM cars WHERE id = ?");
        $stmt_car->bind_param("i", $car_id);
        $stmt_car->execute();
        $stmt_car->bind_result($brand, $model);
        $stmt_car->fetch();
        $stmt_car->close();

        $car_display_name = "$brand $model";

        // Update booking status
        $update = $conn->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = ?");
        $update->bind_param("i", $booking_id);
        $update->execute();
        $update->close();

        // Update payment status
        $update_payment = $conn->prepare("UPDATE payments SET status = 'failed' WHERE booking_id = ?");
        $update_payment->bind_param("i", $booking_id);
        $update_payment->execute();
        $update_payment->close();

        // ✅ Generate PDF
        $pdfPath = generateCancellationPDF($fname, $car_display_name, $start_date, $end_date, $booking_id);

        // ✅ Send Email
        $subject = "Cancellation Confirmation - PEAK Car Rental";
        $body = "
            <h2>Hi $fname,</h2>
            <p>Your booking has been successfully cancelled.</p>
            <p>We’ve attached a cancellation confirmation PDF below for your records.</p>
            <p><strong>Car:</strong> $car_display_name<br>
               <strong>Booking ID:</strong> $booking_id<br>
               <strong>Start Date:</strong> $start_date<br>
               <strong>End Date:</strong> $end_date</p>
            <br>
            <p>We hope to serve you again soon!<br>— PEAK Car Rental Team</p>
        ";
        sendEmail($user_email, $subject, $body, $pdfPath);

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