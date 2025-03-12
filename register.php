<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page title displayed in the browser tab -->
        <title>Register Member</title>

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
            <h1>Member Registration</h1>
            <p>
                For existing members, please go to the
                <a href="login.php">Sign In page</a>.
            </p>

            <!-- Registration form -->
            <form action="process_register.php" method="post">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name:</label>
                <input maxlength="45" type="text" id="fname" name="fname" class="form-control"
                    placeholder="Enter first name">
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name:</label>
                <input required maxlength="45" type="text" id="lname" name="lname" class="form-control"
                    placeholder="Enter last name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input required maxlength="45" type="email" id="email" name="email" class="form-control"
                    placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input required type="password" id="pwd" name="pwd" class="form-control"
                    placeholder="Enter password">
            </div>
            <div class="mb-3">
                <label for="pwd_confirm" class="form-label">Confirm Password:</label>
                <input required type="password" id="pwd_confirm" name="pwd_confirm" class="form-control"
                    placeholder="Confirm password">
            </div>
            <div class="mb-3 form-check">
                <input required type="checkbox" name="agree" id="agree" class="form-check-input">
                <label class="form-check-label" for="agree">
                    Agree to terms and conditions.
                </label>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </main>

        <?php
        include "inc/footer.inc.php";
        ?>
    </body>
</html>