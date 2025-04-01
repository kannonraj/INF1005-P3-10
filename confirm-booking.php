<?php
$title = "Booking Confirmation";
include 'inc/head.inc.php';
include 'inc/nav.inc.php';
echo '<link rel="stylesheet" href="styles/booking.css">'; // Link your CSS file

// Check if this was accessed via form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $car = htmlspecialchars($_POST["car"] ?? "Unknown Car");
    $price = htmlspecialchars($_POST["price"] ?? "$0/day");
    $startDate = htmlspecialchars($_POST["start-date"] ?? "Not specified");
    $endDate = htmlspecialchars($_POST["end-date"] ?? "Not specified");
    $totalPrice = isset($_POST["total-price"]) && $_POST["total-price"] !== ""
        ? htmlspecialchars($_POST["total-price"])
        : "Not calculated";
    ?>

    <div class="container my-5 text-center">
        <h1 class="mb-4">✅ Booking Confirmed</h1>
        <p class="fs-5">You have successfully booked:</p>
        <h3 class="mb-3"><?= $car ?></h3>
        <p><strong>Start Date:</strong> <?= $startDate ?></p>
        <p><strong>End Date:</strong> <?= $endDate ?></p>
        <p><strong>Price per Day:</strong> <?= $price ?></p>
        <h4 class="mt-4">Total Price: <strong><?= $totalPrice ?></strong></h4>

        <a href="index.php" class="btn btn-primary mt-4">Back to Home</a>
    </div>

    <?php
} else {
    // Redirect if someone accesses the page directly
    header("Location: index.php");
    exit();
}

include 'inc/footer.inc.php';
?>