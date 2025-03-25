// policy-refundPage.js

import React from 'react';
import BaseLayout from '../components/BaseLayout';

const PolicyRefundPage = () => {
  const title = "Refund Policy";  // Set the title of the page

  return (
    <div>
      {/* Main Content Area */}
      <div className="policy-main-content">
        <div className="policy-container">
          <h1 className="h1custom bold-text">{title}</h1>
          <p>We strive to provide the best experience for our customers. However, in the event that you need to cancel your reservation, the following refund policy applies:</p>

          <ul>
            <li><strong>Cancellation within 24 hours of booking:</strong> Full refund.</li>
            <li><strong>Cancellation 24 hours to 48 hours before rental start:</strong> 50% refund.</li>
            <li><strong>Cancellation less than 48 hours before rental start:</strong> No refund.</li>
          </ul>

          <p>If you encounter any issues with your rental vehicle that are covered under our warranty, we will offer a partial or full refund depending on the severity of the issue and the duration of the rental period.</p>

          <p>To request a refund, please contact our support team with your booking details and any relevant information. Refunds will be processed within 7 business days.</p>
        </div>
      </div>
    </div>
  );
};

export default PolicyRefundPage;
