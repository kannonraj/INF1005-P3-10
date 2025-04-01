<?php
session_start();

require_once "db/db.php"; // use your db connection helper

$fname = $lname = $email = $password = $confirm_password = "";
$errorMsg = "";
$success = true;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // First Name
    $fname = !empty($_POST["fname"]) ? sanitize_input($_POST["fname"]) : "";

    // Last Name
    if (empty($_POST["lname"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }

    // Email
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

    // Password
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

        // Insert user into DB
        $stmt = $conn->prepare("INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);

        if ($stmt->execute()) {
            // ✅ Set session variables (Tip 4 included)
            $_SESSION["loggedin"] = true;
            $_SESSION["user_email"] = $email;
            $_SESSION["user_name"] = "$fname $lname";
            $_SESSION["fname"] = $fname;

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
            background-color: red;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>
    <div class="main-content">
        <main class="container" style="padding: 30px;">
            <?php if (!$success): ?>
                <h3>Oops!</h3>
                <h4>The following input errors were detected:</h4>
                <p><?= $errorMsg ?></p>
                <a href="register.php" class="btn-danger">Return to Sign Up</a>
            <?php endif; ?>
        </main>
    </div>
    <?php include "inc/footer.inc.php"; ?>
</body>

</html>

<?php
function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
?>