<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Header -->
  <?php include "inc/head.inc.php" ?>
  <title>Anti Piracy Policy | PEAK</title>

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
  <section class="policy-container">
    <h1 class="text-center mb-5">ANTI-PIRACY POLICY</h1>

    <section class="mb-4">
      <h2 class="fw-bold">OUR COMMITMENT</h2>
      <ul>
        <li>PEAK Car Rentals prohibits any unauthorized use or replication of our content, brand, or system.</li>
        <li>Violations of this policy may lead to account termination and legal action.</li>
        <li>We actively monitor and protect our website and platform from piracy or unauthorized distribution.</li>
      </ul>
    </section>

    <section>
      <h2 class="fw-bold">REPORTING VIOLATIONS</h2>
      <p>If you suspect any form of piracy or misuse of our platform, please report it immediately via our <a href="contact.php" class="text-decoration-underline text-white">Contact</a> page. All reports are confidential and investigated thoroughly.</p>
    </section>
</section>
</main>

<?php include 'inc/footer.inc.php'; ?>
</body>
</html>