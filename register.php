<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: account.php");
    exit();
}
?>

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
            height: 100%;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .register-table {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1100px;
            background-color: #fff;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin: 0 15px;
        }

        /* Left Column: Registration Form */
        .register-form {
            background-color: #fff;
            padding: 30px;
            flex: 1;
            box-sizing: border-box;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
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

        .register-form label {
            color: #333;
            font-size: 16px;
            display: inline-block;
            width: 30%;
            margin-bottom: 10px;
            text-align: left;
        }

        .register-form .form-group {
            position: relative;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .register-form .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            width: 65%;
            font-size: 16px;
        }

        .register-form .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .register-form .form-check input {
            margin-right: 10px;
        }

        .register-form .form-check-label {
            line-height: 1.5;
            margin-left: 0;
            white-space: nowrap;
        }

        /* ✅ FIXED CONTRAST: Submit button */
        .register-form .btn {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            background-color: #0056b3; /* Fixed for better contrast */
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .register-form .btn:hover {
            background-color: #004494;
        }

        /* Right Column: Additional Signup Info */
        .signup-info {
            background-color: #222;
            color: #fff;
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
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
                width: 100%;
                border-radius: 0;
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
                width: 100%;
                text-align: left;
            }

            .register-form .form-control {
                width: 100%;
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
                    <form action="process_register.php" method="post">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input maxlength="45" type="text" id="fname" name="fname" class="form-control" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input required maxlength="45" type="text" id="lname" name="lname" class="form-control" placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required maxlength="45" type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="pwd_confirm">Confirm Password:</label>
                            <input required type="password" id="pwd_confirm" name="pwd_confirm" class="form-control" placeholder="Confirm password">
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
