<?php
$title = "FAQs";
include 'inc/head.inc.php';
include 'inc/nav.inc.php';
?>

<main class="container my-5 text-white">
    <h1 class="mb-4">Frequently Asked Questions</h1>

    <button class="faq-question">- What types of cars do you offer for rent?</button>
    <div class="faq-answer">
        We offer a wide variety of cars, including economy, luxury, SUVs, and family vehicles. You can view all available options when booking.
    </div>

    <button class="faq-question">+ What documents do I need to rent a car?</button>
    <div class="faq-answer">
        A valid driver’s license, an ID card or passport, and a valid credit or debit card are typically required.
    </div>

    <button class="faq-question">+ How old do I need to be to rent a car?</button>
    <div class="faq-answer">
        Most rental companies require renters to be at least 21 years old. Some vehicles may require the driver to be 25 or older.
    </div>

    <button class="faq-question">+ Can I rent a car without a credit card?</button>
    <div class="faq-answer">
        Some locations allow debit cards, but having a credit card is generally preferred and sometimes required.
    </div>

    <button class="faq-question">+ Can I extend my rental period?</button>
    <div class="faq-answer">
        Yes, you can extend your rental period by contacting us before your original return date.
    </div>

    <button class="faq-question">+ What happens if I return the car late?</button>
    <div class="faq-answer">
        Late returns may result in additional fees. It’s best to inform us ahead of time if you anticipate delays.
    </div>
</main>

<!-- Minimal toggle logic without design changes -->
<script>
    const questions = document.querySelectorAll(".faq-question");

    questions.forEach((btn) => {
        btn.addEventListener("click", function () {
            const answer = this.nextElementSibling;
            const isVisible = answer.style.display === "block";

            // Hide all answers
            document.querySelectorAll(".faq-answer").forEach((ans) => ans.style.display = "none");

            // Show or hide clicked one
            answer.style.display = isVisible ? "none" : "block";
        });
    });
</script>

<!-- Optional: Add this CSS to your main stylesheet if not already there -->
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
