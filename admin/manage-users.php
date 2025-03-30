<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Fetch regular users
$users = $conn->query("SELECT id, fname, lname, email, created_at, 'Customer' AS role FROM users");

// Fetch admin users
$admins = $conn->query("SELECT id, fname, lname, email, created_at, 'Admin' AS role FROM admins");

// Combine results
$allUsers = [];

while ($row = $users->fetch_assoc()) {
    $allUsers[] = $row;
}
while ($row = $admins->fetch_assoc()) {
    $allUsers[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Manage Users</h2>
        <a href="admin-dashboard.php" class="btn btn-secondary mb-3">← Back to Dashboard</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUsers as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['fname'] . ' ' . $user['lname']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['role'] ?></td>
                        <td><?= $user['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>