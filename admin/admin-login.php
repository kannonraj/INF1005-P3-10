<?php
session_start();
require_once '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'admin'");
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
<form method="POST">
    <h2>Admin Login</h2>
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Login</button>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>