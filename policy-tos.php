<?php
// terms_of_service.php
$title = "Terms of Service";  // Set the title of the page
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php" ?>
    <title>Terms of Service Policy | PEAK</title>

</head>

<body>

<!-- Navigation -->
<?php include "inc/nav.inc.php"; ?>



  <!-- Main Content Area -->
  <div class="main-content">
    <!-- Content of the page goes here -->
    <!-- For example, you can add a section, a hero image, etc. -->
<!-- Index Content -->
<div class="container">
    <h1 class="h1custom bold-text"><?php echo $title; ?></h1>
    <p>By using [Your Company Name]'s rental services, you agree to the following terms and conditions:</p>

    <h4 class="h4custom bold-text">1. Reservation and Payment</h4>
    <p>Reservations must be made with a valid credit card. Payments for the rental will be processed at the time of booking. All rental fees are non-refundable unless otherwise specified in our refund policy.</p>

    <h4 class="h4custom bold-text">2. Rental Period</h4>
    <p>The rental period begins at the scheduled pickup time and ends when the vehicle is returned to the designated location. Late returns will be subject to additional fees.</p>

    <h4 class="h4custom bold-text">3. Driver Requirements</h4>
    <p>All drivers must be at least 25 years of age and possess a valid driver's license. Additional documentation may be required for international customers.</p>

    <h4 class="h4custom bold-text">4. Vehicle Use</h4>
    <p>The rental vehicle must be used in accordance with local laws and regulations. Any damage caused by misuse or negligent driving will be the responsibility of the renter.</p>

    <h4 class="h4custom bold-text">5. Insurance</h4>
    <p>We provide basic insurance coverage with the rental. However, renters may opt for additional insurance options for extra coverage.</p>

    <h4 class="h4custom bold-text">6. Liability</h4>
    <p>[Your Company Name] is not responsible for any injuries or damages that occur during the rental period unless caused by our negligence. Renters are fully responsible for the vehicle and its contents while it is in their possession.</p>

    <h4 class="h4custom bold-text">7. Cancellations and Modifications</h4>
    <p>Customers may cancel or modify their reservations according to our refund policy. Failure to cancel a reservation in time will result in charges as outlined in the refund policy.</p>

    <h4 class="h4custom bold-text">8. Governing Law</h4>
    <p>These terms are governed by the laws of [Your State/Country], and any disputes arising from the use of our services will be resolved in accordance with these laws.</p>
</div>
  </div>

<!-- Footer -->
<?php include "inc/footer.inc.php"; ?>

</body>
</html>
