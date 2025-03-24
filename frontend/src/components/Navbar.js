import React from 'react';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';  // Ensure Bootstrap is included

function Navbar() {
  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
      <div className="container-fluid">
        {/* Logo */}
        <Link className="navbar-brand" to="/">
          <img src="images/logo.png" alt="logo" width="80" height="70" />
        </Link>

        {/* Toggler button for mobile */}
        <button 
          className="navbar-toggler" 
          type="button" 
          data-bs-toggle="collapse" 
          data-bs-target="#navbarNav" 
          aria-controls="navbarNav" 
          aria-expanded="false" 
          aria-label="Toggle navigation">
          <span className="navbar-toggler-icon"></span>
        </button>

        {/* Collapsible Navbar Links */}
        <div className="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul className="navbar-nav">
            <li className="nav-item">
              <Link className="nav-link" to="/">Home</Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" to="/about">About Us</Link>
            </li>

            {/* Rent A Car Dropdown */}
            <li className="nav-item dropdown">
              <Link 
                className="nav-link dropdown-toggle" 
                to="#" 
                id="navbarDropdown" 
                role="button" 
                data-bs-toggle="dropdown" 
                aria-expanded="false">
                Rent A Car
              </Link>
              <ul className="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><Link className="dropdown-item" to="/cars?category=all">All Cars</Link></li>
                <li><Link className="dropdown-item" to="/cars?category=sedan">Sedan</Link></li>
                <li><Link className="dropdown-item" to="/cars?category=suv">SUV</Link></li>
                <li><Link className="dropdown-item" to="/cars?category=hatchback">Hatchback</Link></li>
                <li><Link className="dropdown-item" to="/cars?category=convertible">Convertible</Link></li>
                <li><Link className="dropdown-item" to="/cars?category=coupe">Coupe</Link></li>
                <li><Link className="dropdown-item" to="/cars?category=truck">Truck</Link></li>
                <li><Link className="dropdown-item" to="/cars?category=minivan">Minivan</Link></li>
              </ul>
            </li>

            <li className="nav-item">
              <Link className="nav-link" to="/contact">Contact</Link>
            </li>
          </ul>
        </div>

        {/* Account and Cart Icons */}
        <div className="d-flex ms-auto">
          {/* Account Icon with Google Material Icon */}
          <Link to="/account" className="btn btn-outline-light me-2">
            <span className="material-icons">account_circle</span> Account
          </Link> 
        </div>
      </div>
    </nav>
  );
}

export default Navbar;
