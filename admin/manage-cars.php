<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Handle car addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_car'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/';
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $image);
    }

    $stmt = $conn->prepare("INSERT INTO cars (brand, model, year, status, price_per_day, category, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisdsss", $brand, $model, $year, $status, $price, $category, $description, $image);
    $stmt->execute();
    header("Location: manage-cars.php");
    exit();
}

// Handle car updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_car'])) {
    $carId = intval($_POST['car_id']);
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Get the existing car to retrieve current image
    $stmt = $conn->prepare("SELECT image FROM cars WHERE id = ?");
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    $stmt->bind_result($oldImage);
    $stmt->fetch();
    $stmt->close();

    $image = $oldImage; // default to old image unless new one is uploaded

    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/';
        $image = basename($_FILES['image']['name']);
        $imagePath = $targetDir . $image;

        // Move uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $oldImagePath = $targetDir . $oldImage;
            if (!empty($oldImage) && file_exists($oldImagePath) && $oldImage !== $image) {
                unlink($oldImagePath);
            }
        }
    }

    // Update car with new data
    $update = $conn->prepare("UPDATE cars SET brand=?, model=?, year=?, status=?, price_per_day=?, image=?, category=?, description=? WHERE id=?");
    $update->bind_param("ssisssssi", $brand, $model, $year, $status, $price, $image, $category, $description, $carId);
    $update->execute();
    $update->close();

    header("Location: manage-cars.php?update=success");
    exit();
}


// Handle car deletion
if (isset($_GET['delete'])) {
    $carId = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    header("Location: manage-cars.php");
    exit();
}

// Fetch all cars
$result = $conn->query("SELECT * FROM cars ORDER BY id DESC");
$cars = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Cars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <a href="admin-dashboard.php" class="btn btn-secondary mb-4">← Back to Dashboard</a>
        <h2 class="mb-4">Manage Cars</h2>

        <!-- Add Car Form -->
        <form method="POST" enctype="multipart/form-data" class="row g-3 mb-5 bg-white p-4 shadow-sm rounded">
            <h5>Add New Car</h5>
            <div class="col-md-3"><input type="text" name="brand" class="form-control" placeholder="Brand" required>
            </div>
            <div class="col-md-3"><input type="text" name="model" class="form-control" placeholder="Model" required>
            </div>
            <div class="col-md-2"><input type="number" name="year" class="form-control" placeholder="Year" required>
            </div>
            <div class="col-md-2"><input type="number" step="0.01" name="price" class="form-control"
                    placeholder="Price/day" required></div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <?php
                    $categories = ['Sedan', 'SUV', 'Hatchback', 'Convertible', 'Coupe', 'Truck', 'Minivan'];
                    foreach ($categories as $cat) {
                        echo "<option value=\"$cat\">$cat</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3"><input type="file" name="image" class="form-control"></div>
            <div class="col-md-6"><textarea name="description" class="form-control"
                    placeholder="Car Description (optional)"></textarea></div>
            <div class="col-md-12"><button type="submit" name="add_car" class="btn btn-primary w-100">Add Car</button>
            </div>
        </form>

        <!-- Car Listing -->
        <h4>Current Cars</h4>
        <table class="table table-bordered table-hover">
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?= $car['id'] ?></td>
                        <td><?= htmlspecialchars($car['brand']) ?></td>
                        <td><?= htmlspecialchars($car['model']) ?></td>
                        <td><?= $car['year'] ?></td>
                        <td><?= ucfirst($car['status']) ?></td>
                        <td>$<?= number_format($car['price_per_day'], 2) ?></td>
                        <td><?= $car['category'] ?></td>
                        <td>
                            <?php if ($car['image']): ?>
                                <img src="../images/<?= $car['image'] ?>" width="60">
                            <?php else: ?>N/A<?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editModal<?= $car['id'] ?>">Edit</button>
                            <a href="manage-cars.php?delete=<?= $car['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this car?')">Delete</a>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?= $car['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content" onclick="event.stopPropagation();">
                                <form method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                                    <input type="hidden" name="current_image" value="<?= $car['image'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Car #<?= $car['id'] ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body row g-3">
                                        <div class="col-md-4"><input type="text" name="brand" class="form-control"
                                                value="<?= htmlspecialchars($car['brand']) ?>" required></div>
                                        <div class="col-md-4"><input type="text" name="model" class="form-control"
                                                value="<?= htmlspecialchars($car['model']) ?>" required></div>
                                        <div class="col-md-4"><input type="number" name="year" class="form-control"
                                                value="<?= $car['year'] ?>" required></div>

                                        <div class="col-md-4">
                                            <select name="status" class="form-select">
                                                <option value="available" <?= $car['status'] === 'available' ? 'selected' : '' ?>>Available</option>
                                                <option value="unavailable" <?= $car['status'] === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4"><input type="number" step="0.01" name="price"
                                                class="form-control" value="<?= $car['price_per_day'] ?>" required></div>
                                        <div class="col-md-4">
                                            <select name="category" class="form-select">
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= $cat ?>" <?= $car['category'] === $cat ? 'selected' : '' ?>>
                                                        <?= $cat ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6"><input type="file" name="image" class="form-control"></div>
                                        <div class="col-md-6">
                                            <?php if ($car['image']): ?>
                                                <img src="../images/<?= $car['image'] ?>" width="100">
                                            <?php else: ?>No Image<?php endif; ?>
                                        </div>
                                        <div class="col-md-12"><textarea name="description" class="form-control" rows="3"
                                                placeholder="Description"><?= htmlspecialchars($car['description']) ?></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="update_car" class="btn btn-success">Save
                                            Changes</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>