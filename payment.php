<?php
session_start();
require_once "db/db.php";

// Check login
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Check booking ID
if (!isset($_GET["booking_id"])) {
    echo "Invalid request. Booking ID missing.";
    exit();
}

$booking_id = intval($_GET["booking_id"]);
$conn = connectToDatabase();

// Fetch booking/payment details
$stmt = $conn->prepare("
    SELECT b.id, b.user_id, b.car_id, b.start_date, b.end_date, b.status AS booking_status,
           p.id AS payment_id, p.amount, p.status AS payment_status
    FROM bookings b
    JOIN payments p ON b.id = p.booking_id
    WHERE b.id = ? AND b.user_id = (
        SELECT id FROM users WHERE email = ?
    )
");
$stmt->bind_param("is", $booking_id, $_SESSION["user_email"]);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Booking not found or you do not have permission.";
    exit();
}

$data = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Make Payment | PEAK</title>
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 25px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
        }

        button {
            background-color: #4CAF50;
            border: none;
            padding: 10px 16px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #388E3C;
        }
    </style>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>

    <div class="container">
        <h2>Make Payment</h2>
        <p><strong>Booking ID:</strong> <?= $data['id'] ?></p>
        <p><strong>Amount:</strong> $<?= number_format($data['amount'], 2) ?></p>

        <form action="process_payment.php" method="post">
            <input type="hidden" name="payment_id" value="<?= $data['payment_id'] ?>">

            <div class="form-group">
                <label for="method">Payment Method</label>
                <select name="method" id="method" required>
                    <option value="">-- Select Payment Method --</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="paynow">PayNow</option>
                </select>
            </div>

            <button type="submit">Simulate Payment</button>
        </form>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>