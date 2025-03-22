<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Account | PEAK</title>

    <!-- Google Material Icons & Roboto Font -->
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
            <a href="logout.php" class="auth-btn login-btn" aria-label="Log out of your account">
                <span class="material-icons">logout</span> LOGOUT
            </a>
        </div>

        <div class="container">
            <!-- Future features: Booking history, Profile settings, etc. -->
        </div>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
