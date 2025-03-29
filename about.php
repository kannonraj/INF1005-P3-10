<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php" ?>
    <title>About Us | PEAK</title>

    <link rel="stylesheet" href="css/main.css">

    <style>
        /* Set background color for the entire page */
        body {
            color: white;
            font-family: Arial, sans-serif;
        }

        /* About Us Section */
        .about-section {
            text-align: center;
            margin: 20px auto;
        }

        .about-section p {
            font-size: 1.3rem;
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
            font-size: 28px;
            font-weight: bold;
        }

        .why-choose-us h4,
        .our-services h4 {
            font-size: 1.3rem;
            font-weight: bold;
        }

        .why-choose-us hr,
        .our-services hr {
            font-size: 1.3rem;
            font-weight: bold;
        }

        .why-choose-us p,
        .our-services p {
            font-size: 1.3rem;
        }

        .why-choose-us .row,
        .our-services .row {
            margin-top: 50px;
        }

        .why-choose-us .col-md-4,
        .our-services .col-md-4 {
            margin-bottom: 20px;
        }

        hr {
            color: white;
            border-top: 2px solid white; /* Thicker, bold line */
        }

        /* Style for images in Why Choose Us */
        .why-choose-us img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        /* Our Services Section */
        .service-box {
            background-size: cover;
            background-position: center;
            padding: 40px 20px; /* Increased padding for better layout */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0; /* Removed rounded edges */
            height: 450px; /* Increased height */
            width: 100%; /* Ensures the box spans the full width of its parent */
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distributes space evenly */
            text-align: center;
            position: relative;
        }

        

        .service-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6); /* Semi-transparent grey background */
            z-index: 1;
        }

        .service-box h4, .service-box p {
            z-index: 2;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Added text shadow */
        }

        .service-box h4 {
            margin-bottom: 15px;
        }

        .service-box p {
            margin-top: 10px;
        }

        .service-box hr {
            border-top: 2px solid white; /* White line between title and description */
            width: 60%;
            margin: 15px auto;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <?php include "inc/nav.inc.php" ?>

    <!-- About Us Section -->
    <section class="container my-5 about-section">
        <div class="policy-container" style="font-size: 0.85rem;">
            <!-- Display Logo Image -->
            <img src="images/logo.png" alt="PEAK Logo" class="logo-img">
            <p>
                Welcome to PEAK, your trusted partner in car retail. We specialize in providing high-quality vehicles to suit a wide range of customer needs, from daily drivers to luxury models. 
                Our dedicated team works hard to ensure that every vehicle meets our customers' expectations for quality, performance, and value. 
                With years of experience in the car retail industry, we’ve earned a reputation for honesty, reliability, and excellent customer service.
                Whether you're looking for a sedan, SUV, truck, or a sports car, we have the perfect options for you. We provide full transparency, no hidden fees, and a seamless buying experience. 
                Your satisfaction is our top priority.
            </p>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="container my-5 why-choose-us">
        <h2 class="text-center mb-4">Why Choose Us?</h2>
        <div class="policy-container" style="font-size: 0.85rem;">
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
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="container mt-0 mb-5 our-services">
        <h2 class="text-center mb-4">Our Services</h2>
        <div class="policy-container" style="font-size: 0.85rem;">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="service-box" style="background-image: url('images/service-sales.jpg');">
                        <h4>Vehicle Sales</h4>
                        <hr>
                        <p>Browse our wide selection of vehicles, and find the one that fits your needs. We offer both new and pre-owned options to fit every budget.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="service-box" style="background-image: url('images/service-finance.jpg');">
                        <h4>Financing Assistance</h4>
                        <hr>
                        <p>We work with multiple financial institutions to offer competitive financing options. Let us help you find the best financing plan for your car purchase.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="service-box" style="background-image: url('images/service-repair.jpg');">
                        <h4>Vehicle Servicing</h4>
                        <hr>    
                        <p>We offer comprehensive car servicing to ensure your vehicle remains in top condition. From routine maintenance to major repairs, our certified technicians are here to help.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "inc/footer.inc.php" ?>

</body>

</html>
