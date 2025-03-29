<?php
session_start();
require_once '../db/db.php';

$conn = connectToDatabase(); // ✅ Needed!

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, fname, lname, email, password FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['fname'] . " " . $admin['lname'];
        $_SESSION['admin_email'] = $admin['email'];
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
    <title>Admin Login | PEAK</title>
    <?php include "../inc/head.inc.php"; ?>
</head>
<body>
    <?php include "../inc/nav.inc.php"; ?>
    <div class="container mt-5">
        <h2>Admin Login</h2>
        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" required class="form-control" placeholder="Email">
            </div>
            <div class="form-group mt-3">
                <input type="password" name="password" required class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Login</button>
            <?php if (isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
        </form>
    </div>
    <?php include "../inc/footer.inc.php"; ?>
</body>
</html>
