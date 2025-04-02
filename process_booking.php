<?php
session_start();
require_once "db/db.php";
require_once "send_email.php";
require_once "generate_booking_pdf.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION["user_email"];
$fname = $_SESSION["fname"];
$car_id = intval($_POST["car_id"]);
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

if (!$car_id || !$start_date || !$end_date || $start_date > $end_date) {
    die("Invalid booking data.");
}

$conn = connectToDatabase();

// Get user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

// Check if user already has an active booking
$stmt = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE user_id = ? AND status = 'active'");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($active_count);
$stmt->fetch();
$stmt->close();

if ($active_count > 0) {
    $conn->close();
    echo "<h3>You already have an active booking.</h3>";
    echo "<a href='account.php'>Return to Account</a>";
    exit();
}

// Check for overlapping active bookings on this car
$stmt = $conn->prepare("
    SELECT COUNT(*) FROM bookings 
    WHERE car_id = ? AND status = 'active'
    AND (
        (start_date <= ? AND end_date >= ?) OR
        (start_date <= ? AND end_date >= ?) OR
        (start_date >= ? AND end_date <= ?)
    )
");
$stmt->bind_param("issssss", $car_id, $start_date, $start_date, $end_date, $end_date, $start_date, $end_date);
$stmt->execute();
$stmt->bind_result($overlap_count);
$stmt->fetch();
$stmt->close();

if ($overlap_count > 0) {
    $conn->close();
    echo "<h3>This car is already booked for the selected dates.</h3>";
    echo "<a href='car-listings.php'>Return to Car Listings</a>";
    exit();
}

// Get car name & price
$stmt = $conn->prepare("SELECT name, price_per_day FROM cars WHERE id = ?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$stmt->bind_result($car_name, $price_per_day);
$stmt->fetch();
$stmt->close();

// Calculate total price
$days = (strtotime($end_date) - strtotime($start_date)) / 86400 + 1;
$total_cost = $days * $price_per_day;

// Insert booking
$stmt = $conn->prepare("INSERT INTO bookings (user_id, car_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'active')");
$stmt->bind_param("iiss", $user_id, $car_id, $start_date, $end_date);

if ($stmt->execute()) {
    $booking_id = $stmt->insert_id;

    // Insert payment
    $stmt_payment = $conn->prepare("INSERT INTO payments (booking_id, amount, status) VALUES (?, ?, 'pending')");
    $stmt_payment->bind_param("id", $booking_id, $total_cost);
    $stmt_payment->execute();
    $stmt_payment->close();

    // ✅ Generate booking confirmation PDF
    $pdfPath = generateBookingPDF($fname, $car_name, $start_date, $end_date, $booking_id);

    // ✅ Send email with PDF
    $subject = "Booking Confirmation - PEAK Car Rental";
    $body = "
        <h2>Hi $fname,</h2>
        <p>Your booking with <strong>PEAK Car Rental</strong> has been successfully confirmed.</p>
        <p>We've attached your booking confirmation PDF below.</p>
        <p><strong>Car:</strong> $car_name<br>
           <strong>Booking ID:</strong> $booking_id<br>
           <strong>Start Date:</strong> $start_date<br>
           <strong>End Date:</strong> $end_date</p>
        <br>
        <p>Thanks for choosing us!<br>— PEAK Car Rental Team</p>
    ";
    sendEmail($user_email, $subject, $body, $pdfPath);

    $stmt->close();
    $conn->close();

    header("Location: account.php");
    exit();
} else {
    echo "Failed to book car: " . $stmt->error;
    $stmt->close();
    $conn->close();
}
?>
