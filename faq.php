<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php include "inc/head.inc.php"; ?>

<body>

  <!-- Navigation -->
  <?php include "inc/nav.inc.php"; ?>

  <!-- Main Content Area -->
  <div class="main-content">
    <!-- Content of the page goes here -->
    <div class="container">
      <h2>Frequently Asked Questions</h2>

      <div class="faq-container">
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(0)">
            + What types of cars do you offer for rent?
          </button>
          <div class="faq-answer" id="faq-answer-0">
            <p>We offer a wide variety of cars, including economy, luxury, SUVs, and family vehicles. You can view all available options when booking.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(1)">
            + What documents do I need to rent a car?
          </button>
          <div class="faq-answer" id="faq-answer-1">
            <p>You will need a valid driver's license, a credit card, and proof of insurance. International renters may also need a passport and an international driver's permit.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(2)">
            + How old do I need to be to rent a car?
          </button>
          <div class="faq-answer" id="faq-answer-2">
            <p>The minimum age to rent a car is typically 21, though this may vary by location. Drivers under 25 may incur an additional surcharge.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(3)">
            + Can I rent a car without a credit card?
          </button>
          <div class="faq-answer" id="faq-answer-3">
            <p>A credit card is typically required to rent a car. However, some locations may allow payment by debit card or cash with additional requirements.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(4)">
            + Can I extend my rental period?
          </button>
          <div class="faq-answer" id="faq-answer-4">
            <p>Yes, you can extend your rental period. Please contact our customer service as early as possible to ensure availability and adjust the pricing accordingly.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(5)">
            + What happens if I return the car late?
          </button>
          <div class="faq-answer" id="faq-answer-5">
            <p>If you return the car late, you may be charged additional fees based on the rental agreement. Please notify us if you anticipate being late to avoid extra charges.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include "inc/footer.inc.php"; ?>

  <!-- JavaScript to handle the dropdown behavior -->
  <script>
    function toggleFaq(index) {
      var answer = document.getElementById("faq-answer-" + index);
      var allAnswers = document.querySelectorAll(".faq-answer");
      var allQuestions = document.querySelectorAll(".faq-question");

      // Close all answers
      allAnswers.forEach(function (ans) {
        ans.style.display = "none";
      });

      // Close all questions (collapse signs)
      allQuestions.forEach(function (question) {
        question.innerHTML = "+ " + question.innerHTML.substring(2);
      });

      // Open the selected answer if it wasn't open already
      if (answer.style.display === "none" || answer.style.display === "") {
        answer.style.display = "block";
        allQuestions[index].innerHTML = "- " + allQuestions[index].innerHTML.substring(2);
      }
    }
  </script>

</body>

</html>
    