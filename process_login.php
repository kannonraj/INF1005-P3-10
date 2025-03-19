<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php"; ?>
    <title>Login Result | PEAK</title>

    <style>
     /*Style goes here */
   </style>
</head>

<body>
    <!-- Navigation bar -->
    <?php
    include "inc/nav.inc.php";
    ?>

    <div class="main-content">
        <main class="container">
        <?php
        // Initialize variables
        $email = $password = $fname = $lname = "";
        $errorMsg = "";
        $success = true;

        // Validate Email
        if (empty($_POST["email"]))
        {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        }
        else
        {
            $email = sanitize_input($_POST["email"]);

            // Additional check to make sure e-mail address is well-formed.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errorMsg .= "Invalid email format.<br>";
                $success = false;
            }
        }

        // Validate Password
        if (empty($_POST["pwd"]))
        {
            $errorMsg .= "Password is required.<br>";
            $success = false;
        }
        else
        {
            $password = $_POST["pwd"];
        }

        // If validation is successful, attempt authentication
        if ($success)
        {
            authenticateUser();
        }

        // Display appropriate messages
        if ($success)
        {
            echo '<div style="text-align: left; padding: 20px;">';
            echo "<h3>Login successful!</h3>";
            echo "<h4>Welcome back, " . trim("$fname $lname") . ".</h4>";
            echo '<a href="index.php" style="display: inline-block; padding: 10px 20px; background-color: green;
                    color: white; text-decoration: none; border-radius: 5px;">Return to Home</a>';  // Return to Home button
            echo '</div>';
        }
        else
        {
            // Display errors
            echo '<div style="text-align: left; padding: 20px;">';
            echo "<h3>Oops!</h3>";
            echo "<h4>The following errors were detected:</h4>";

            /*
            * Display multiple error messages on separate lines instead of single line
            * by converting newline characters (\n) in a string into HTML <br> tags
            */
            echo "<p>" . nl2br($errorMsg) . "</p>"; 

            echo '<a href="login.php" style="display: inline-block; padding: 10px 20px; background-color: orange;
                    color: black; text-decoration: none; border-radius: 5px;">Return to Login</a>'; // Return to Login button
            echo '</div>';
        }

        /*
        * Helper function that checks input for malicious or unwanted content.
        */
        function sanitize_input($data)
        {
            $data = trim($data);                // Remove unnecessary spaces
            $data = stripslashes($data);        // Remove backslashes
            $data = htmlspecialchars($data);    // Convert special characters to HTML entities
            return $data;
        }

        function authenticateUser()
        {
            global $fname, $lname, $email, $hashed_password, $errorMsg, $success;

            // Create database connection.
            $config = parse_ini_file('/var/www/private/db-config.ini');
            if (!$config)
            {
                $errorMsg = "Failed to read database config file.";
                $success = false;
            }
            else
            {
                $conn = new mysqli(
                    $config['servername'],
                    $config['username'],
                    $config['password'],
                    $config['dbname']
                );

                // Check connection
                if ($conn->connect_error)
                {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                }
                else
                {
                    // Prepare the statement:
                    $stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE email=?");

                    // Bind & execute the query statement:
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0)
                    {
                        // Note that email field is unique, so should only have one row.
                        $row = $result->fetch_assoc();
                        $fname = $row["fname"];
                        $lname = $row["lname"];
                        $hashed_password = $row["password"];

                        // Check if the password matches:
                        if (!password_verify($_POST["pwd"], $hashed_password))
                        {
                            // Don’t tell hackers which one was wrong, keep them guessing…
                            $errorMsg = "Email not found or password doesn't match...";
                            $success = false;
                        }
                    }
                    else
                    {
                        $errorMsg = "Email not found or password doesn't match...";
                        $success = false;
                    }
                    $stmt->close();
                }
                $conn->close();
            }
        }
        ?>
        </main>
    </div>

    <?php
    include "inc/footer.inc.php";
    ?>
</body>
</html>