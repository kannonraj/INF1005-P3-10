<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Total cars
$totalCars = $conn->query("SELECT COUNT(*) AS total FROM cars")->fetch_assoc()['total'];

// Active bookings
$activeBookings = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE status = 'active'")->fetch_assoc()['total'];

// Available cars
$availableQuery = "
    SELECT COUNT(*) AS total
    FROM cars
    WHERE id NOT IN (
        SELECT car_id FROM bookings WHERE status = 'active'
    )
";
$availableCars = $conn->query($availableQuery)->fetch_assoc()['total'];

// Total users and admins
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalAdmins = $conn->query("SELECT COUNT(*) AS total FROM admins")->fetch_assoc()['total'];
$totalCustomers = $totalUsers;
$contactSubmissions = $conn->query("SELECT COUNT(*) AS total FROM contact_submissions")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Admin Dashboard</title>
    <style>
        .dashboard-card .card-title,
        .dashboard-card .card-text {
            color: #000;
        }

        .bg-warning .card-title,
        .bg-warning .card-text,
        .bg-info .card-title,
        .bg-info .card-text {
            color: #000 !important;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <aside aria-label="Admin navigation">
            <?php include '../inc/admin.panel.inc.php'; ?>
        </aside>

        <main class="container-fluid py-5 px-4">
            <h1 class="visually-hidden">Admin Dashboard Overview</h1>
            <h2 class="mb-4">Admin Dashboard</h2>

            <div class="row g-3">
                <div class="col-md-3">
                    <a href="manage-cars.php" class="card dashboard-card text-white h-100"
                        style="background-color: #0d6efd;">
                        <div class="card-body">
                            <i class="fas fa-car"></i>
                            <h3 class="card-title mt-2">Total Cars</h3>
                            <p class="card-text fs-4"><?= $totalCars ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-cars.php" class="card dashboard-card text-white h-100"
                        style="background-color: #198754;">
                        <div class="card-body">
                            <i class="fas fa-car-side"></i>
                            <h3 class="card-title mt-2">Available Cars</h3>
                            <p class="card-text fs-4"><?= $availableCars ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-bookings.php" class="card dashboard-card h-100" style="background-color: #ffc107;">
                        <div class="card-body">
                            <i class="fas fa-clipboard-list"></i>
                            <h3 class="card-title mt-2">Active Bookings</h3>
                            <p class="card-text fs-4"><?= $activeBookings ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-users.php" class="card dashboard-card h-100" style="background-color: #0dcaf0;">
                        <div class="card-body">
                            <i class="fas fa-user"></i>
                            <h3 class="card-title mt-2">Users</h3>
                            <p class="card-text fs-5">Total: <?= $totalUsers ?><br>Admins:
                                <?= $totalAdmins ?><br>Customers: <?= $totalCustomers ?>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-submissions.php" class="card dashboard-card text-white h-100"
                        style="background-color: #dc3545;">
                        <div class="card-body">
                            <i class="fas fa-envelope"></i>
                            <h3 class="card-title mt-2">Contact Submissions</h3>
                            <p class="card-text fs-4"><?= $contactSubmissions ?></p>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>