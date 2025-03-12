<?php
// refund_policy.php
$title = "Refund Policy";  // Set the title of the page
?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php include "inc/head.inc.php"; ?>

<body>

<!-- Navigation -->
<?php include "inc/nav.inc.php"; ?>



  <!-- Main Content Area -->
  <div class="main-content">
    <!-- Content of the page goes here -->
    <!-- For example, you can add a section, a hero image, etc. -->
     
<div class="container">
    <h1><?php echo $title; ?></h1>
    <p>We strive to provide the best experience for our customers. However, in the event that you need to cancel your reservation, the following refund policy applies:</p>

    <ul>
        <li><strong>Cancellation within 24 hours of booking:</strong> Full refund.</li>
        <li><strong>Cancellation 24 hours to 48 hours before rental start:</strong> 50% refund.</li>
        <li><strong>Cancellation less than 48 hours before rental start:</strong> No refund.</li>
    </ul>

    <p>If you encounter any issues with your rental vehicle that are covered under our warranty, we will offer a partial or full refund depending on the severity of the issue and the duration of the rental period.</p>

    <p>To request a refund, please contact our support team with your booking details and any relevant information. Refunds will be processed within 7 business days.</p>
</div>
  </div>



<!-- Footer -->
<?php include "inc/footer.inc.php"; ?>

</body>
</html>
