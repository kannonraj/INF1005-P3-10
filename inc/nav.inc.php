<?php
require_once(__DIR__ . '/../db/db.php');
$conn = connectToDatabase();

// Count available cars dynamically (for potential display use)
$availableCarsQuery = "
    SELECT COUNT(*) AS count FROM cars 
    WHERE id NOT IN (SELECT car_id FROM bookings WHERE status = 'active')
";
$availableResult = $conn->query($availableCarsQuery);
$availableCars = $availableResult->fetch_assoc()['count'];

// Fetch unique categories (optional enhancement)
$categoryQuery = "SELECT DISTINCT category FROM cars ORDER BY category";
$categoryResult = $conn->query($categoryQuery);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="/images/logo.png" alt="logo" width="80" height="70" />
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about.php">About Us</a>
                </li>

                <!-- Rent A Car Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Rent A Car
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/car-listings.php">All Cars</a></li>
                        <?php
                        if ($categoryResult->num_rows > 0) {
                            while ($row = $categoryResult->fetch_assoc()) {
                                $category = htmlspecialchars($row['category']);
                                echo "<li><a class='dropdown-item' href='/car-listings.php?category={$category}'>" . ucfirst($category) . "</a></li>";
                            }
                        } else {
                            echo "<li><a class='dropdown-item' href='#'>No categories available</a></li>";
                        }
                        ?>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact.php">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Right-side Account Buttons -->
        <div class="d-flex ms-auto">
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                <a href="account.php" class="btn btn-outline-light me-2">
                    <span class="material-icons">account_circle</span> Account
                </a>
                <a href="logout.php" class="btn btn-outline-light">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline-light me-2">
                    <span class="material-icons">account_circle</span> Account
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>