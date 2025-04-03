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
    <title>Member Login | PEAK</title>

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
            align-items: center;
            height: 70vh;
            padding: 20px;
        }

        .login-table {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1100px;
            background-color: #fff;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        /* Left Column: Login Form */
        .login-form {
            background-color: #fff;
            padding: 30px;
            flex: 1;
            box-sizing: border-box;
            border-top-left-radius: 15px;
            border-bottom-left-radius: 15px;
        }

        .login-form h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .login-form p {
            font-size: 16px;
            color: #555;
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form label {
            color: #333;
            font-size: 16px;
        }

        .login-form .form-group {
            position: relative;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .login-form .form-group i {
            font-size: 18px;
            color: #aaa;
            margin-right: 10px;
        }

        .login-form .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            width: 100%;
            font-size: 16px;
        }

        /* Submit button */
        .login-form .btn {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            border-radius: 8px;
            background-color: #0056b3; /* Higher contrast blue */
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .login-form .btn:hover {
            background-color: #004494;
        }

        /* Right Column: Signup Info */
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

        /* "Login as Admin" button */
        .btn-outline-secondary {
            background-color: #0056b3 !important;
            color: #fff !important;
            border-color: #0056b3 !important;
        }

        .btn-outline-secondary:hover {
            background-color: #004494 !important;
            border-color: #004494 !important;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .login-table {
                flex-direction: column;
                width: 100%;
                margin-top: 20px;
            }

            .login-form,
            .signup-info {
                margin-right: 0;
                width: 100%;
                border-radius: 0;
            }

            .login-form h1,
            .signup-info h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <?php include "inc/nav.inc.php"; ?>

    <div class="main-content">
        <main class="container">
            <div class="login-table">
                <!-- Left Column: Login Form -->
                <div class="login-form">
                    <h1>Member Login</h1>
                    <form action="process_login.php" method="post">
                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <input required maxlength="45" type="email" id="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-lock"></i>
                            <input required type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn">Submit</button>
                        </div>
                        <div style="text-align:center; margin-top: 10px;">
                            <a href="/admin/admin-login.php" class="btn btn-outline-secondary btn-sm">Login as Admin</a>
                        </div>
                    </form>
                </div>

                <!-- Right Column: Signup Info -->
                <div class="signup-info">
                    <h2>New Here?</h2>
                    <p>Sign up today and start renting your favorite cars easily.</p>
                    <p><a href="register.php">Sign Up</a> and begin renting!</p>
                </div>
            </div>
        </main>
    </div>

    <?php include "inc/footer.inc.php"; ?>
</body>

</html>
