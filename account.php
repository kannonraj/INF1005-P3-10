<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php"; ?>
    <title>Account | PEAK</title>

    <!-- Google Material Icons & Roboto Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        .auth-btn-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        /* Material Design Button */
        .auth-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            text-transform: uppercase;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            text-decoration: none;
            color: white;
        }

        /* Login Button - Blue */
        .login-btn {
            background-color: #1E88E5;
        }

        .login-btn:hover {
            background-color: #1565C0;
        }

        /* Register Button - Green */
        .register-btn {
            background-color: #43A047;
        }

        .register-btn:hover {
            background-color: #2E7D32;
        }

        .main-content {
            text-align: center;
            padding: 50px 20px;
        }
    </style>
</head>

<body>
    
    <!-- Navigation -->
    <?php include "inc/nav.inc.php"; ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <h1>Welcome to Peak Car Rental</h1>
        <p>Please click on the respective buttons to Log In or Register.</p>

        <!-- Material Design Buttons -->
        <div class="auth-btn-container">
            <a href="login.php" class="auth-btn login-btn" aria-label="Log in to your account">
                <span class="material-icons">login</span> LOGIN
            </a>
            <a href="register.php" class="auth-btn register-btn" aria-label="Register a new account">
                <span class="material-icons">person_add</span> REGISTER
            </a>
        </div>

        <div class="container">
            <!-- Additional content can go here -->
        </div>
    </div>

    <!-- Footer -->
    <?php include "inc/footer.inc.php"; ?>

</body>

</html>
