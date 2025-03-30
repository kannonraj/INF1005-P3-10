<?php
require_once "db/db.php";
$conn = connectToDatabase();
$limit = 5;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$sort = $_GET['sort'] ?? 'recent';
$orderBy = match($sort) {
    'highest' => 'r.rating DESC',
    'lowest' => 'r.rating ASC',
    default => 'r.created_at DESC'
};

// Sorting dropdown
?>
<form method="get" style="margin-bottom: 20px;">
    <input type="hidden" name="car_id" value="<?= $car_id ?>">
    <label for="sort">Sort by:</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="recent" <?= $sort === 'recent' ? 'selected' : '' ?>>Most Recent</option>
        <option value="highest" <?= $sort === 'highest' ? 'selected' : '' ?>>Highest Rating</option>
        <option value="lowest" <?= $sort === 'lowest' ? 'selected' : '' ?>>Lowest Rating</option>
    </select>
</form>

<h3>Reviews</h3>

<?php
// Fetch reviews
$review_stmt = $conn->prepare("
    SELECT r.rating, r.review, r.created_at, u.fname, u.lname
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    WHERE r.car_id = ?
    ORDER BY $orderBy
    LIMIT ? OFFSET ?
");
$review_stmt->bind_param("iii", $car_id, $limit, $offset);
$review_stmt->execute();
$reviews = $review_stmt->get_result();

if ($reviews->num_rows > 0):
    while ($row = $reviews->fetch_assoc()):
?>
    <div style="border-bottom: 1px solid #ddd; padding: 20px 0;">
        <strong><?= htmlspecialchars($row['fname'] . ' ' . $row['lname']) ?></strong><br>
        <?php
        $rating = intval($row['rating']);
        $stars = str_repeat("★", $rating) . str_repeat("☆", 5 - $rating);
        echo "<div class='rating-stars' style='color: gold;'>$stars</div>";
        ?>
        <small style="color: #777;"><?= $row['created_at'] ?></small>
        <p><?= nl2br(htmlspecialchars($row['review'])) ?></p>
    </div>
<?php
    endwhile;
else:
    echo "<p>No reviews yet for this car.</p>";
endif;

// Total review count for pagination
$count_stmt = $conn->prepare("SELECT COUNT(*) FROM reviews WHERE car_id = ?");
$count_stmt->bind_param("i", $car_id);
$count_stmt->execute();
$count_stmt->bind_result($total_reviews);
$count_stmt->fetch();
$count_stmt->close();

$total_pages = ceil($total_reviews / $limit);

if ($total_pages > 1):
    echo "<div class='pagination' style='text-align: center; margin-top: 30px;'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? "font-weight: bold;" : "";
        echo "<a style='margin-right:10px; $active' href='car-details.php?car_id=$car_id&sort=$sort&page=$i'>$i</a>";
    }
    echo "</div>";
endif;

// Show form to submit a review if booked
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $user_email = $_SESSION["user_email"];

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
    <div class="form-container">
        <form action="submit_review.php" method="post">
            <h4>Leave a Review</h4>
            <input type="hidden" name="car_id" value="<?= $car_id ?>">
            <label for="rating">Rating (1–5):</label>
            <select name="rating" id="rating" required>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>"><?= $i ?> ⭐</option>
                <?php endfor; ?>
            </select><br><br>
            <label for="review">Your Review:</label><br>
            <textarea name="review" id="review" rows="4" required></textarea><br>
            <button type="submit">Submit</button>
        </form>
    </div>
<?php
    endif;
    $check_stmt->close();
}

$conn->close();
?>
