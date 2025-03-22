<?php
$title = "Car Listings";
include 'inc/head.inc.php';
include 'inc/nav.inc.php';
require_once "db/db.php";

$conn = connectToDatabase();

// Optional: Filter by category/brand/type if you implement it
$query = "SELECT * FROM cars WHERE status = 'available' ORDER BY brand, model";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Car Listings | PEAK</title>
    <link rel="stylesheet" href="css/cars.css"> <!-- Update path if needed -->
</head>
<body>
<div class="container">
    <h1>Available Cars</h1>
    <div class="car-list">
        <?php
        if ($result->num_rows > 0) {
            while ($car = $result->fetch_assoc()) {
                $car_id = $car['id'];
                $brand = htmlspecialchars($car['brand']);
                $model = htmlspecialchars($car['model']);
                $year = $car['year'];
                $price = number_format($car['price_per_day'], 2);
                echo "<div class='car-item'>";
                echo "<h3>$brand $model ($year)</h3>";
                echo "<p>Price: \$$price / day</p>";
                echo "<a href='book_car.php?car_id=$car_id' class='btn'>Book Now</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No available cars at the moment.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<?php include 'inc/footer.inc.php'; ?>
</body>
</html>