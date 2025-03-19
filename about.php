<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php" ?>
    <title>About Us | PEAK</title>

    <style>
        /* Set background color for the entire page */
        body {
            background-color: #3c4a59;
            color: white;
            font-family: Arial, sans-serif;
        }

        /* About Us Section */
        .about-section {
            text-align: center;
            margin: 20px auto;
        }

        .about-section p {
            font-size: 28px;
            text-align: justify;
            margin: 0 auto;
        }

        /* Logo Image Style */
        .logo-img {
            max-width: 350px; /* Adjust size of the logo */
            margin: 20px 0;
        }

        /* Why Choose Us / Our Service Section */
        .why-choose-us h2,
        .our-services h2 {
            font-size: 38px;
            font-weight: bold;
        }

        .why-choose-us h4,
        .our-services h4 {
            font-size: 30px;
            font-weight: bold;
        }

        
        .why-choose-us hr,
        .our-services hr {
            font-size: 30px;
            font-weight: bold;
        }

        .why-choose-us p,
        .our-services p {
            font-size: 28px;
        }

        .why-choose-us .row,
        .our-services .row {
            margin-top: 50px;
        }

        .why-choose-us .col-md-4,
        .our-services .col-md-4 {
            margin-bottom: 20px;
        }

        hr{
            color: white;
            border-top: 2px solid white; /* Thicker, bold line */
        }

        /* Style for images in Why Choose Us */
        .why-choose-us img {
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <?php include "inc/nav.inc.php" ?>

    <!-- About Us Section -->
    <section class="container my-5 about-section">
        <!-- Display Logo Image -->
        <img src="images/logo.png" alt="PEAK Logo" class="logo-img">
        <p>
            Welcome to PEAK, your trusted partner in car retail. We specialize in providing high-quality vehicles to suit a wide range of customer needs, from daily drivers to luxury models. 
            Our dedicated team works hard to ensure that every vehicle meets our customers' expectations for quality, performance, and value. 
            With years of experience in the car retail industry, we’ve earned a reputation for honesty, reliability, and excellent customer service.
            Whether you're looking for a sedan, SUV, truck, or a sports car, we have the perfect options for you. We provide full transparency, no hidden fees, and a seamless buying experience. 
            Your satisfaction is our top priority.
        </p>
    </section>

    <!-- Why Choose Us Section -->
    <section class="container my-5 why-choose-us">
        <h2 class="text-center mb-4">Why Choose Us?</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <!-- Image added above the text -->
                <img src="images/why-knowledge.png" alt="Expert Knowledge">
                <h4>Expert Knowledge</h4>
                <hr>
                <p>Our team of experts has extensive knowledge of the automotive industry and is here to guide you in choosing the best car for your needs.</p>
            </div>
            <div class="col-md-4 text-center">
                <!-- Image added above the text -->
                <img src="images/why-selection.png" alt="Wide Selection">
                <h4>Wide Selection</h4>
                <hr>
                <p>We offer a broad range of cars, from affordable models to luxury vehicles, ensuring that there is something for everyone.</p>
            </div>
            <div class="col-md-4 text-center">
                <!-- Image added above the text -->
                <img src="images/why-service.png" alt="Exceptional Service">
                <h4>Exceptional Service</h4>
                <hr>
                <p>Our customer service is second to none. We strive to provide a hassle-free and enjoyable car buying experience, from start to finish.</p>
            </div>
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="container my-5 our-services">
        <h2 class="text-center mb-4">Our Services</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <h4>Vehicle Sales</h4>
                <hr>
                <p>Browse our wide selection of vehicles, and find the one that fits your needs. We offer both new and pre-owned options to fit every budget.</p>
            </div>
            <div class="col-md-4 text-center">
                <h4>Financing Assistance</h4>
                <hr>
                <p>We work with multiple financial institutions to offer competitive financing options. Let us help you find the best financing plan for your car purchase.</p>
            </div>
            <div class="col-md-4 text-center">
                <h4>Vehicle Servicing</h4>
                <hr>    
                <p>We offer comprehensive car servicing to ensure your vehicle remains in top condition. From routine maintenance to major repairs, our certified technicians are here to help.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "inc/footer.inc.php" ?>

</body>

</html>
