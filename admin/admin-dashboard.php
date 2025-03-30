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
<?php include '../inc/admin.head.inc.php'; ?>
<title>Admin Dashboard</title>
</head>

<body>
    <div class="d-flex">
      <?php include '../inc/admin.panel.inc.php'; ?>
       

<<<<<<< Updated upstream
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
=======
        <!-- Main Content -->
        <div class="container-fluid py-5 px-4">
            <h2 class="mb-4">Admin Dashboard</h2>
>>>>>>> Stashed changes

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
                            <h5 class="card-title mt-2">Total Bookings</h5>
                            <p class="card-text fs-4"><?= $totalBookings ?></p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="manage-users.php" class="card dashboard-card bg-info text-white h-100">
                        <div class="card-body">
                            <i class="fas fa-user"></i>
                            <h5 class="card-title mt-2">Users</h5>
                            <p class="card-text fs-5">Total: <?= $totalUsers ?><br>Admins: <?= $totalAdmins ?><br>Customers: <?= $totalCustomers ?></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
