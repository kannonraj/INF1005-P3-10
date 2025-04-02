<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Total cars
$totalCars = $conn->query("SELECT COUNT(*) AS total FROM cars")->fetch_assoc()['total'];

// Active bookings
$activeBookings = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE status = 'active'")->fetch_assoc()['total'];

// Calculate available cars (cars with no active booking)
$availableQuery = "
    SELECT COUNT(*) AS total
    FROM cars
    WHERE id NOT IN (
        SELECT car_id FROM bookings WHERE status = 'active'
    )
";
$availableCars = $conn->query($availableQuery)->fetch_assoc()['total'];

// Total users
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

// Total admins
$totalAdmins = $conn->query("SELECT COUNT(*) AS total FROM admins")->fetch_assoc()['total'];

$totalCustomers = $totalUsers;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="d-flex">
        <?php include '../inc/admin.panel.inc.php'; ?>

        <div class="container-fluid py-5 px-4">
            <h2 class="mb-4">Admin Dashboard</h2>

            <div class="row g-3">
                <div class="col-md-3">
                    <a href="manage-cars.php" class="card dashboard-card bg-primary text-white h-100">
                        <div class="card-body">
                            <i class="fas fa-car"></i>
                            <h5 class="card-title mt-2">Total Cars</h5>
                            <p class="card-text fs-4"><?= $totalCars ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-cars.php" class="card dashboard-card bg-success text-white h-100">
                        <div class="card-body">
                            <i class="fas fa-car-side"></i>
                            <h5 class="card-title mt-2">Available Cars</h5>
                            <p class="card-text fs-4"><?= $availableCars ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-bookings.php" class="card dashboard-card bg-warning text-white h-100">
                        <div class="card-body">
                            <i class="fas fa-clipboard-list"></i>
                            <h5 class="card-title mt-2">Active Bookings</h5>
                            <p class="card-text fs-4"><?= $activeBookings ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-users.php" class="card dashboard-card bg-info text-white h-100">
                        <div class="card-body">
                            <i class="fas fa-user"></i>
                            <h5 class="card-title mt-2">Users</h5>
                            <p class="card-text fs-5">Total: <?= $totalUsers ?><br>Admins:
                                <?= $totalAdmins ?><br>Customers: <?= $totalCustomers ?>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                <a href="manage-submissions.php" class="card dashboard-card bg-danger text-white h-100">
                    <div class="card-body">
                        <i class="fas fa-envelope"></i>
                        <h5 class="card-title mt-2">Contact Submissions</h5>
                        <p class="card-text fs-4">
                            <?php
                            $contactSubmissions = $conn->query("SELECT COUNT(*) AS total FROM contact_submissions")->fetch_assoc()['total'];
                            echo $contactSubmissions;
                            ?>
                        </p>
                    </div>
                </a>
            </div>
            </div>
        </div>
    </div>
</body>

</html>