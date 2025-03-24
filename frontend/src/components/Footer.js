import React from 'react';

function Footer() {
  return (
    <footer className="container-fluid mt-2 py-4 bg-dark text-white">
      <div className="row justify-content-center">
        {/* Company Column */}
        <div className="col-md-3 text-center">
          <h5>COMPANY</h5>
          <ul className="list-unstyled">
            <li><a href="/about" className="text-white">About Us</a></li>
          </ul>
        </div>

        {/* Rentals Column */}
        <div className="col-md-3 text-center">
          <h5>RENTALS</h5>
          <ul className="list-unstyled">
            <li><a href="#" className="text-white">Rent a Car</a></li>
          </ul>
        </div>

        {/* Policy Column */}
        <div className="col-md-3 text-center">
          <h5>POLICY</h5>
          <ul className="list-unstyled">
            <li><a href="/warranty" className="text-white">Warranty Policy</a></li>
            <li><a href="/refund" className="text-white">Refund Policy</a></li>
            <li><a href="/privacy" className="text-white">Privacy Policy</a></li>
            <li><a href="/tos" className="text-white">Terms of Service</a></li>
          </ul>
        </div>

        {/* Support Column */}
        <div className="col-md-3 text-center">
          <h5>SUPPORT</h5>
          <ul className="list-unstyled">
            <li><a href="/contact" className="text-white">Contact Us</a></li>
            <li><a href="/faq" className="text-white">FAQs</a></li>
          </ul>
        </div>
      </div>

      <hr />

      {/* Copyright Notice */}
      <div className="text-center mt-4">
        <p>Copyright &copy; 2025 P3-10 Assignment</p>
      </div>
    </footer>
  );
}

export default Footer;
