// policy-warrantyPage.js

import React from 'react';
import BaseLayout from '../components/BaseLayout';


const PolicyWarrantyPage = () => {
  const title = "Warranty Policy";  // Set the title of the page

  return (
    <div>
      {/* Main Content Area */}
      <div className="policy-main-content">
        <div className="policy-container">
          <h1 className="h1custom bold-text">{title}</h1>
          <p>
            At [Your Company Name], we are committed to providing high-quality vehicles to our customers. We offer a limited warranty on all vehicles rented from us, ensuring that they are in good working condition.
          </p>
          <h5 className="h5custom bold-text">Our warranty covers the following:</h5>
          <ul>
            <li>Engine and transmission repairs</li>
            <li>Brake and suspension issues</li>
            <li>Electrical system problems</li>
            <li>Air conditioning system repairs</li>
          </ul>

          <h5 className="h5custom bold-text">Exclusions:</h5>
          <ul>
            <li>Damage caused by misuse or negligence</li>
            <li>Accidental damage</li>
            <li>Regular maintenance issues (e.g., tire wear, oil changes, etc.)</li>
          </ul>

          <p>
            If you experience any issues with the vehicle during your rental period, please contact our support team immediately to resolve the matter. Our warranty does not cover damages resulting from accidents, misuse, or improper handling.
          </p>
        </div>
      </div>
    </div>
  );
};

export default PolicyWarrantyPage;
