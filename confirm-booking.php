<?php
$title = "Booking Confirmation";
include 'inc/head.inc.php';
include 'inc/nav.inc.php';
echo '<link rel="stylesheet" href="styles/booking.css">'; // Ensure CSS is linked

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car = htmlspecialchars($_POST["car"] ?? "Unknown Car");
    $price = htmlspecialchars($_POST["price"] ?? "$0/day");
    $startDate = htmlspecialchars($_POST["start-date"] ?? "Not specified");
    $endDate = htmlspecialchars($_POST["end-date"] ?? "Not specified");
    $totalPrice = isset($_POST['total-price']) && $_POST['total-price'] !== "" ? htmlspecialchars($_POST['total-price']) : "Not calculated";
    
    echo "<div class='container'>";
    echo "<h1>Booking Confirmed</h1>";
    echo "<p>You have booked: <strong>$car</strong></p>";
    echo "<p>Start Date: $startDate</p>";
    echo "<p>End Date: $endDate</p>";
    echo "<h3>Total Price: <strong>$totalPrice</strong></h3>";
    echo "<a href='index.php' class='btn btn-primary back-home-btn'>Back to Home</a>";
    echo "</div>";
} else {
    header("Location: index.php");
    exit();
}
?>
