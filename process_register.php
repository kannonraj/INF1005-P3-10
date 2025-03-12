<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page title displayed in the browser tab -->
        <title>Registration Results</title>

        <!-- head php -->
        <?php
            include "inc/head.inc.php";
        ?>
    </head>
    <body>
        <!-- Navigation bar -->
        <?php
        include "inc/nav.inc.php";
        ?>

        <main class="container">
        <?php
        // Initialize variables
        $fname = $lname = $email = $password = $confirm_password = "";
        $errorMsg = "";
        $success = true;

        // Validate First Name
        if (!empty($_POST["fname"]))
        {
            $fname = sanitize_input($_POST["fname"]); // Sanitize input to prevent XSS attacks
        }
        else
        {
            $fname = ""; // Set to an empty string if left blank
        }

        // Validate Last Name
        if (empty($_POST["lname"]))
        {
            $errorMsg .= "Last name is required.<br>"; // Error message
            $success = false;
        }
        else
        {
            $lname = sanitize_input($_POST["lname"]); 
        }

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
        if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"]))
        {
            $errorMsg .= "Both password fields are required.<br>";
            $success = false;
        }
        else
        {
            $password = $_POST["pwd"];
            $confirm_password = $_POST["pwd_confirm"];

            // Check if passwords match
            if ($password !== $confirm_password) {
                $errorMsg .= "Passwords do not match.<br>";
                $success = false;
            }

            // Ensure password meets security requirements (at least 6 characters, includes a number)
            if (strlen($password) < 6 || !preg_match('/[0-9]/', $password)) {
                $errorMsg .= "Password must be at least 6 characters and include a number.<br>";
                $success = false;
            }
        }

        // If validation is successful, hash the password and process the registration
        if ($success)
        {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

            saveMemberToDB(); // Call the function to save the user

            // Insert user data into the database (a placeholder)
            if ($success) { // Check if saving was successful
                echo '<div style="text-align: left; padding: 20px;">';
                echo "<h3>Your registration is successful!</h3>";
                echo "<h4>Thank you for signing up, " . trim("$fname $lname") . ".</h4>";
                echo "<p>Name: " . $fname . " " . $lname . "</p>";
                echo "<p>Email: " . $email . "</p>";
                echo '<a href="login.php" style="display: inline-block; padding: 10px 20px; background-color: green;
                        color: white; text-decoration: none; border-radius: 5px;">Log-in</a>';  // Log-in button
                echo '</div>';
            } else {
                echo '<div style="text-align: left; padding: 20px;">';
                echo "<h3>Oops!</h3>";
                echo "<h4>Registration failed due to an internal error.</h4>";
                echo "<p>" . nl2br($errorMsg) . "</p>";
                echo '<a href="register.php" style="display: inline-block; padding: 10px 20px; background-color: red;
                        color: white; text-decoration: none; border-radius: 5px;">Return to Sign Up</a>';
                echo '</div>';
            }
        }
        else
        {
            // Display validation errors
            echo '<div style="text-align: left; padding: 20px;">';
            echo "<h3>Oops!</h3>";
            echo "<h4>The following input errors were detected:</h4>";

            /*
            * Display multiple error messages on separate lines instead of single line
            * by converting newline characters (\n) in a string into HTML <br> tags
            */
            echo "<p>" . nl2br($errorMsg) . "</p>"; 

            echo '<a href="register.php" style="display: inline-block; padding: 10px 20px; background-color: red;
                    color: white; text-decoration: none; border-radius: 5px;">Return to Sign Up</a>'; // Return to Sign Up button
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

        /*
        * Helper function to write the member data to the database.
        */
        function saveMemberToDB()
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
                    $stmt = $conn->prepare("INSERT INTO world_of_pets_members
                        (fname, lname, email, password) VALUES (?, ?, ?, ?)");

                    // Bind & execute the query statement:
                    $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);
                    if (!$stmt->execute())
                    {
                        $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                            $stmt->error;
                        $success = false;
                    }
                    $stmt->close();
                }

                $conn->close();
            }
        }
        ?>
        </main>

        <?php
        include "inc/footer.inc.php";
        ?>
    </body>
</html>