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

    <style>
     /*Style goes here */
   </style>
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
    <h1><?php echo $title; ?></h1>
    <p>By using [Your Company Name]'s rental services, you agree to the following terms and conditions:</p>

    <h2>1. Reservation and Payment</h2>
    <p>Reservations must be made with a valid credit card. Payments for the rental will be processed at the time of booking. All rental fees are non-refundable unless otherwise specified in our refund policy.</p>

    <h2>2. Rental Period</h2>
    <p>The rental period begins at the scheduled pickup time and ends when the vehicle is returned to the designated location. Late returns will be subject to additional fees.</p>

    <h2>3. Driver Requirements</h2>
    <p>All drivers must be at least 25 years of age and possess a valid driver's license. Additional documentation may be required for international customers.</p>

    <h2>4. Vehicle Use</h2>
    <p>The rental vehicle must be used in accordance with local laws and regulations. Any damage caused by misuse or negligent driving will be the responsibility of the renter.</p>

    <h2>5. Insurance</h2>
    <p>We provide basic insurance coverage with the rental. However, renters may opt for additional insurance options for extra coverage.</p>

    <h2>6. Liability</h2>
    <p>[Your Company Name] is not responsible for any injuries or damages that occur during the rental period unless caused by our negligence. Renters are fully responsible for the vehicle and its contents while it is in their possession.</p>

    <h2>7. Cancellations and Modifications</h2>
    <p>Customers may cancel or modify their reservations according to our refund policy. Failure to cancel a reservation in time will result in charges as outlined in the refund policy.</p>

    <h2>8. Governing Law</h2>
    <p>These terms are governed by the laws of [Your State/Country], and any disputes arising from the use of our services will be resolved in accordance with these laws.</p>
</div>
  </div>

<!-- Footer -->
<?php include "inc/footer.inc.php"; ?>

</body>
</html>
