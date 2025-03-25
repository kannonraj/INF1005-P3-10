import React, { useState } from 'react';
import BaseLayout from '../components/BaseLayout';

import '../styles/main.css';
import '../styles/faq.css';


const FaqPage = () => {
  const title = "Frequently Asked Questions"; // Page Title

  // State to manage the visibility of answers
  const [openFaqIndex, setOpenFaqIndex] = useState(null);

  const toggleFaq = (index) => {
    // Toggle the visibility of the answer based on the selected FAQ index
    if (openFaqIndex === index) {
      setOpenFaqIndex(null); // Close if the same FAQ is clicked again
    } else {
      setOpenFaqIndex(index); // Open the selected FAQ
    }
  };

  return (
    <div>

      <style>
        {`
.main-content {
  display: flex;
  flex-direction: column;
  flex: 1; /* Takes up all available space */
  justify-content: flex-start; /* Align content from top */
  margin-top:30px;
  margin-bottom: 20px;
}
        `}
      </style>
      {/* Main Content Area */}
      <div className="main-content">
        <div className="container">
          <h2>{title}</h2>

          <div className="faq-container">
            {/* FAQ Item 1 */}
            <div className="faq-item">
              <button
                className="faq-question"
                onClick={() => toggleFaq(0)}
              >
                What types of cars do you offer for rent?
              </button>
              {openFaqIndex === 0 && (
                <div className="faq-answer">
                  <p>
                    We offer a wide variety of cars, including economy, luxury, SUVs, and family vehicles. You can view all available options when booking.
                  </p>
                </div>
              )}
            </div>

            {/* FAQ Item 2 */}
            <div className="faq-item">
              <button
                className="faq-question"
                onClick={() => toggleFaq(1)}
              >
                What documents do I need to rent a car?
              </button>
              {openFaqIndex === 1 && (
                <div className="faq-answer">
                  <p>
                    You will need a valid driver's license, a credit card, and proof of insurance. International renters may also need a passport and an international driver's permit.
                  </p>
                </div>
              )}
            </div>

            {/* FAQ Item 3 */}
            <div className="faq-item">
              <button
                className="faq-question"
                onClick={() => toggleFaq(2)}
              >
                How old do I need to be to rent a car?
              </button>
              {openFaqIndex === 2 && (
                <div className="faq-answer">
                  <p>
                    The minimum age to rent a car is typically 21, though this may vary by location. Drivers under 25 may incur an additional surcharge.
                  </p>
                </div>
              )}
            </div>

            {/* FAQ Item 4 */}
            <div className="faq-item">
              <button
                className="faq-question"
                onClick={() => toggleFaq(3)}
              >
                Can I rent a car without a credit card?
              </button>
              {openFaqIndex === 3 && (
                <div className="faq-answer">
                  <p>
                    A credit card is typically required to rent a car. However, some locations may allow payment by debit card or cash with additional requirements.
                  </p>
                </div>
              )}
            </div>

            {/* FAQ Item 5 */}
            <div className="faq-item">
              <button
                className="faq-question"
                onClick={() => toggleFaq(4)}
              >
                Can I extend my rental period?
              </button>
              {openFaqIndex === 4 && (
                <div className="faq-answer">
                  <p>
                    Yes, you can extend your rental period. Please contact our customer service as early as possible to ensure availability and adjust the pricing accordingly.
                  </p>
                </div>
              )}
            </div>

            {/* FAQ Item 6 */}
            <div className="faq-item">
              <button
                className="faq-question"
                onClick={() => toggleFaq(5)}
              >
                What happens if I return the car late?
              </button>
              {openFaqIndex === 5 && (
                <div className="faq-answer">
                  <p>
                    If you return the car late, you may be charged additional fees based on the rental agreement. Please notify us if you anticipate being late to avoid extra charges.
                  </p>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default FaqPage;
