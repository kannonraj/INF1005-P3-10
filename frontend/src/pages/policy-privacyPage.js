// policy-privacyPage.js

import React from 'react';
import BaseLayout from '../components/BaseLayout';

const PolicyPrivacyPage = () => {
  const title = "Privacy Policy";  // Set the title of the page

  return (
    <div>
      {/* Main Content Area */}
      <div className="policy-main-content">
        <div className="policy-container">
          <h1 className="h1custom bold-text">{title}</h1>
          <p>Your privacy is important to us. This privacy policy outlines the types of personal information we collect and how it is used.</p>

          <h4 className="h4custom bold-text">Information We Collect</h4>
          <p>When you make a reservation or contact us, we collect the following personal information:</p>
          <ul>
            <li>Name</li>
            <li>Email address</li>
            <li>Phone number</li>
            <li>Payment information</li>
          </ul>

          <h4 className="h4custom bold-text">How We Use Your Information</h4>
          <p>We use your personal information to:</p>
          <ul>
            <li>Process your rental bookings</li>
            <li>Communicate with you about your rental</li>
            <li>Improve our services</li>
            <li>Provide customer support</li>
          </ul>

          <h4 className="h4custom bold-text">Data Security</h4>
          <p>We take reasonable precautions to protect your information. We use secure servers and encryption methods to safeguard your personal data.</p>

          <h4 className="h4custom bold-text">Sharing Your Information</h4>
          <p>We will not sell, rent, or share your personal information with third parties unless required by law or to facilitate the processing of your rental.</p>

          <h4 className="h4custom bold-text">Your Rights</h4>
          <p>You have the right to access, correct, or request deletion of your personal information. If you wish to exercise these rights, please contact our customer support team.</p>
        </div>
      </div>
    </div>
  );
};

export default PolicyPrivacyPage;
