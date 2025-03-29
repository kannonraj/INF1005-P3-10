<?php
require 'auth.php';
require_once '../db/db.php';

// Fetch all users
$result = $conn->query("SELECT id, fname, lname, email, is_admin FROM users ORDER BY id ASC");
?>

<h2>Manage Users</h2>
<table border="1">
    <thead>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['fname']) ?></td>
            <td><?= htmlspecialchars($user['lname']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['is_admin'] ? 'Admin' : 'Customer' ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<a href="admin-dashboard.php">Back to Dashboard</a>
