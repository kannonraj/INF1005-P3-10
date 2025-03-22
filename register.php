<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title>Register Result | PEAK</title>
    <style>
        /*Style goes here */
    </style>
</head>

<body>
    <?php include "inc/nav.inc.php"; ?>

    <div class="main-content">
        <main class="container">
            <?php
            // Initialize variables
            $fname = $lname = $email = $password = $confirm_password = "";
            $errorMsg = "";
            $success = true;

            // Validate First Name
            if (!empty($_POST["fname"])) {
                $fname = sanitize_input($_POST["fname"]);
            } else {
                $fname = "";
            }

            // Validate Last Name
            if (empty($_POST["lname"])) {
                $errorMsg .= "Last name is required.<br>";
                $success = false;
            } else {
                $lname = sanitize_input($_POST["lname"]);
            }

            // Validate Email
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

            // Validate Password
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

                if (
                    strlen($password) < 8 ||
                    !preg_match('/[A-Z]/', $password) ||
                    !preg_match('/[a-z]/', $password) ||
                    !preg_match('/[0-9]/', $password) ||
                    !preg_match('/[\W]/', $password)
                ) {
                    $errorMsg .= "Password must be at least 8 characters and include uppercase, lowercase, a number, and a special character.<br>";
                    $success = false;
                }
            }

            // If validation passes
            if ($success) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                saveMemberToDB();

                if ($success) {
                    echo '<div style="text-align: left; padding: 20px;">';
                    echo "<h3>Your registration is successful!</h3>";
                    echo "<h4>Thank you for signing up, " . trim("$fname $lname") . ".</h4>";
                    echo "<p>Name: $fname $lname</p>";
                    echo "<p>Email: $email</p>";
                    echo '<a href="login.php" style="display: inline-block; padding: 10px 20px; background-color: green; color: white; text-decoration: none; border-radius: 5px;">Log-in</a>';
                    echo '</div>';
                } else {
                    echo '<div style="text-align: left; padding: 20px;">';
                    echo "<h3>Oops!</h3>";
                    echo "<h4>Registration failed due to an internal error.</h4>";
                    echo "<p>" . nl2br($errorMsg) . "</p>";
                    echo '<a href="register.php" style="display: inline-block; padding: 10px 20px; background-color: red; color: white; text-decoration: none; border-radius: 5px;">Return to Sign Up</a>';
                    echo '</div>';
                }
            } else {
                echo '<div style="text-align: left; padding: 20px;">';
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . nl2br($errorMsg) . "</p>";
                echo '<a href="register.php" style="display: inline-block; padding: 10px 20px; background-color: red; color: white; text-decoration: none; border-radius: 5px;">Return to Sign Up</a>';
                echo '</div>';
            }

            function sanitize_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            function saveMemberToDB() {
                global $fname, $lname, $email, $hashed_password, $errorMsg, $success;

                $config_path = '/var/www/private/db-config.ini';
                if (!file_exists($config_path) || !is_readable($config_path)) {
                    $errorMsg = "Database configuration file not found or unreadable.";
                    $success = false;
                    return;
                }

                $config = parse_ini_file($config_path);
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                    return;
                }

                // Check for duplicate email
                $stmt = $conn->prepare("SELECT email FROM car_rental WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $errorMsg = "An account with this email already exists.<br>";
                    $success = false;
                    $stmt->close();
                    $conn->close();
                    return;
                }
                $stmt->close();

                // Insert new user
                $stmt = $conn->prepare("INSERT INTO car_rental (fname, lname, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);
                if (!$stmt->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                }
                $stmt->close();
                $conn->close();
            }
            ?>
        </main>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>
</html>