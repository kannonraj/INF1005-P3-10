<?php
session_start();
require_once "db/db.php";

// ✅ Redirect if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// ✅ Check if car_id is passed
if (!isset($_GET["car_id"])) {
    echo "No car selected.";
    exit();
}

$car_id = intval($_GET["car_id"]);
$conn = connectToDatabase();

// ✅ Fetch car info
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "Car does not exist.";
    exit();
}
$car = $result->fetch_assoc();
$stmt->close();

// ✅ Check if car is currently booked
$check = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE car_id = ? AND status = 'active'");
$check->bind_param("i", $car_id);
$check->execute();
$check->bind_result($active);
$check->fetch();
$check->close();
$conn->close();

if ($active > 0) {
    echo "<h3>This car is currently booked and unavailable.</h3>";
    echo "<a href='car-listings.php'>Return to Listings</a>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book Car | PEAK</title>
    <?php include "inc/head.inc.php"; ?>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>

    <div class="container" style="max-width: 600px; margin: 50px auto;">
        <h2>Book <?= htmlspecialchars($car["brand"]) . " " . htmlspecialchars($car["model"]) ?> (<?= $car["year"] ?>)
        </h2>

        <?php if (!empty($car['image'])): ?>
            <img src="images/<?= htmlspecialchars($car['image']) ?>" alt="Car Image" class="img-fluid"
                style="max-width: 100%; margin-bottom: 20px;">
        <?php endif; ?>

        <form action="process_booking.php" method="post">
            <input type="hidden" name="car_id" value="<?= $car_id ?>">

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" required class="form-control"
                    min="<?= date('Y-m-d') ?>">
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" required class="form-control"
                    min="<?= date('Y-m-d') ?>">
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Confirm Booking</button>
        </form>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>