<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Header -->
    <?php include "inc/head.inc.php" ?>
    <title>Contact Us | PEAK</title>

    <style>
        body {
            background: url('images/background.jpg') no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-attachment: fixed;
            color: white;
            /* Make text white across the whole page */
        }

        /* Style for the Contact Us header */
        .contact-header {
            text-align: center;
            font-size: 36px;
            margin-top: 50px;
            /* Space above the header */
            color: white;
        }

        #ContactForm {
            padding: 40px;
            border-radius: 10px;
            max-width: 600px;
            margin: 30px auto;
            /* Space between header and form */
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
            /* Ensures label text is white */
        }

        #ContactForm-name,
        #ContactForm-email,
        #ContactForm-phone,
        #ContactForm-message {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            background-color: #333;
        }

        #ContactForm-name,
        #ContactForm-email,
        #ContactForm-phone {
            margin-bottom: 20px;
        }

        #ContactForm-message {
            height: 120px;
            resize: vertical;
            /* Allow users to resize the textarea vertically */
        }

        #ContactForm button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #ContactForm button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <?php include "inc/nav.inc.php"; ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container">

            <!-- Contact Us Header (Now outside the form) -->
            <div class="contact-header">
                <h2>Contact Us</h2>
            </div>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                <div class="alert alert-success" style="color: green; text-align: center;">
                    Thank you for contacting us! We'll get back to you soon.
                </div>
            <?php endif; ?>


            <!-- Contact Us Form -->
            <div id="ContactForm">
                <form action="process_contact.php" method="POST" onsubmit="return validateForm()">
                    <!-- Row 1: Name and Email -->
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

                    <!-- Row 2: Phone -->
                    <div class="row">
                        <label for="ContactForm-phone">Phone</label>
                        <input type="tel" id="ContactForm-phone" name="phone" required>
                    </div>

                    <!-- Row 3: Message -->
                    <div class="row">
                        <label for="ContactForm-message">Message</label>
                        <textarea id="ContactForm-message" name="message" rows="4" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "inc/footer.inc.php"; ?>

    <!-- JavaScript for Form Validation -->
    <script>
        function validateForm() {
            // Get the phone number input value
            var phone = document.getElementById("ContactForm-phone").value;

            // Check if phone contains only numbers and has a max length of 8
            var phonePattern = /^[0-9]{8}$/;
            if (!phonePattern.test(phone)) {
                alert("Please enter a valid phone number (only 8 digits allowed).");
                return false; // Prevent form submission
            }

            // Get the email value
            var email = document.getElementById("ContactForm-email").value;

            // Regex pattern to validate email, ensuring it ends with a valid domain like .com, .org, etc.
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.(com|org|net|edu|gov|io)$/;

            // Check if the email matches the pattern
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address (e.g., user@domain.com).");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>

</body>

</html>