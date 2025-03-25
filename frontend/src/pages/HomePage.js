import React, { useState, useEffect } from 'react';
import '../styles/main.css';
import '../styles/HomePage.css';
import BaseLayout from '../components/BaseLayout';

function HomePage() {
  const [currentIndex, setCurrentIndex] = useState(0);
  const images = [
    { src: '/images/hero1.jpg', alt: 'Car Image 1' },
    { src: '/images/hero2.jpg', alt: 'Car Image 2' },
  ];

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentIndex((prevIndex) => (prevIndex + 1) % images.length);
    }, 5000); // Change image every 5 seconds

    return () => clearInterval(interval); // Clean up the interval on component unmount
  }, [images.length]);

  return (
      <div className="main-content">
        {/* Hero Section */}
        <div className="hero">
          {/* Overlay */}
          <div className="hero-overlay"></div>

          <div className="hero-images">
            {images.map((image, index) => (
              <img
                key={index}
                src={image.src}
                alt={image.alt}
                className={index === currentIndex ? 'active' : ''}
              />
            ))}
          </div>

          <div className="hero-content">
            <h1>Welcome to PEAK Car Rentals</h1>
            <p>Explore our wide range of cars and drive away in style!</p>
            <a href="#rentals" className="btn btn-primary">Browse Our Cars</a>
          </div>
        </div>

        {/* Sections Below Hero */}
        <div className="bg-white">
          <div className="section">
            <div className="section-image" style={{ backgroundImage: 'url(images/index1.jpg)' }}></div>
            <div className="section-content">
              <h2 className="tx-black tx-spacing-3">Rent a car in the day or at night</h2>
              <h2 className="tx-brand-03 mg-b-40">With 24/7 availability</h2>
              <p className="tx-black-7 tx-24">
                You can rent at your own pace for a minimum of 15 mins. On weekends or weekdays, at any time of the day.
              </p>
            </div>
          </div>
        </div>

        <div className="bg-black">
          <div className="section">
            <div className="section-image" style={{ backgroundImage: 'url(images/index2.jpg)' }}></div>
            <div className="section-content">
              <h2 className="tx-white tx-spacing-3 tx-brand-03">Wide Selection of Car Models</h2>
              <h2 className="tx-white mg-b-40">For Any Occasion Any Need</h2>
              <p className="tx-white tx-24">
                Whether you're going out with friends, family or need it for business or a date, we've got the right model for you.
              </p>
            </div>
          </div>
        </div>

        <div className="bg-white">
          <div className="section">
            <div className="section-image" style={{ backgroundImage: 'url(images/index3.jpg)' }}></div>
            <div className="section-content">
              <h2 className="tx-black tx-spacing-3">Cars Near The MRT Stations</h2>
              <h2 className="tx-brand-03 mg-b-40">Across The Island</h2>
              <p className="tx-black-7 tx-24">
                Rent without ranting. Most of our cars are located near the MRT stations. So now you can spend more time for things that matter in your life.
              </p>
            </div>
          </div>
        </div>
      </div>
  );
}

export default HomePage;
