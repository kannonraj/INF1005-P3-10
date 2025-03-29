<?php
require 'auth.php';
require_once '../db/db.php';

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

    $image = NULL;
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

<h2>Manage Cars</h2>
<form method="POST" enctype="multipart/form-data">
    <h3>Add New Car</h3>
    <input type="text" name="brand" required placeholder="Brand">
    <input type="text" name="model" required placeholder="Model">
    <input type="number" name="year" required placeholder="Year">
    <select name="status">
        <option value="available">Available</option>
        <option value="unavailable">Unavailable</option>
    </select>
    <input type="number" name="price" step="0.01" required placeholder="Price per day">
    <select name="category">
        <option value="Sedan">Sedan</option>
        <option value="SUV">SUV</option>
        <option value="Hatchback">Hatchback</option>
        <option value="Convertible">Convertible</option>
        <option value="Coupe">Coupe</option>
        <option value="Truck">Truck</option>
        <option value="Minivan">Minivan</option>
    </select>
    <input type="file" name="image">
    <button type="submit" name="add_car">Add Car</button>
</form>

<hr>
<h3>Current Cars</h3>
<table border="1">
    <tr>
        <th>ID</th><th>Brand</th><th>Model</th><th>Year</th><th>Status</th><th>Price</th><th>Category</th><th>Image</th><th>Action</th>
    </tr>
    <?php while ($car = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $car['id'] ?></td>
        <td><?= $car['brand'] ?></td>
        <td><?= $car['model'] ?></td>
        <td><?= $car['year'] ?></td>
        <td><?= $car['status'] ?></td>
        <td>$<?= $car['price_per_day'] ?></td>
        <td><?= $car['category'] ?></td>
        <td>
            <?php if ($car['image']): ?>
                <img src="../images/<?= $car['image'] ?>" width="80">
            <?php else: ?>
                N/A
            <?php endif; ?>
        </td>
        <td>
            <!-- Future: Edit feature -->
            <a href="manage-cars.php?delete=<?= $car['id'] ?>" onclick="return confirm('Delete this car?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
