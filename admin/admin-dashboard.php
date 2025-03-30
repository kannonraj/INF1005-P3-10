<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Get stats
$totalCars = $conn->query("SELECT COUNT(*) AS total FROM cars")->fetch_assoc()['total'];
$availableCars = $conn->query("SELECT COUNT(*) AS total FROM cars WHERE status = 'available'")->fetch_assoc()['total'];
$totalBookings = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE status = 'active'")->fetch_assoc()['total'];
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalAdmins = $conn->query("SELECT COUNT(*) AS total FROM admins")->fetch_assoc()['total'];
$totalCustomers = $totalUsers;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Cars</h5>
                        <p class="card-text fs-4"><?= $totalCars ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Available Cars</h5>
                        <p class="card-text fs-4"><?= $availableCars ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Bookings</h5>
                        <p class="card-text fs-4"><?= $totalBookings ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text fs-5">Total: <?= $totalUsers ?><br>Admins: <?= $totalAdmins ?><br>Customers:
                            <?= $totalCustomers ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h4>Admin Navigation</h4>
        <div class="list-group">
            <a href="manage-cars.php" class="list-group-item list-group-item-action">Manage Cars</a>
            <a href="manage-bookings.php" class="list-group-item list-group-item-action">Manage Bookings</a>
            <a href="manage-users.php" class="list-group-item list-group-item-action">Manage Users</a>
            <a href="logout.php" class="list-group-item list-group-item-action text-danger">Logout</a>
        </div>
    </div>
</body>

</html>