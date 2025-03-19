<?php
// privacy_policy.php
$title = "Privacy Policy";  // Set the title of the page
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php" ?>
    <title>Privacy Policy | PEAK</title>

</head>

<body>

<!-- Navigation -->
<?php include "inc/nav.inc.php"; ?>

<!-- Main Content Area -->
<div class="main-content">
    <div class="container">
        <h1 class="h1custom bold-text"><?php echo $title; ?></h1>
        <p>Your privacy is important to us. This privacy policy outlines the types of personal information we collect and how it is used.</p>

        <h4 class="h4custom bold-text">Information We Collect</h4>
        <p>When you make a reservation or contact us, we collect the following personal information:</p>
        <ul>
            <li>Name</li>
            <li>Email address</li>
            <li>Phone number</li>
            <li>Payment information</li>
        </ul>

        <h4 class="h4custom bold-text">How We Use Your Information</h4>
        <p>We use your personal information to:</p>
        <ul>
            <li>Process your rental bookings</li>
            <li>Communicate with you about your rental</li>
            <li>Improve our services</li>
            <li>Provide customer support</li>
        </ul>

        <h4 class="h4custom bold-text">Data Security</h4>
        <p>We take reasonable precautions to protect your information. We use secure servers and encryption methods to safeguard your personal data.</p>

        <h4 class="h4custom bold-text">Sharing Your Information</h4>
        <p>We will not sell, rent, or share your personal information with third parties unless required by law or to facilitate the processing of your rental.</p>

        <h4 class="h4custom bold-text">Your Rights</h4>
        <p>You have the right to access, correct, or request deletion of your personal information. If you wish to exercise these rights, please contact our customer support team.</p>
    </div>
</div>

<!-- Footer -->
<?php include "inc/footer.inc.php"; ?>

</body>
</html>
