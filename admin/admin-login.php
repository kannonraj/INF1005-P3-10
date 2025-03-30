<?php
session_start();
require_once '../db/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $conn = connectToDatabase();
    $stmt = $conn->prepare("SELECT id, fname, lname, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['fname'] . " " . $admin['lname'];
        header("Location: admin-dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "../inc/head.inc.php"; ?>
    <title>Admin Login | PEAK</title>
    <style>
        body {
            background-color: #2c3e50;
            color: white;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #fff;
            color: black;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-login {
            width: 100%;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include "../inc/nav.inc.php"; ?>

    <div class="container">
        <div class="login-container">
            <h2>Admin Login</h2>
            <?php if (!empty($error)): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <button type="submit" class="btn btn-primary btn-login">Login</button>
            </form>
        </div>
    </div>

    <?php include "../inc/footer.inc.php"; ?>
</body>
</html>
