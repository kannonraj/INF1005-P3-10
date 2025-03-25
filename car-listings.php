<?php
$title = "Car Listings";
include 'inc/head.inc.php'; // Include header
include 'inc/nav.inc.php'; // Include navigation


// Get category from URL, default to 'Sedan' if not set
$category = isset($_GET['category']) ? $_GET['category'] : 'Sedan';
$category = htmlspecialchars($category); // Prevent XSS attacks

// Define car listings based on category
$cars = [
    "Sedan" => [
        ["name" => "Toyota Camry", "price" => "$50/day", "image" => "images/camry.jpg"],
        ["name" => "Honda Accord", "price" => "$55/day", "image" => "images/accord.jpg"]
    ],
    "SUV" => [
        ["name" => "Toyota RAV4", "price" => "$65/day", "image" => "images/rav4.jpg"],
        ["name" => "Ford Explorer", "price" => "$80/day", "image" => "images/explorer.jpg"]
    ],
    "Hatchback" => [
        ["name" => "Volkswagen Golf", "price" => "$40/day", "image" => "images/golf.jpg"],
        ["name" => "Honda Fit", "price" => "$38/day", "image" => "images/fit.jpg"]
    ],
    "Convertible" => [
        ["name" => "Mazda MX-5", "price" => "$70/day", "image" => "images/mx5.jpg"],
        ["name" => "Ford Mustang", "price" => "$90/day", "image" => "images/mustang.jpg"]
    ],
    "Coupe" => [
        ["name" => "BMW 4 Series", "price" => "$85/day", "image" => "images/4series.jpg"],
        ["name" => "Audi A5", "price" => "$88/day", "image" => "images/a5.jpg"]
    ],
    "Truck" => [
        ["name" => "Ford F-150", "price" => "$100/day", "image" => "images/f150.jpg"],
        ["name" => "Chevrolet Silverado", "price" => "$110/day", "image" => "images/silverado.jpg"]
    ],
    "Minivan" => [
        ["name" => "Honda Odyssey", "price" => "$75/day", "image" => "images/odyssey.jpg"],
        ["name" => "Toyota Sienna", "price" => "$78/day", "image" => "images/sienna.jpg"]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $category; ?> Rentals | PEAK</title>
    <link rel="stylesheet" href="styles/cars.css"> <!-- Ensure CSS file for styling -->
</head>
<body>
    <div class="container">
        <h1><?php echo $category; ?> Rentals</h1>
        <div class="car-list">
            <?php
            if (array_key_exists($category, $cars)) {
                foreach ($cars[$category] as $car) {
                    echo "<div class='car-item'>";
                    echo "<img src='" . $car['image'] . "' alt='" . $car['name'] . "'>";
                    echo "<h3>" . $car['name'] . "</h3>";
                    echo "<p>Price: " . $car['price'] . "</p>";
                    echo "<a href='booking.php?car=" . urlencode($car['name']) . "&price=" . urlencode($car['price']) . "' class='btn btn-primary rent-now-btn'>Rent Now</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No cars available in this category.</p>";
            }
            ?>
        </div>
    </div>

    <?php include 'inc/footer.inc.php'; ?> <!-- Include footer -->
</body>
</html>


