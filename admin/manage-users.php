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
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Manage Users</title>
</head>

<body class="bg-light">
    <div class="d-flex">
        <!-- Admin Panel (Include) -->
        <?php include '../inc/admin.panel.inc.php'; ?>

        <!-- Main Content -->
        <div class="container-fluid py-5 px-4">
            <!-- Button moved to top right -->
            <div class="position-absolute top-0 end-0 mt-3 me-3">
                <a href="admin-dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
            </div>

            <h2 class="mb-4">Manage Users</h2>

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
    </div>
</body>

</html>
