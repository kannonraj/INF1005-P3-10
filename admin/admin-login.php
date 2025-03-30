<?php
session_start();
require_once '../db/db.php';

// Redirect to dashboard if already logged in as admin
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
    <!-- Custom CSS (Load After Bootstrap) -->
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .login-wrapper {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            color: black;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        .login-wrapper h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .btn-block {
            width: 100%;
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

    <?php include "../inc/footer.inc.php"; ?>
</body>

</html>