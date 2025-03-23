<?php
session_start();
require_once "db/db.php";

if (!isset($_GET['car_id'])) {
    echo "No car selected.";
    exit;
}

$car_id = intval($_GET['car_id']);
$conn = connectToDatabase();

// Fetch car info
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ? AND status = 'available'");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Car not found or unavailable.";
    exit;
}

$car = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title><?= htmlspecialchars($car['brand'] . " " . $car['model']) ?> | PEAK</title>
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
        }

        .car-box {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            background: #fff;
        }

        .car-box img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .review-box {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>
    <?php if (isset($_SESSION['message'])): ?>
        <div
            style="background: #d4edda; color: #155724; padding: 10px 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 20px auto; max-width: 800px;">
            <?= $_SESSION['message'];
            unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="car-box">
            <h2><?= htmlspecialchars($car['brand']) . " " . htmlspecialchars($car['model']) ?> (<?= $car['year'] ?>)
            </h2>
            <img src="images/<?= $car['image'] ?>" alt="Car Image">
            <p><strong>Price:</strong> $<?= number_format($car['price_per_day'], 2) ?> / day</p>
            <p><strong>Category:</strong> <?= $car['category'] ?></p>

            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                <form action="book_car.php" method="get" style="margin-top: 20px;">
                    <input type="hidden" name="car_id" value="<?= $car_id ?>">
                    <button type="submit" class="btn btn-primary">Book This Car</button>
                </form>
            <?php else: ?>
                <p><a href="login.php">Log in</a> to book this car.</p>
            <?php endif; ?>
        </div>

        <div class="review-box">
            <?php include "reviews_section.php"; ?>
        </div>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>