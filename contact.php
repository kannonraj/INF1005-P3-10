<?php
session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php" ?>
    <title>Contact Us | PEAK</title>

    <style>
        body {
            background: url('images/background.jpg') no-repeat;
            background-size: cover;
            background-attachment: fixed;
            color: white;
        }

        .contact-header {
            text-align: center;
            font-size: 36px;
            margin-top: 50px;
            color: white;
        }

        #ContactForm {
            padding: 40px;
            border-radius: 10px;
            max-width: 600px;
            margin: 30px auto;
        }

        #ContactForm h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
        }

        #ContactForm label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
            color: white;
        }

        #ContactForm input,
        #ContactForm textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            background-color: #333;
        }

        #ContactForm textarea {
            height: 120px;
            resize: vertical;
        }

        #ContactForm button {
            padding: 10px 20px;
            background-color: #2e7d32; /* Darker for contrast */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #ContactForm button:hover {
            background-color: #27682a;
        }

        .visually-hidden {
            position: absolute !important;
            height: 1px; width: 1px;
            overflow: hidden;
            clip: rect(1px, 1px, 1px, 1px);
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <?php include "inc/nav.inc.php"; ?>

    <!-- Main Content -->
    <main>
        <!-- Accessible hidden heading -->
        <h1 class="visually-hidden">Contact PEAK Car Rental</h1>

        <div class="container">
            <div class="contact-header">
                <h2>Contact Us</h2>
            </div>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                <div class="alert alert-success" style="color: green; text-align: center;">
                    Thank you for contacting us! We'll get back to you soon.
                </div>
            <?php endif; ?>

            <!-- Contact Form -->
            <section id="ContactForm" aria-labelledby="contact-form-heading">
                <h2 id="contact-form-heading" class="visually-hidden">Contact Us Form</h2>
                <form action="process_contact.php" method="POST" onsubmit="return validateForm()">
                    <div class="row">
                        <div style="width: 48%; float: left; margin-right: 4%;">
                            <label for="ContactForm-name">Name</label>
                            <input type="text" id="ContactForm-name" name="name" required>
                        </div>
                        <div style="width: 48%; float: left;">
                            <label for="ContactForm-email">Email*</label>
                            <input type="email" id="ContactForm-email" name="email" required>
                        </div>
                    </div>

                    <div class="row">
                        <label for="ContactForm-phone">Phone</label>
                        <input type="tel" id="ContactForm-phone" name="phone" required>
                    </div>

                    <div class="row">
                        <label for="ContactForm-message">Message</label>
                        <textarea id="ContactForm-message" name="message" rows="4" required></textarea>
                    </div>

                    <button type="submit">Submit</button>
                </form>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?php include "inc/footer.inc.php"; ?>

    <!-- JS Validation -->
    <script>
        function validateForm() {
            var phone = document.getElementById("ContactForm-phone").value;
            var phonePattern = /^[0-9]{8}$/;
            if (!phonePattern.test(phone)) {
                alert("Please enter a valid phone number (8 digits).");
                return false;
            }

            var email = document.getElementById("ContactForm-email").value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.(com|org|net|edu|gov|io)$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
