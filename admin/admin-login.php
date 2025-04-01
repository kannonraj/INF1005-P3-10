<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../db/db.php';

if (isset($_SESSION['admin_id'])) {
    header("Location: admin-dashboard.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = connectToDatabase();
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../inc/head.inc.php"; ?>
    <title>Admin Login | PEAK</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 480px;
            background: white;
            color: black;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .login-wrapper h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-control {
            margin-bottom: 20px;
            padding: 12px;
            font-size: 16px;
        }

        .btn-block {
            width: 100%;
            padding: 12px;
            font-size: 16px;
        }

        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include "../inc/nav.inc.php"; ?>

    <main>
        <div class="login-wrapper">
            <h2>Admin Login</h2>

            <?php if ($error): ?>
                <p class="error-msg"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <div class="back-link">
                <a href="/login.php">&larr; Back to Member Login</a>
            </div>
        </div>
    </main>

    <?php include "../inc/footer.inc.php"; ?>
</body>

</html>