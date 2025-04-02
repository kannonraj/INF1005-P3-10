<?php
session_start();

require_once "db/db.php";
require 'send_email.php';
require 'generate_welcome_pdf.php';

$fname = $lname = $email = $password = $confirm_password = "";
$errorMsg = "";
$success = true;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fname = !empty($_POST["fname"]) ? sanitize_input($_POST["fname"]) : "";

    if (empty($_POST["lname"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }

    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }

    if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"])) {
        $errorMsg .= "Both password fields are required.<br>";
        $success = false;
    } else {
        $password = $_POST["pwd"];
        $confirm_password = $_POST["pwd_confirm"];

        if ($password !== $confirm_password) {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        }

        if (strlen($password) < 6 || !preg_match('/[0-9]/', $password)) {
            $errorMsg .= "Password must be at least 6 characters and include a number.<br>";
            $success = false;
        }
    }

    if ($success) {
        $conn = connectToDatabase();
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION["loggedin"] = true;
            $_SESSION["user_email"] = $email;
            $_SESSION["user_name"] = "$fname $lname";
            $_SESSION["fname"] = $fname;

            // Send welcome email with attached PDF
            $pdfPath = generateWelcomePDF($fname, $email);
            $subject = "Welcome to PEAK Car Rental!";
            $body = "
                <h2>Hi $fname,</h2>
                <p>Thank you for registering with <strong>PEAK Car Rental</strong>.</p>
                <p>We've attached a welcome guide to help you get started.</p>
                <br>
                <p>Cheers,<br>PEAK Car Rental Team</p>
            ";
            sendEmail($email, $subject, $body, $pdfPath);

            $stmt->close();
            $conn->close();

            header("Location: account.php");
            exit();
        } else {
            $errorMsg = "Registration failed: " . $stmt->error;
            $stmt->close();
            $conn->close();
            $success = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Register Failed | PEAK</title>
    <style>
        .btn-danger {
            background-color: #b30000; /* Fixed contrast */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-danger:hover {
            background-color: #990000;
        }

        .main-content {
            padding: 30px;
        }

        .visually-hidden {
            position: absolute;
            height: 1px;
            width: 1px;
            overflow: hidden;
            clip: rect(1px, 1px, 1px, 1px);
            white-space: nowrap;
        }
    </style>
</head>
<body>
<?php include "inc/nav.inc.php"; ?>
<div class="main-content">
    <main class="container">
        <!-- Visually hidden h1 for accessibility -->
        <h1 class="visually-hidden">Registration Error - PEAK</h1>

        <?php if (!$success): ?>
            <h2>Oops!</h2> <!-- Corrected heading level -->
            <h3>The following input errors were detected:</h3> <!-- Corrected heading level -->
            <p><?= $errorMsg ?></p>
            <a href="register.php" class="btn-danger">Return to Sign Up</a>
        <?php endif; ?>
    </main>
</div>
<?php include "inc/footer.inc.php"; ?>
</body>
</html>

<?php
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
