import React from 'react';
import { Link } from 'react-router-dom';
import './HomePage.css';

function HomePage() {
  return (
    <div>
      <header className="home-section text-white text-center">
        <div className="overlay">
          <h1 className="display-4 fw-bold">Welcome to PEAK Car Rentals</h1>
          <p className="lead">Explore our wide range of cars and drive away in style!</p>
          <Link to="/cars" className="btn btn-primary btn-lg mt-3">Browse Our Cars</Link>
        </div>
      </header>

      <section className="features container text-center mt-5">
        <div className="row align-items-center">
          <div className="col-md-6">
            <img
              src="https://cdn.pixabay.com/photo/2020/01/29/09/39/man-4806513_1280.jpg"
              alt="Drive happy"
              className="img-fluid rounded"
            />
          </div>
          <div className="col-md-6">
            <h2>RENT A CAR IN THE DAY OR AT NIGHT</h2>
            <h5 className="text-primary">WITH 24/7 AVAILABILITY</h5>
            <p className="text-muted">
              You can rent at your own pace for a minimum of 15 mins. On weekends or weekdays, at any time of the day.
            </p>
          </div>
        </div>
      </section>
    </div>
  );
}

export default HomePage;
