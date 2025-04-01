<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Handle cancel booking
if (isset($_GET['cancel'])) {
    $bookingId = intval($_GET['cancel']);
    $stmt = $conn->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE payments SET status = 'failed' WHERE booking_id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();

    header("Location: manage-bookings.php");
    exit();
}

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Count total bookings
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM bookings");
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch paginated bookings
$stmt = $conn->prepare("
    SELECT b.id, b.user_id, b.car_id, b.start_date, b.end_date, b.created_at,
           b.status AS booking_status,
           p.status AS payment_status,
           c.brand, c.model, u.email
    FROM bookings b
    JOIN cars c ON b.car_id = c.id
    JOIN users u ON b.user_id = u.id
    LEFT JOIN payments p ON b.id = p.booking_id
    ORDER BY b.created_at DESC
    LIMIT ? OFFSET ?
");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Manage Bookings</title>
    <style>
        table td,
        table th {
            vertical-align: middle !important;
        }

        .wide-container {
            width: 100%;
            max-width: 95vw;
            margin-left: auto;
            margin-right: auto;
        }

        .table th,
        .table td {
            white-space: nowrap;
        }

        .table thead th {
            font-size: 15px;
        }

        .table td {
            font-size: 14px;
        }

        .pagination {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <?php include '../inc/admin.panel.inc.php'; ?>

        <div class="container-fluid py-5 wide-container">
            <h2 class="mb-4">Manage Bookings</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>User Email</th>
                            <th>Car</th>
                            <th>Start - End</th>
                            <th>Booked On</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['brand'] . ' ' . $row['model']) ?></td>
                                <td><?= $row['start_date'] ?> - <?= $row['end_date'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td>
                                    <?= $row['booking_status'] === 'cancelled'
                                        ? '<span class="badge bg-danger">Cancelled</span>'
                                        : '<span class="badge bg-success">Active</span>' ?>
                                </td>
                                <td>
                                    <?php
                                    if ($row['payment_status'] === 'completed') {
                                        echo '<span class="badge bg-success">Paid</span>';
                                    } elseif ($row['payment_status'] === 'failed') {
                                        echo '<span class="badge bg-danger">Failed</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">Pending</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($row['booking_status'] === 'active'): ?>
                                        <a href="?cancel=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Cancel this booking?')">Cancel</a>
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</body>

</html>