<?php
require_once 'db/db.php';
$conn = connectToDatabase();

// Fetch available cars (i.e., cars NOT in active bookings)
$query = "
    SELECT * FROM cars 
    WHERE id NOT IN (SELECT car_id FROM bookings WHERE status = 'active')
    ORDER BY brand, model
";
$result = $conn->query($query);
$cars = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Available Cars | PEAK</title>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Available Cars</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($cars as $car): ?>
                <div class="col">
                    <div class="card h-100">
                    <?php if (!empty($car['image'])): ?>
    <div class="image-container" style="position: relative; width: 100%; height: 0; padding-top: 50%; background-image: url('images/<?= $car['image'] ?>'); background-size: cover; background-position: center;">
    </div>
<?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= $car['brand'] ?>     <?= $car['model'] ?> (<?= $car['year'] ?>)</h5>
                            <p class="card-text">Price: $<?= number_format($car['price_per_day'], 2) ?> / day</p>
                            <a href="car-details.php?id=<?= $car['id'] ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>