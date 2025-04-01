<?php
include "db.php"; // Include DB connection

$conn = connectToDatabase(); // Assuming db.php has this function

//  Fetch cars that are NOT part of any active bookings
$sql = "
    SELECT brand, model, year, price_per_day 
    FROM cars 
    WHERE id NOT IN (
        SELECT car_id FROM bookings WHERE status = 'active'
    )
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Available Cars</title>
</head>

<body>
    <h2>Available Cars</h2>
    <table border="1">
        <tr>
            <th>Brand</th>
            <th>Model</th>
            <th>Year</th>
            <th>Price Per Day ($)</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["brand"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["year"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["price_per_day"]) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>