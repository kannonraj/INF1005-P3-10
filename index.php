<?php
session_start();  
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Header -->
  <?php include "inc/head.inc.php" ?>
  <title>Home | PEAK</title>

  <style>
    /* General Layout */
    .main-content {
      flex: 1;
      /* This will take up all available space */
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
    }

    /* Hero Section */
    .hero {
      position: relative;
      width: 100%;
      height: 700px;
      /* Adjust the height as needed */
      overflow: hidden;
    }

    .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      /* Semi-transparent black background */
      z-index: 1;
    }

    .hero-images {
      width: 100%;
      height: 100%;
      position: absolute;
      transition: opacity 1s ease-in-out;
      /* Smooth fade transition */
    }

    .hero-images img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Ensures the images cover the container */
      display: none;
    }

    .hero-images img.active {
      display: block;
      /* Only display the active image */
    }

    .hero-content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: white;
      z-index: 2;
    }

    .hero-content h1 {
      font-size: 48px;
      margin-bottom: 20px;
    }

    .hero-content p {
      font-size: 18px;
    }

    /* Section Layout */
    .section {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      /* 2 columns per section */
      gap: 20px;
      padding: 20px;
    }

    .section-content {
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .section h2 {
      text-transform: uppercase;
      letter-spacing: 3px;
      margin-bottom: 20px;
    }

    .section p {
      font-size: 24px;
    }

    /* Colors */
    .bg-white {
      background-color: white;
    }

    .bg-black {
      background-color: black;
    }

    .tx-white {
      color: white;
    }

    .tx-black {
      color: black !important;
      /* Ensure this class forces black color */
    }

    .tx-brand-03 {
      color: #3e8bff;
      /* Example of brand color */
    }

    .tx-spacing-3 {
      letter-spacing: 3px;
    }

    .mg-b-40 {
      margin-bottom: 40px;
    }

    /* Background Images */
    .section>div {
      height: 450px;
      background-size: contain;
      /* Ensure the image is contained within the div */
      background-position: center;
      background-repeat: no-repeat;
    }

    /* Swapping Text and Image for Black Background */
    .bg-black .section {
      display: grid;
      grid-template-columns: 1fr 1fr;
      /* 2 columns */
    }

    .bg-black .section>div:nth-child(1) {
      order: 2;
      /* Image on the right */
    }

    .bg-black .section .section-content {
      order: 1;
      /* Text on the left */
    }

    /* Semi-transparent black */
    .tx-black-7 {
      color: rgba(0, 0, 0, 0.7) !important;
    }

    /* Font size for tx-24 */
    .tx-24 {
      font-size: 24px;
    }

/* Media query for mobile screens */
@media screen and (max-width: 768px) {
  .section {
    grid-template-columns: 1fr; /* Stack the sections vertically on smaller screens */
    padding: 10px; /* Reduce padding for mobile */
  }

  .section-content {
    padding: 15px; /* Reduce padding to avoid text overflow */
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center; /* Center align the text for smaller screens */
  }

  .section h2 {
    font-size: 20px; /* Adjust the font size for better readability on mobile */
    margin-bottom: 15px; /* Ensure spacing between text elements */
  }

  .tx-24 {
    font-size: 16px; /* Adjust text size for readability */
    line-height: 1.5; /* Ensure proper line spacing */
  }

  .bg-black .section>div {
    height: 300px; /* Reduce image height for mobile devices */
    background-size: cover; /* Ensure image is properly scaled */
    background-position: center;
  }

  .bg-white .section>div {
    height: 300px; /* Ensure white section background height is similar */
    background-size: cover; /* Ensure image is properly scaled */
    background-position: center;
  }

  /* Ensuring that the text does not overflow */
  .section-content p {
    overflow-wrap: break-word; /* Break long words */
    word-wrap: break-word;
    hyphens: auto; /* Automatically hyphenate words to avoid overflow */
  }
}
  </style>
</head>

<body>

  <!-- Navigation -->
  <?php include "inc/nav.inc.php"; ?>

  <!-- Main Content Area -->
  <div class="main-content">
    <!-- Hero Section -->
    <div class="hero">
      <!-- Overlay -->
      <div class="hero-overlay"></div>
      <div class="hero-images">
        <img src="images/hero1.jpg" alt="Car Image 1" class="active">
        <img src="images/hero2.jpg" alt="Car Image 2">
      </div>
      <div class="hero-content">
        <h1>Welcome to PEAK Car Rentals</h1>
        <p>Explore our wide range of cars and drive away in style!</p>
        <!-- Optional: Add a button for action -->
        <a href="car-listings.php" class="btn btn-primary">Browse Our Cars</a>
      </div>
    </div>

    <!-- Sections Below Hero -->
    <div class="bg-white">
      <div class="section">
        <!-- Background Image 1 -->
        <div style="background: url('images/index1.jpg') no-repeat center center;"></div>
        <div class="section-content">
          <h2 class="tx-black tx-spacing-3">Rent a car in the day or at night</h2>
          <h2 class="tx-brand-03 mg-b-40">With 24/7 availability</h2>
          <div class="tx-black-7 tx-24">
            You can rent at your own pace for a minimum of 15 mins. On weekends or weekdays, at any time of the day.
          </div>
        </div>
      </div>
    </div>

    <div class="bg-black">
      <div class="section">
        <!-- Background Image 2 -->
        <div style="background: url('images/index2.jpg') no-repeat top center;"></div>
        <div class="section-content">
          <h2 class="tx-white tx-spacing-3 tx-brand-03">Wide Selection of Car Models</h2>
          <h2 class="tx-white mg-b-40">For Any Occasion Any Need</h2>
          <div class="tx-white tx-24">
            Whether you're going out with friends, family or need it for business or a date, we've got a right model for
            you.
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white">
      <div class="section">
        <!-- Background Image 3 -->
        <div style="background: url('images/index3.jpg') no-repeat center center;"></div>
        <div class="section-content">
          <h2 class="tx-black tx-spacing-3">Cars Near The MRT Stations</h2>
          <h2 class="tx-brand-03 mg-b-40">Across The Island</h2>
          <div class="tx-black-7 tx-24">
            Rent without ranting. <br />Most of our cars are located near the MRT stations. So now you can spend more
            time for things that matter in your life.
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include "inc/footer.inc.php"; ?>

  <script>
    // JavaScript to change the image at interval
    let currentIndex = 0;
    const images = document.querySelectorAll('.hero-images img');
    const totalImages = images.length;

    function changeImage() {
      // Remove 'active' class from the current image
      images[currentIndex].classList.remove('active');

      // Update index to the next image, reset to 0 if we reach the end
      currentIndex = (currentIndex + 1) % totalImages;

      // Add 'active' class to the next image
      images[currentIndex].classList.add('active');
    }

    // Change image every 5 seconds
    setInterval(changeImage, 5000);
  </script>

</body>

</html>