<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Header -->
  <?php include "inc/head.inc.php" ?>
  <title>Refund Policy | PEAK</title>
<style>
h2 {
  font-size: 1.5rem;
  font-weight: bold;
}
</style>
</head>
<body>
<?php 
include 'inc/nav.inc.php';
?>

<main class="policy-main-content text-white">
  <div class="policy-container">
    <h1 class="text-center mb-5">REFUND POLICY</h1>

    <section class="mb-4">
      <h2 class="fw-bold">RETURN AND REFUND</h2>
      <ul>
        <li>Returns must be made in person to our office.</li>
        <li>All complementary items must be returned in original condition and packaging along with the receipt.</li>
        <li>Vehicles must be returned in the same condition as when rented. If returned in unacceptable condition, we reserve the right to reject the return.</li>
        <li>If approved, refund processing may take 7–14 business days to appear back in your account.</li>
        <li>Administrative fees may be deducted where applicable.</li>
      </ul>
    </section>

    <section>
      <h2 class="fw-bold">EXCLUSIONS</h2>
      <p>Refunds will not be provided for cancellations made within 24 hours of rental start, no-shows, or if terms of service are violated. Refunds are also not applicable for fuel, cleaning, or damage fees.</p>
    </section>
  </div>
</main>

<?php include 'inc/footer.inc.php'; ?>
</body>
</html>