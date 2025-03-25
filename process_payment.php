<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "db/db.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// ✅ Basic input check
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["payment_id"]) || !isset($_POST["method"])) {
    echo "Invalid access.";
    exit();
}

$payment_id = intval($_POST["payment_id"]);
$method = htmlspecialchars($_POST["method"]);

$conn = connectToDatabase();

// ✅ Confirm payment record exists and belongs to this user
$stmt = $conn->prepare("
    SELECT p.id, p.status, b.user_id
    FROM payments p
    JOIN bookings b ON p.booking_id = b.id
    JOIN users u ON b.user_id = u.id
    WHERE p.id = ? AND u.email = ?
");
$stmt->bind_param("is", $payment_id, $_SESSION["user_email"]);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Payment not found or unauthorized access.";
    exit();
}

$data = $result->fetch_assoc();
$stmt->close();

//Simulate payment success
$new_status = (rand(0, 1) === 1) ? 'completed' : 'failed';

$update = $conn->prepare("UPDATE payments SET status = ?, payment_date = NOW() WHERE id = ?");
$update->bind_param("si", $new_status, $payment_id);
$update->execute();
$update->close();

$conn->close();

//Flash message and redirect
$_SESSION["message"] = "Payment was " . ($new_status === 'completed' ? "successful!" : "unsuccessful. Please try again.");
header("Location: account.php");
exit();
