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

// ✅ Fetch car from database
$conn = connectToDatabase();
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ? AND status = 'available'");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Car not available or does not exist.";
    exit();
}

$car = $result->fetch_assoc();
$stmt->close();
$conn->close();
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
    <h2>Book <?= htmlspecialchars($car["brand"]) . " " . htmlspecialchars($car["model"]) ?> (<?= $car["year"] ?>)</h2>

    <form action="process_booking.php" method="post">
        <input type="hidden" name="car_id" value="<?= $car_id ?>">

        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required class="form-control">
        </div>

        <div class="form-group" style="margin-top: 15px;">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Confirm Booking</button>
    </form>
</div>

<?php include "inc/footer.inc.php"; ?>
</body>
</html>
