<?php
require_once "db/db.php";
$conn = connectToDatabase();

// Show reviews for this car
$review_stmt = $conn->prepare("
    SELECT r.rating, r.review, r.created_at, u.fname, u.lname
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    WHERE r.car_id = ?
    ORDER BY r.created_at DESC
");
$review_stmt->bind_param("i", $car_id);
$review_stmt->execute();
$reviews = $review_stmt->get_result();
?>

<h3>Reviews</h3>

<?php if ($reviews->num_rows > 0): ?>
    <?php while ($row = $reviews->fetch_assoc()): ?>
        <div style="border-bottom: 1px solid #ccc; padding: 10px 0;">
            <strong><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']) ?></strong> 
            <span>(<?= $row['rating'] ?>/5 ⭐)</span><br>
            <small><?= $row['created_at'] ?></small>
            <p><?= nl2br(htmlspecialchars($row['review'])) ?></p>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No reviews yet for this car.</p>
<?php endif; ?>

<?php
// Show form if user is logged in & has booked this car
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $user_email = $_SESSION["user_email"];

    // Check if this user has booked the car
    $check_stmt = $conn->prepare("
        SELECT b.id FROM bookings b
        JOIN users u ON b.user_id = u.id
        WHERE u.email = ? AND b.car_id = ? AND b.status = 'active'
    ");
    $check_stmt->bind_param("si", $user_email, $car_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0):
?>

<form action="submit_review.php" method="post" style="margin-top: 20px;">
    <h4>Leave a Review</h4>
    <input type="hidden" name="car_id" value="<?= $car_id ?>">
    <label for="rating">Rating (1–5):</label>
    <select name="rating" id="rating" required>
        <?php for ($i = 5; $i >= 1; $i--): ?>
            <option value="<?= $i ?>"><?= $i ?> ⭐</option>
        <?php endfor; ?>
    </select><br><br>
    <label for="review">Your Review:</label><br>
    <textarea name="review" id="review" rows="4" style="width: 100%;" required></textarea><br>
    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
</form>

<?php
    endif;
    $check_stmt->close();
}
$conn->close();
?>
