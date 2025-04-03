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
        <aside aria-label="Admin navigation">
            <?php include '../inc/admin.panel.inc.php'; ?>
        </aside>

        <main class="container-fluid py-5 px-4">
            <h1 class="visually-hidden">Manage Users - Admin Panel</h1>
            <h2 class="mb-4">Manage Users</h2>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Joined</th>
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
        </main>
    </div>
</body>

</html>