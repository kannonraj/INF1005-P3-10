<?php
$title = "Booking";
include 'inc/head.inc.php'; // Include header
include 'inc/nav.inc.php'; // Include navigation

// Retrieve car name and price from URL parameters
$carName = isset($_GET['car']) ? htmlspecialchars($_GET['car']) : 'Unknown Car';
$carPrice = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '$0/day';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book <?php echo $carName; ?> | PEAK Rentals</title>
    <link rel="stylesheet" href="styles/booking.css"> <!-- Separate styling for booking page -->
    <script>
function calculateTotal() {
    const pricePerDay = parseFloat(document.getElementById("price").value.replace(/[^0-9.]/g, ''));
    const startDate = new Date(document.getElementById("start-date").value);
    const endDate = new Date(document.getElementById("end-date").value);

    if (!isNaN(startDate) && !isNaN(endDate) && startDate < endDate) {
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        const totalPrice = (pricePerDay * diffDays).toFixed(2);

        document.getElementById("total-price").innerText = "$" + totalPrice;
        document.getElementById("total-price-input").value = totalPrice; // Store in hidden field
    } else {
        document.getElementById("total-price").innerText = "Select valid dates";
        document.getElementById("total-price-input").value = ""; // Clear hidden field
    }
}

            if (!isNaN(startDate) && !isNaN(endDate) && startDate < endDate) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                document.getElementById("total-price").innerText = "$" + (pricePerDay * diffDays).toFixed(2);
            } else {
                document.getElementById("total-price").innerText = "Select valid dates";
            }    
    </script>
</head>
<body>
    <div class="container">
        <h1>Book <?php echo $carName; ?></h1>
        <form action="confirm-booking.php" method="POST">
            <input type="hidden" name="car" value="<?php echo $carName; ?>">
            <input type="hidden" name="price" id="price" value="<?php echo $carPrice; ?>">

            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" name="start-date" required onchange="calculateTotal()">

            <label for="end-date">End Date:</label>
            <input type="date" id="end-date" name="end-date" required onchange="calculateTotal()">

            <h3>Total Price: <span id="total-price">$0.00</span></h3>

            <button type="submit" class="confirm-btn">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
