<?php
session_start();
require_once "db/db.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION["user_email"];
$car_id = intval($_POST["car_id"]);
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

if (!$car_id || !$start_date || !$end_date || $start_date > $end_date) {
    die("Invalid booking data.");
}

$conn = connectToDatabase();

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

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

$stmt = $conn->prepare("SELECT price_per_day FROM cars WHERE id = ?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$stmt->bind_result($price_per_day);
$stmt->fetch();
$stmt->close();

$days = (strtotime($end_date) - strtotime($start_date)) / 86400 + 1;
$total_cost = $days * $price_per_day;

$stmt = $conn->prepare("INSERT INTO bookings (user_id, car_id, start_date, end_date, status) VALUES (?, ?, ?, ?, 'active')");
$stmt->bind_param("iiss", $user_id, $car_id, $start_date, $end_date);

if ($stmt->execute()) {
    $booking_id = $stmt->insert_id;

    $stmt_payment = $conn->prepare("INSERT INTO payments (booking_id, amount, status) VALUES (?, ?, 'pending')");
    $stmt_payment->bind_param("id", $booking_id, $total_cost);
    $stmt_payment->execute();
    $stmt_payment->close();

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