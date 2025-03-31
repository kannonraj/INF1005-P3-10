<?php
session_start();
require_once "db/db.php";

if (!isset($_GET['car_id'])) {
    echo "No car selected.";
    exit;
}

$car_id = intval($_GET['car_id']);
$conn = connectToDatabase();

// ✅ Fetch car details regardless of status
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Car not found.";
    exit;
}

$car = $result->fetch_assoc();
$stmt->close();

// ✅ Check if this car has an active booking
$active_stmt = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE car_id = ? AND status = 'active'");
$active_stmt->bind_param("i", $car_id);
$active_stmt->execute();
$active_stmt->bind_result($activeBooking);
$active_stmt->fetch();
$active_stmt->close();
$isAvailable = $activeBooking == 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title><?= htmlspecialchars($car['brand'] . " " . $car['model']) ?> | PEAK</title>
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .button-container {
            margin-top: 30px;
            margin-left: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .car-box {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 12px;
            background: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Arial', sans-serif;
        }

        .car-box img {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .car-box h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .price {
            font-size: 1.6rem;
            color: #0d6efd;
            font-weight: 600;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            color: white;
            padding: 12px 24px;
            font-size: 1.1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            display: inline-block;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .car-details {
            margin-top: 20px;
        }

        .car-details p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
        }

        .review-box {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
        }

        .h2custom {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .pagination a {
            text-decoration: none;
            padding: 8px 16px;
            margin-right: 8px;
            border-radius: 5px;
            background-color: #f0f0f0;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>

    <div class="button-container">
        <a href="car-listings.php" class="back-button">Back to View</a>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="car-box">
                <h2 class="h2custom"><?= htmlspecialchars($car['brand']) . " " . htmlspecialchars($car['model']) ?>
                    (<?= $car['year'] ?>)</h2>
                <img src="images/<?= htmlspecialchars($car['image']) ?>" alt="Car Image">
                <div class="car-details">
                    <p><strong>Price:</strong> <span class="price">$<?= number_format($car['price_per_day'], 2) ?> /
                            day</span></p>
                    <p><strong>Category:</strong> <?= htmlspecialchars($car['category']) ?></p>
                    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($car['description'])) ?></p>
                </div>

                <?php if ($isAvailable): ?>
                    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                        <form action="book_car.php" method="get" style="margin-top: 20px;">
                            <input type="hidden" name="car_id" value="<?= $car_id ?>">
                            <button type="submit" class="btn-primary">Book This Car</button>
                        </form>
                    <?php else: ?>
                        <p><a href="login.php" class="btn-primary">Sign in now to reserve this car!</a></p>
                    <?php endif; ?>
                <?php else: ?>
                    <p class="text-danger mt-3"><strong>This car is currently booked and unavailable.</strong></p>
                <?php endif; ?>
            </div>

            <!-- Reviews -->
            <div class="review-box">
                <?php include "reviews_section.php"; ?>
            </div>
        </div>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>