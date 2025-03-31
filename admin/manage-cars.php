<?php
require 'auth.php';
require_once '../db/db.php';

$conn = connectToDatabase();

// Handle car addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_car'])) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/';
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $image);
    }

    $stmt = $conn->prepare("INSERT INTO cars (brand, model, year, price_per_day, category, description, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsss", $brand, $model, $year, $price, $category, $description, $image);
    $stmt->execute();
    header("Location: manage-cars.php");
    exit();
}

// Handle car update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_car'])) {
    $carId = intval($_POST['car_id']);
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("SELECT image FROM cars WHERE id = ?");
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    $stmt->bind_result($oldImage);
    $stmt->fetch();
    $stmt->close();

    $image = $oldImage;

    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/';
        $image = basename($_FILES['image']['name']);
        $imagePath = $targetDir . $image;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $oldImagePath = $targetDir . $oldImage;
            if (!empty($oldImage) && file_exists($oldImagePath) && $oldImage !== $image) {
                unlink($oldImagePath);
            }
        }
    }

    $stmt = $conn->prepare("UPDATE cars SET brand=?, model=?, year=?, price_per_day=?, category=?, description=?, image=? WHERE id=?");
    $stmt->bind_param("sssdsssi", $brand, $model, $year, $price, $category, $description, $image, $carId);
    $stmt->execute();
    $stmt->close();

    header("Location: manage-cars.php?update=success");
    exit();
}

// Handle car deletion
if (isset($_GET['delete'])) {
    $carId = intval($_GET['delete']);
    $stmt = $conn->prepare("SELECT image FROM cars WHERE id = ?");
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    $stmt->bind_result($imageToDelete);
    $stmt->fetch();
    $stmt->close();

    if (!empty($imageToDelete)) {
        $imagePath = "../images/" . $imageToDelete;
        if (file_exists($imagePath))
            unlink($imagePath);
    }

    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    header("Location: manage-cars.php");
    exit();
}

// Fetch cars
$cars = [];
$categories = ['Sedan', 'SUV', 'Hatchback', 'Convertible', 'Coupe', 'Truck', 'Minivan'];
$car_query = $conn->query("SELECT * FROM cars ORDER BY id DESC");

while ($car = $car_query->fetch_assoc()) {
    $car_id = $car['id'];
    $booked_check = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE car_id = ? AND status = 'active'");
    $booked_check->bind_param("i", $car_id);
    $booked_check->execute();
    $booked_check->bind_result($active_bookings);
    $booked_check->fetch();
    $booked_check->close();

    $car['is_booked'] = $active_bookings > 0;
    $cars[] = $car;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../inc/admin.head.inc.php'; ?>
    <title>Manage Cars</title>
</head>

<body>
    <div class="d-flex">
        <?php include '../inc/admin.panel.inc.php'; ?>

        <div class="container-fluid px-4 py-5">
            <h2 class="mb-4">Manage Cars</h2>

            <!-- Add Form -->
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
                    <select name="category" class="form-select">
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat ?>"><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3"><input type="file" name="image" class="form-control"></div>
                <div class="col-md-6"><textarea name="description" class="form-control"
                        placeholder="Car Description (optional)"></textarea></div>
                <div class="col-md-12"><button type="submit" name="add_car" class="btn btn-primary w-100">Add
                        Car</button></div>
            </form>

            <!-- Table -->
            <table class="table table-bordered table-hover bg-white shadow-sm">
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
                            <td>
                                <?php if ($car['is_booked']): ?>
                                    <span class="badge bg-danger">Booked</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Available</span>
                                <?php endif; ?>
                            </td>
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
                                <a href="manage-cars.php?delete=<?= $car['id'] ?>"
                                    onclick="return confirm('Delete this car?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal<?= $car['id'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content" onclick="event.stopPropagation();">
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
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
                                            <div class="col-md-4"><input type="number" step="0.01" name="price"
                                                    class="form-control" value="<?= $car['price_per_day'] ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="category" class="form-select">
                                                    <?php foreach ($categories as $cat): ?>
                                                        <option value="<?= $cat ?>" <?= $car['category'] === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6"><input type="file" name="image" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <?php if ($car['image']): ?>
                                                    <img src="../images/<?= $car['image'] ?>" width="100">
                                                <?php else: ?>No Image<?php endif; ?>
                                            </div>
                                            <div class="col-md-12"><textarea name="description" class="form-control"
                                                    rows="3"><?= htmlspecialchars($car['description']) ?></textarea></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="edit_car" class="btn btn-success">Save
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>