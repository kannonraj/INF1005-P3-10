import React from 'react';

function AboutPage() {
  return (
    <div className="container mt-5">
      <h1 className="mb-4 text-center">About PEAK Car Rentals</h1>

      <p>
        At <strong>PEAK Car Rentals</strong>, we strive to provide a seamless and flexible car rental experience. Whether you're heading on a weekend getaway or need a daily commuter, we’ve got you covered with a wide range of vehicles — from sedans and SUVs to convertibles and trucks.
      </p>

      <p>
        Our platform is designed for convenience, letting you book, pay, and manage your rentals all in one place. With 24/7 availability and transparent pricing, you’re always in control.
      </p>

      <p>
        PEAK is powered by students from SIT who are passionate about making transportation smarter and simpler through web technologies.
      </p>

      <div className="text-center mt-4">
        <img
          src="https://cdn.pixabay.com/photo/2015/01/19/13/51/car-604019_1280.jpg"
          alt="About our service"
          className="img-fluid rounded shadow"
          style={{ maxHeight: '400px' }}
        />
      </div>
    </div>
  );
}

export default AboutPage;
