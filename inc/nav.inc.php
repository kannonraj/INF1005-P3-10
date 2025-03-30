<?php
// Include database connection
require_once __DIR__ . '/../db/db.php';
$conn = connectToDatabase();

// Query to get distinct categories from the cars table
$query = "SELECT DISTINCT category FROM cars WHERE status = 'available' ORDER BY category";
$result = $conn->query($query);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo on the left -->
        <a class="navbar-brand" href="index.php">
            <img src="/images/logo.png" alt="logo" width="80" height="70"/>
        </a>

        <!-- Toggler button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about.php">About Us</a>
                </li>

                <!-- Rent A Car dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Rent A Car
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- Static All Cars Link -->
                        <li><a class="dropdown-item" href="/car-listings.php">All Cars</a></li>

                        <?php
                        // Check if any categories are returned
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $category = htmlspecialchars($row['category']);
                                // Create a dropdown item for each category
                                echo "<li><a class='dropdown-item' href='car-listings.php?category={$category}'>" . ucfirst($category) . "</a></li>";
                            }
                        } else {
                            echo "<li><a class='dropdown-item' href='#'>No categories available</a></li>";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact.php">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Right-side Account and Cart Icons -->
        <div class="d-flex ms-auto">
            <!-- Account Icon with Google Material Icon -->
            <a href="account.php" class="btn btn-outline-light me-2">
                <span class="material-icons">account_circle</span> Account
            </a>
        </div>
    </div>
</nav>
