<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Pagination setup
$limit = 10; // submissions per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total number of submissions
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM contact_submissions");
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Fetch current page submissions
$stmt = $conn->prepare("SELECT * FROM contact_submissions ORDER BY submitted_at DESC LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Manage Submissions</title>
</head>

<body>
    <div class="d-flex">
        <aside aria-label="Admin navigation">
            <?php include '../inc/admin.panel.inc.php'; ?>
        </aside>

        <main class="container-fluid py-5 px-4">
            <h1 class="visually-hidden">Manage Contact Submissions - Admin Panel</h1>
            <h2 class="mb-4">Contact Form Submissions</h2>

            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Message</th>
                                <th scope="col">Submitted At</th>
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

                <!-- Pagination Controls -->
                <nav aria-label="Submissions pagination">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous page">Previous</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>">Page <?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next page">Next</a>
                        </li>
                    </ul>
                </nav>

            <?php else: ?>
                <p class="text-muted">No submissions found.</p>
            <?php endif; ?>
        </main>
    </div>
</body>

</html>