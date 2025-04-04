<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "inc/head.inc.php"; ?>
    <title>FAQs | PEAK</title>
    <style>
        .faq-answer {
            display: none;
            background-color: #f5f5f5;
            color: black;
            padding: 12px;
            margin-bottom: 20px;
            border-left: 5px solid #007bff;
        }

        .faq-question {
            width: 100%;
            text-align: left;
            font-weight: bold;
            padding: 15px;
            margin-bottom: 5px;
            border: none;
            background-color: #eee;
            cursor: pointer;
        }
    </style>
</head>

<!--  Add flex column layout to stretch to bottom -->

<body class="d-flex flex-column min-vh-100">

    <?php include "inc/nav.inc.php"; ?>

    <main class="container my-5 text-white flex-grow-1">
        <h1 class="mb-4">Frequently Asked Questions</h1>

        <button class="faq-question">+ What types of cars do you offer for rent?</button>
        <section class="faq-answer">
            We offer a wide variety of cars, including economy, luxury, SUVs, and family vehicles. You can view all
            available options when booking.
        </section>

        <button class="faq-question">+ What documents do I need to rent a car?</button>
        <section class="faq-answer">
            A valid driver’s license, an ID card or passport, and a valid credit or debit card are typically required.
        </section>

        <button class="faq-question">+ How old do I need to be to rent a car?</button>
        <section class="faq-answer">
            Most rental companies require renters to be at least 21 years old. Some vehicles may require the driver to
            be 25 or older.
        </section>

        <button class="faq-question">+ Can I rent a car without a credit card?</button>
        <section class="faq-answer">
            Some locations allow debit cards, but having a credit card is generally preferred and sometimes required.
        </section>

        <button class="faq-question">+ Can I extend my rental period?</button>
        <section class="faq-answer">
            Yes, you can extend your rental period by contacting us before your original return date.
        </section>

        <button class="faq-question">+ What happens if I return the car late?</button>
        <section class="faq-answer">
            Late returns may result in additional fees. It’s best to inform us ahead of time if you anticipate delays.
        </section>
    </main>

    <?php include "inc/footer.inc.php"; ?>

    <script>
        const questions = document.querySelectorAll(".faq-question");

        questions.forEach((btn) => {
            btn.addEventListener("click", function () {
                const answer = this.nextElementSibling;
                const isVisible = answer.style.display === "block";

                // Hide all answers and reset button text
                document.querySelectorAll(".faq-answer").forEach((ans) => ans.style.display = "none");
                document.querySelectorAll(".faq-question").forEach((q) => q.textContent = "+ " + q.textContent.slice(2));

                // Show or hide clicked one
                if (!isVisible) {
                    answer.style.display = "block";
                    this.textContent = "- " + this.textContent.slice(2);  // Change "+" to "-"
                } else {
                    answer.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>