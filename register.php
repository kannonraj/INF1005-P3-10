<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php"; ?>
    <title>Member Registration | PEAK</title>

    <style>
        /* General Page Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100%; /* Full height of the page */
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .register-table {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1100px;
            background-color: #fff; /* White background for the table */
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px; /* Rounded corners for the container */
            margin: 0 15px; /* Ensure space around the container */
        }

        /* Left Column: Registration Form */
        .register-form {
            background-color: #fff;
            padding: 30px;
            flex: 1;
            box-sizing: border-box;
            border-top-left-radius: 15px; /* Rounded top left corner */
            border-bottom-left-radius: 15px; /* Rounded bottom left corner */
        }

        .register-form h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .register-form p {
            font-size: 16px;
            color: #555;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Label styling */
        .register-form label {
            color: #333;
            font-size: 16px;
            display: inline-block; /* Align label inline */
            width: 30%; /* Set a fixed width for the label */
            margin-bottom: 10px;
            text-align: left; /* Align label text to the left */
        }

        /* Form group: input and label side by side */
        .register-form .form-group {
            position: relative;
            margin-bottom: 15px;
            display: flex; /* Flexbox for label and input to be side by side */
            align-items: center;
        }

        /* Input field styling */
        .register-form .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            width: 65%; /* Make input take remaining space */
            font-size: 16px;
        }

/* Checkbox styling */
.register-form .form-check {
    display: flex; /* Keep checkbox and label on the same line */
    align-items: center;  /* Vertically center the checkbox and label */
    margin-bottom: 15px;
}

.register-form .form-check input {
    margin-right: 10px; /* Space between checkbox and label */
}

.register-form .form-check-label {
    line-height: 1.5; /* Adjust line height to make the text appear straight */
    margin-left: 0; /* Remove left margin if needed */
    white-space: nowrap; /* Prevent text from wrapping to the next line */
}

        .register-form .btn {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .register-form .btn:hover {
            background-color: #0056b3;
        }

        /* Right Column: Additional Signup Info */
        .signup-info {
            background-color: #222;
            color: #fff;
            padding: 30px;
            flex: 1;
            display: flex; /* Flexbox to center content */
            flex-direction: column; /* Arrange elements vertically */
            justify-content: center; /* Vertically center content */
            align-items: center; /* Horizontally center content */
            box-sizing: border-box;
            border-top-right-radius: 15px; /* Rounded top right corner */
            border-bottom-right-radius: 15px; /* Rounded bottom right corner */
        }

        .signup-info h2 {
            font-size: 32px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .signup-info p {
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .signup-info a {
            font-size: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-info a:hover {
            text-decoration: underline;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .register-table {
                flex-direction: column;
                width: 100%;
                margin-top: 20px;
            }

            .register-form,
            .signup-info {
                margin-right: 0;
                width: 100%; /* Ensure both sections take full width */
                border-radius: 0; /* Remove rounding for mobile view */
            }

            .register-form h1,
            .signup-info h2 {
                font-size: 24px;
            }

            .signup-info p {
                font-size: 16px;
            }

            .register-form .btn {
                font-size: 16px;
            }

            .register-form label {
                width: 100%; /* Full width for labels on small screens */
                text-align: left; /* Align labels to the left */
            }

            .register-form .form-control {
                width: 100%; /* Ensure input fields take up full width on mobile */
            }
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <?php include "inc/nav.inc.php"; ?>

    <div class="main-content">
        <main class="container">
            <div class="register-table">
                <!-- Left Column: Registration Form -->
                <div class="register-form">
                    <h1>Member Registration</h1>
                    <!-- Registration form -->
                    <form action="process_register.php" method="post">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input maxlength="45" type="text" id="fname" name="fname" class="form-control"
                                placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input required maxlength="45" type="text" id="lname" name="lname" class="form-control"
                                placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required maxlength="45" type="email" id="email" name="email" class="form-control"
                                placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input required type="password" id="pwd" name="pwd" class="form-control"
                                placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="pwd_confirm">Confirm Password:</label>
                            <input required type="password" id="pwd_confirm" name="pwd_confirm" class="form-control"
                                placeholder="Confirm password">
                        </div>
                        <div class="form-check">
                            <input required type="checkbox" name="agree" id="agree" class="form-check-input">
                            <label class="form-check-label" for="agree">
                                Agree to terms and conditions.
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Signup Info -->
                <div class="signup-info">
                    <h2>Already a Member?</h2>
                    <p>If you're already a member, simply log in and start renting your favorite cars.</p>
                    <p><a href="login.php">Log in</a> and begin your rental experience!</p>
                </div>
            </div>
        </main>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
