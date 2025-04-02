<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Manage Submissions</title>
</head>

<body>
    <div class="d-flex">
        <?php include '../inc/admin.panel.inc.php'; ?>

        <div class="container-fluid py-5 px-4">
            <h2 class="mb-4">Contact Form Submissions</h2>

            <?php
            $result = $conn->query("SELECT * FROM contact_submissions ORDER BY submitted_at DESC");
            if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                    <td><?= htmlspecialchars($row['submitted_at']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No submissions yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
