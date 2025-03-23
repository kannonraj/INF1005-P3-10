<?php
session_start();
require_once "db/db.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["car_id"], $_POST["rating"], $_POST["review"])) {
    $car_id = intval($_POST["car_id"]);
    $rating = intval($_POST["rating"]);
    $review = trim($_POST["review"]);

    $conn = connectToDatabase();

    // Get user_id
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $_SESSION["user_email"]);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Insert review
    $insert = $conn->prepare("INSERT INTO reviews (user_id, car_id, rating, review) VALUES (?, ?, ?, ?)");
    $insert->bind_param("iiis", $user_id, $car_id, $rating, $review);
    $insert->execute();
    $insert->close();

    $conn->close();
    header("Location: car-details.php?car_id=$car_id");
    exit();
} else {
    echo "Invalid submission.";
}
?>
