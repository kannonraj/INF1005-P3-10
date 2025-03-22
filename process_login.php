<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST["email"]);
    $password = $_POST["pwd"];
    $errorMsg = "";
    $success = true;

    $config_path = '/var/www/private/db-config.ini';
    if (!file_exists($config_path) || !is_readable($config_path)) {
        $errorMsg = "Internal server error: Unable to read config file.";
        $success = false;
    } else {
        $config = parse_ini_file($config_path);
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );

        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $stmt = $conn->prepare("SELECT fname, lname, email, password FROM car_rental WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row["password"])) {
                    // ✅ Success — store session
                    $_SESSION["loggedin"] = true;
                    $_SESSION["user_email"] = $row["email"];
                    $_SESSION["user_name"] = $row["fname"] . " " . $row["lname"];

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
        }
    }
} else {
    // Redirect if someone tries to access directly
    header("Location: login.php");
    exit();
}

// If login failed, show error and link back
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Failed | PEAK</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="main-content container" style="padding: 30px;">
        <h2>Login Failed</h2>
        <p>' . $errorMsg . '</p>
        <a href="login.php" class="btn btn-danger">Return to Login</a>
    </div>
</body>
</html>';

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
