<?php
require 'auth.php';
require_once '../db/db.php';

// Redirect if no ID is provided
if (!isset($_GET['id'])) {
    header("Location: manage-cars.php");
    exit();
}

$carId = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->bind_param("i", $carId);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

if (!$car) {
    echo "Car not found.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $status = $_POST['status'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image = $car['image']; // Keep old image by default
    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/';
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $targetDir . $image);
    }

    $update = $conn->prepare("UPDATE cars SET brand=?, model=?, year=?, status=?, price_per_day=?, image=?, category=? WHERE id=?");
    $update->bind_param("ssissssi", $brand, $model, $year, $status, $price, $image, $category, $carId);
    $update->execute();

    header("Location: manage-cars.php");
    exit();
}
?>

<h2>Edit Car</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="brand" value="<?= htmlspecialchars($car['brand']) ?>" required placeholder="Brand">
    <input type="text" name="model" value="<?= htmlspecialchars($car['model']) ?>" required placeholder="Model">
    <input type="number" name="year" value="<?= $car['year'] ?>" required placeholder="Year">

    <select name="status">
        <option value="available" <?= $car['status'] === 'available' ? 'selected' : '' ?>>Available</option>
        <option value="unavailable" <?= $car['status'] === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
    </select>

    <input type="number" name="price" step="0.01" value="<?= $car['price_per_day'] ?>" required placeholder="Price per day">

    <select name="category">
        <?php
        $categories = ['Sedan','SUV','Hatchback','Convertible','Coupe','Truck','Minivan'];
        foreach ($categories as $cat):
            $selected = ($car['category'] === $cat) ? 'selected' : '';
            echo "<option value=\"$cat\" $selected>$cat</option>";
        endforeach;
        ?>
    </select>

    <p>Current Image:</p>
    <?php if ($car['image']): ?>
        <img src="../images/<?= $car['image'] ?>" width="100">
    <?php else: ?>
        <p>No image</p>
    <?php endif; ?>
    <input type="file" name="image">

    <button type="submit">Update Car</button>
</form>
<a href="manage-cars.php">Back to Car Management</a>
