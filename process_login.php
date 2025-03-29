<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "db/db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST["email"]);
    $password = $_POST["pwd"];
    $errorMsg = "";
    $success = true;

    $conn = connectToDatabase(); 


    $stmt = $conn->prepare("SELECT fname, lname, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($fname, $lname, $db_email, $db_hashed_password);
        $stmt->fetch();

        if (password_verify($password, $db_hashed_password)) {
            $_SESSION["loggedin"] = true;
            $_SESSION["user_email"] = $db_email;
            $_SESSION["user_name"] = $fname . " " . $lname;

            $stmt->close();
            $conn->close();
            header("Location: account.php");
            exit();
        } else {
            $errorMsg = "Incorrect email or password.";
            $success = false;
        }
    } else {
        $errorMsg = "Account not found.";
        $success = false;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
    exit();
}

// Show error if login fails
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Login Failed | PEAK</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            background-color: #2c3e50;
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            padding: 30px;
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
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
    <div class="main-content container">
        <h2>Login Failed</h2>
        <p><?= htmlspecialchars($errorMsg) ?></p>
        <a href="login.php" class="btn-danger">Return to Login</a>
    </div>
    <?php include "inc/footer.inc.php"; ?>
</body>
</html>

<?php
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
