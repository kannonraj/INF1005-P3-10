<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Handle cancel booking via GET
if (isset($_GET['cancel'])) {
    $bookingId = intval($_GET['cancel']);
    $stmt = $conn->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();

    // Also mark payment as failed
    $stmt = $conn->prepare("UPDATE payments SET status = 'failed' WHERE booking_id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();

    header("Location: manage-bookings.php");
    exit();
}

// Fetch all bookings with car, user, and payment info
$sql = "SELECT b.id, b.user_id, b.car_id, b.start_date, b.end_date, b.created_at,
               b.status AS booking_status,
               p.status AS payment_status,
               c.brand, c.model, u.email
        FROM bookings b
        JOIN cars c ON b.car_id = c.id
        JOIN users u ON b.user_id = u.id
        LEFT JOIN payments p ON b.id = p.booking_id
        ORDER BY b.created_at DESC";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Manage Bookings</title>
</head>

<body class="bg-light">
    <div class="d-flex">
        <!-- Admin Panel (Include) -->
        <?php include '../inc/admin.panel.inc.php'; ?>

        <!-- Main Content -->
        <div class="container py-5">
            <!-- Back Button -->
            <div class="position-absolute top-0 end-0 mt-3 me-3">
                <a href="admin-dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
            </div>

            <h2 class="mb-4">Manage Bookings</h2>

            <!-- Booking Cards -->
            <div class="row g-3">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['brand'] . ' ' . $row['model']) ?></h5>
                                <p class="card-text"><strong>User Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                                <p class="card-text"><strong>Start Date:</strong> <?= $row['start_date'] ?></p>
                                <p class="card-text"><strong>End Date:</strong> <?= $row['end_date'] ?></p>
                                <p class="card-text"><strong>Booked On:</strong> <?= $row['created_at'] ?></p>

                                <p>
                                    <strong>Status:</strong>
                                    <?= $row['booking_status'] === 'cancelled' ? '<span class="badge bg-danger">Cancelled</span>' : '<span class="badge bg-success">Active</span>' ?>
                                </p>
                                <p>
                                    <strong>Payment Status:</strong>
                                    <?php
                                    if ($row['payment_status'] === 'completed') {
                                        echo '<span class="badge bg-success">Paid</span>';
                                    } elseif ($row['payment_status'] === 'failed') {
                                        echo '<span class="badge bg-danger">Failed</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">Pending</span>';
                                    }
                                    ?>
                                </p>

                                <?php if ($row['booking_status'] === 'active'): ?>
                                    <a href="manage-bookings.php?cancel=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">Cancel Booking</a>
                                <?php else: ?>
                                    <span class="text-muted">N/A</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>

</html>