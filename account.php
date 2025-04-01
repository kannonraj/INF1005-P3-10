<?php
session_start();
require_once "db/db.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

$conn = connectToDatabase();
$user_email = $_SESSION["user_email"];

// Get user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

// Fetch bookings & payments
$stmt = $conn->prepare("
    SELECT b.*, c.brand, c.model, c.year, p.id AS payment_id, p.amount, p.status AS payment_status
    FROM bookings b
    JOIN cars c ON b.car_id = c.id
    LEFT JOIN payments p ON b.id = p.booking_id
    WHERE b.user_id = ?
    ORDER BY b.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Account | PEAK</title>
    <style>
        .main-content {
            padding: 50px 20px;
            text-align: center;
        }

        .booking-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px auto;
            max-width: 600px;
            background: white;
            border-radius: 10px;
            text-align: left;
            color: black;
        }

        .payment-status.completed {
            color: green;
            font-weight: bold;
        }

        .payment-status.failed {
            color: red;
            font-weight: bold;
        }

        .payment-status.pending {
            color: orange;
            font-weight: bold;
        }

        .cancel-btn {
            background-color: red;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .cancel-btn:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>

    <div class="main-content">
        <h1>Welcome back, <?= htmlspecialchars($_SESSION["user_name"]); ?>!</h1>
        <p>Email: <?= htmlspecialchars($_SESSION["user_email"]); ?></p>
        <a href="logout.php" class="btn btn-primary">Logout</a>

        <h2 style="margin-top: 40px;">Active Bookings</h2>
        <?php
        $hasActive = false;
        foreach ($bookings as $row):
            if ($row['status'] === 'active'):
                $hasActive = true;
                ?>
                <div class="booking-box">
                    <p><strong>Booking ID:</strong> <?= $row['id'] ?></p>
                    <p><strong>Car:</strong> <?= htmlspecialchars($row['brand']) ?>         <?= htmlspecialchars($row['model']) ?>
                        (<?= $row['year'] ?>)</p>
                    <p><strong>From:</strong> <?= $row['start_date'] ?> to <?= $row['end_date'] ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($row['status']) ?></p>
                    <?php if (!empty($row['payment_id'])): ?>
                        <?php
                        $statusClass = strtolower($row['payment_status']);
                        $formattedAmount = number_format($row['amount'], 2);
                        ?>
                        <p><strong>Payment:</strong> $<?= $formattedAmount ?>
                            <span class="payment-status <?= $statusClass ?>">(<?= ucfirst($row['payment_status']) ?>)</span>
                        </p>
                        <?php if ($row['payment_status'] === 'pending'): ?>
                            <form action="process_payment.php" method="post">
                                <input type="hidden" name="payment_id" value="<?= $row['payment_id'] ?>">
                                <label>Payment Method:</label>
                                <select name="method" required>
                                    <option value="credit">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                                <button type="submit">Pay Now</button>
                            </form>
                        <?php endif; ?>
                    <?php else: ?>
                        <p><strong>Payment:</strong> <span class="text-muted">Not available</span></p>
                    <?php endif; ?>

                    <form action="cancel_booking.php" method="post">
                        <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="cancel-btn">Cancel Booking</button>
                    </form>
                </div>
                <?php
            endif;
        endforeach;
        if (!$hasActive) {
            echo "<p>You have no active bookings.</p>";
        }
        ?>

        <h2 style="margin-top: 40px;">Booking History</h2>
        <?php
        $hasHistory = false;
        foreach ($bookings as $row):
            if ($row['status'] !== 'active'):
                $hasHistory = true;
                ?>
                <div class="booking-box">
                    <p><strong>Booking ID:</strong> <?= $row['id'] ?></p>
                    <p><strong>Car:</strong> <?= htmlspecialchars($row['brand']) ?>         <?= htmlspecialchars($row['model']) ?>
                        (<?= $row['year'] ?>)</p>
                    <p><strong>From:</strong> <?= $row['start_date'] ?> to <?= $row['end_date'] ?></p>
                    <p><strong>Status:</strong> <?= ucfirst($row['status']) ?></p>
                    <?php if (!empty($row['payment_id'])): ?>
                        <?php
                        $statusClass = strtolower($row['payment_status']);
                        $formattedAmount = number_format($row['amount'], 2);
                        ?>
                        <p><strong>Payment:</strong> $<?= $formattedAmount ?>
                            <span class="payment-status <?= $statusClass ?>">(<?= ucfirst($row['payment_status']) ?>)</span>
                        </p>
                    <?php else: ?>
                        <p><strong>Payment:</strong> <span class="text-muted">Not available</span></p>
                    <?php endif; ?>
                </div>
                <?php
            endif;
        endforeach;
        if (!$hasHistory) {
            echo "<p>No past bookings found.</p>";
        }
        ?>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>