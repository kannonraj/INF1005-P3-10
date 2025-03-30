<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase(); // ← ADD THIS LINE

// Handle cancel booking via GET
if (isset($_GET['cancel'])) {
    $bookingId = intval($_GET['cancel']);
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    header("Location: manage-bookings.php");
    exit();
}


// Fetch all bookings with car and user info
$sql = "SELECT b.id, b.user_id, b.car_id, b.start_date, b.end_date, b.created_at,
               c.brand, c.model, u.email
        FROM bookings b
        JOIN cars c ON b.car_id = c.id
        JOIN users u ON b.user_id = u.id
        ORDER BY b.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Manage Bookings</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Booking ID</th>
                    <th>User Email</th>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Booked On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['brand'] . ' ' . $row['model']) ?></td>
                        <td><?= $row['start_date'] ?></td>
                        <td><?= $row['end_date'] ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
                            <a href="manage-bookings.php?cancel=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Cancel this booking?')">Cancel</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <a href="admin-dashboard.php" class="btn btn-secondary mt-3">← Back to Dashboard</a>
    </div>
</body>

</html>