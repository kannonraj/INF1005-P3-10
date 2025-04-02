<?php
session_start();  
require_once 'db/db.php';
$conn = connectToDatabase();

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : null;

if ($categoryFilter) {
    $query = "
        SELECT * FROM cars 
        WHERE id NOT IN (SELECT car_id FROM bookings WHERE status = 'active')
        AND category = ?
        ORDER BY brand, model
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $categoryFilter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "
        SELECT * FROM cars 
        WHERE id NOT IN (SELECT car_id FROM bookings WHERE status = 'active')
        ORDER BY brand, model
    ";
    $result = $conn->query($query);
}

$cars = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Available Cars | PEAK</title>
    <style>
        .container {
            flex-grow: 1;
            padding-bottom: 10px;
        }

        /* Contrast fix for links if needed */
        a.contrast-fix {
            color: #004080; /* darker blue for better contrast */
        }

        a.contrast-fix:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>

    <!-- Main Landmark -->
    <main class="container mt-5">

        <!-- Level-One Heading -->
        <h1 class="visually-hidden">PEAK Car Listings</h1>

        <h2 class="text-center mb-4">
            <?php if ($categoryFilter): ?>
                <?= htmlspecialchars($categoryFilter) ?> Cars
            <?php else: ?>
                Available Cars
            <?php endif; ?>
        </h2>

        <?php if (count($cars) === 0): ?>
            <p class="text-center text-muted">No available cars
                found<?= $categoryFilter ? " in category '$categoryFilter'" : "" ?>.</p>
        <?php else: ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($cars as $car): ?>
                    <div class="col">
                        <div class="card h-100">
                            <?php if (!empty($car['image'])): ?>
                                <div class="image-container" style="position: relative; width: 100%; height: 0; padding-top: 50%; background-image: url('images/<?= $car['image'] ?>'); background-size: cover; background-position: center;">
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <!-- Fixed heading hierarchy: use h3 since h2 is above -->
                                <h3 class="card-title"><?= $car['brand'] ?> <?= $car['model'] ?> (<?= $car['year'] ?>)</h3>
                                <p class="card-text">Price: $<?= number_format($car['price_per_day'], 2) ?> / day</p>
                                <a href="car-details.php?car_id=<?= $car['id'] ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
