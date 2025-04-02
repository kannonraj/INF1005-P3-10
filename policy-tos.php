<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Header -->
  <?php include "inc/head.inc.php" ?>
  <title>Terms of Service | PEAK</title>
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
    <h1 class="text-center mb-5">TERMS OF SERVICE</h1>

    <section class="mb-4">
      <h2 class="fw-bold">USER AGREEMENT</h2>
      <ul>
        <li>By renting from PEAK Car Rentals, you agree to abide by our rental terms and local traffic regulations.</li>
        <li>You must be at least 21 years old and possess a valid driver’s license.</li>
        <li>Bookings are subject to availability and confirmation.</li>
        <li>All vehicle use must comply with local laws. Misuse of rental vehicles is strictly prohibited.</li>
      </ul>
    </section>

    <section>
      <h2 class="fw-bold">MODIFICATIONS</h2>
      <p>PEAK Car Rentals reserves the right to modify or terminate services at any time without notice. Please review terms before each rental.</p>
    </section>
</section>
</main>

<?php include 'inc/footer.inc.php'; ?>
</body>
</html>