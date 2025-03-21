<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

require_once "db/db.php";
$conn = connectToDatabase();

$email = $_SESSION["user_email"];

// Get user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

// Get bookings and payment info
$stmt = $conn->prepare("
    SELECT b.id, b.start_date, b.end_date, b.status, c.brand, c.model, c.year, p.amount, p.status AS payment_status
    FROM bookings b
    JOIN cars c ON b.car_id = c.id
    LEFT JOIN payments p ON b.id = p.booking_id
    WHERE b.user_id = ?
    ORDER BY b.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Account | PEAK</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .auth-btn-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .auth-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            text-decoration: none;
            color: white;
        }

        .login-btn {
            background-color: #1E88E5;
        }

        .login-btn:hover {
            background-color: #1565C0;
        }

        .main-content {
            text-align: center;
            padding: 50px 20px;
        }

        .user-details {
            margin-top: 15px;
            font-size: 18px;
        }

        .booking-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px auto;
            max-width: 600px;
            background: #f9f9f9;
            text-align: left;
            border-radius: 10px;
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

        <div class="user-details">
            <p>Email: <?= htmlspecialchars($_SESSION["user_email"]); ?></p>
        </div>

        <div class="auth-btn-container">
            <a href="logout.php" class="auth-btn login-btn">
                <span class="material-icons">logout</span> LOGOUT
            </a>
        </div>

        <h2>Your Bookings</h2>

        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='booking-box'>";
                    echo "<strong>Car:</strong> " . htmlspecialchars($row['brand']) . " " . htmlspecialchars($row['model']) . " (" . $row['year'] . ")<br>";
                    echo "<strong>From:</strong> " . $row['start_date'] . " to " . $row['end_date'] . "<br>";
                    echo "<strong>Status:</strong> " . ucfirst($row['status']) . "<br>";
                    echo "<strong>Payment:</strong> $" . number_format($row['amount'], 2) . " (" . $row['payment_status'] . ")<br>";

                    if ($row['status'] === 'active') {
                        echo "<form action='cancel_booking.php' method='post' style='margin-top:10px;'>
                                <input type='hidden' name='booking_id' value='{$row['id']}'>
                                <button type='submit' class='cancel-btn'>Cancel Booking</button>
                              </form>";
                    }

                    echo "</div>";
                }
            } else {
                echo "<p>You have no bookings yet.</p>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>
</html>
