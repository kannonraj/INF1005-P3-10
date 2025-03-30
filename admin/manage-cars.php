<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Handle car deletion
if (isset($_GET['delete'])) {
    $carId = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    header("Location: manage-cars.php");
    exit();
}

// Handle car addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_car'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/';
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $image);
    }

    $stmt = $conn->prepare("INSERT INTO cars (brand, model, year, status, price_per_day, image, category) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $brand, $model, $year, $status, $price, $image, $category);
    $stmt->execute();
    header("Location: manage-cars.php");
    exit();
}

// Get all cars
$result = $conn->query("SELECT * FROM cars ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php include '../inc/admin.head.inc.php'; ?>
    <title>Manage Cars | Admin</title>
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

            <h2 class="mb-4">Manage Cars</h2>

            <!-- Add Car Form -->
            <form method="POST" enctype="multipart/form-data" class="mb-4 p-4 bg-white shadow-sm rounded">
                <h4>Add New Car</h4>
                <div class="row g-3">
                    <div class="col-md-4"><input type="text" name="brand" class="form-control" placeholder="Brand" required>
                    </div>
                    <div class="col-md-4"><input type="text" name="model" class="form-control" placeholder="Model" required>
                    </div>
                    <div class="col-md-4"><input type="number" name="year" class="form-control" placeholder="Year" required>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                    <div class="col-md-4"><input type="number" step="0.01" name="price" class="form-control"
                            placeholder="Price per day" required></div>
                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Convertible">Convertible</option>
                            <option value="Coupe">Coupe</option>
                            <option value="Truck">Truck</option>
                            <option value="Minivan">Minivan</option>
                        </select>
                    </div>
                    <div class="col-md-6"><input type="file" name="image" class="form-control"></div>
                    <div class="col-md-6"><button type="submit" name="add_car" class="btn btn-primary w-100">Add
                            Car</button></div>
                </div>
            </form>

            <!-- List of Cars -->
            <h4>Current Cars</h4>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($car = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $car['id'] ?></td>
                            <td><?= htmlspecialchars($car['brand']) ?></td>
                            <td><?= htmlspecialchars($car['model']) ?></td>
                            <td><?= $car['year'] ?></td>
                            <td><?= ucfirst($car['status']) ?></td>
                            <td>$<?= number_format($car['price_per_day'], 2) ?></td>
                            <td><?= htmlspecialchars($car['category']) ?></td>
                            <td>
                                <?php if ($car['image']): ?>
                                    <img src="../images/<?= htmlspecialchars($car['image']) ?>" width="80">
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="manage-cars.php?delete=<?= $car['id'] ?>" onclick="return confirm('Delete this car?')"
                                    class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
        <!-- Include the scroll-to-top button just before the closing body tag -->
        <?php include '../inc/scroll.inc.php'; ?>
</body>
</html>
