<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Header -->
  <?php include "inc/head.inc.php" ?>
  <title>Warranty Policy | PEAK</title>
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
    <h1 class="text-center mb-5">WARRANTY POLICY</h1>

    <section class="mb-4">
      <h2 class="fw-bold">COVERAGE</h2>
      <ul>
        <li>All vehicles are regularly inspected and maintained by PEAK Car Rentals.</li>
        <li>Mechanical issues during rental that are not caused by misuse are covered under our basic warranty.</li>
        <li>Roadside assistance is available for eligible rentals with coverage included.</li>
      </ul>
    </section>

    <section>
      <h2 class="fw-bold">EXCLUSIONS</h2>
      <p>The warranty does not cover driver-caused damage, lost keys, flat tires, accidents, or negligence. Optional protection plans are available during checkout for added coverage.</p>
    </section>
  </div>
</main>

<?php include 'inc/footer.inc.php'; ?>
</body>
</html>