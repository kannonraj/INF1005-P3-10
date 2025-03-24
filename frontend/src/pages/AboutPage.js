import React from 'react';

const AboutUs = () => {
  return (
    <div style={{ backgroundColor: '#3c4a59', color: 'white', fontFamily: 'Arial, sans-serif' }}>


      {/* About Us Section */}
      <section className="container my-5 about-section" style={{ textAlign: 'center', margin: '20px auto' }}>
        {/* Display Logo Image */}
        <img src="images/logo.png" alt="PEAK Logo" className="logo-img" style={{ maxWidth: '350px', margin: '20px 0' }} />
        <p style={{ fontSize: '28px', textAlign: 'justify', margin: '0 auto' }}>
          Welcome to PEAK, your trusted partner in car retail. We specialize in providing high-quality vehicles to suit a wide range of customer needs, from daily drivers to luxury models.
          Our dedicated team works hard to ensure that every vehicle meets our customers' expectations for quality, performance, and value.
          With years of experience in the car retail industry, we’ve earned a reputation for honesty, reliability, and excellent customer service.
          Whether you're looking for a sedan, SUV, truck, or a sports car, we have the perfect options for you. We provide full transparency, no hidden fees, and a seamless buying experience.
          Your satisfaction is our top priority.
        </p>
      </section>

      {/* Why Choose Us Section */}
      <section className="container my-5 why-choose-us">
        <h2 className="text-center mb-4" style={{ fontSize: '38px', fontWeight: 'bold' }}>Why Choose Us?</h2>
        <div className="row">
          <div className="col-md-4 text-center" style={{ marginBottom: '20px' }}>
            <img src="images/why-knowledge.png" alt="Expert Knowledge" style={{ maxWidth: '200px', marginBottom: '20px' }} />
            <h4 style={{ fontSize: '30px', fontWeight: 'bold' }}>Expert Knowledge</h4>
            <hr style={{ color: 'white', borderTop: '2px solid white' }} />
            <p style={{ fontSize: '28px' }}>Our team of experts has extensive knowledge of the automotive industry and is here to guide you in choosing the best car for your needs.</p>
          </div>
          <div className="col-md-4 text-center" style={{ marginBottom: '20px' }}>
            <img src="images/why-selection.png" alt="Wide Selection" style={{ maxWidth: '200px', marginBottom: '20px' }} />
            <h4 style={{ fontSize: '30px', fontWeight: 'bold' }}>Wide Selection</h4>
            <hr style={{ color: 'white', borderTop: '2px solid white' }} />
            <p style={{ fontSize: '28px' }}>We offer a broad range of cars, from affordable models to luxury vehicles, ensuring that there is something for everyone.</p>
          </div>
          <div className="col-md-4 text-center" style={{ marginBottom: '20px' }}>
            <img src="images/why-service.png" alt="Exceptional Service" style={{ maxWidth: '200px', marginBottom: '20px' }} />
            <h4 style={{ fontSize: '30px', fontWeight: 'bold' }}>Exceptional Service</h4>
            <hr style={{ color: 'white', borderTop: '2px solid white' }} />
            <p style={{ fontSize: '28px' }}>Our customer service is second to none. We strive to provide a hassle-free and enjoyable car buying experience, from start to finish.</p>
          </div>
        </div>
      </section>

      {/* Our Services Section */}
      <section className="container my-5 our-services">
        <h2 className="text-center mb-4" style={{ fontSize: '38px', fontWeight: 'bold' }}>Our Services</h2>
        <div className="row">
          <div className="col-md-4 text-center" style={{ marginBottom: '20px' }}>
            <h4 style={{ fontSize: '30px', fontWeight: 'bold' }}>Vehicle Sales</h4>
            <hr style={{ color: 'white', borderTop: '2px solid white' }} />
            <p style={{ fontSize: '28px' }}>Browse our wide selection of vehicles, and find the one that fits your needs. We offer both new and pre-owned options to fit every budget.</p>
          </div>
          <div className="col-md-4 text-center" style={{ marginBottom: '20px' }}>
            <h4 style={{ fontSize: '30px', fontWeight: 'bold' }}>Financing Assistance</h4>
            <hr style={{ color: 'white', borderTop: '2px solid white' }} />
            <p style={{ fontSize: '28px' }}>We work with multiple financial institutions to offer competitive financing options. Let us help you find the best financing plan for your car purchase.</p>
          </div>
          <div className="col-md-4 text-center" style={{ marginBottom: '20px' }}>
            <h4 style={{ fontSize: '30px', fontWeight: 'bold' }}>Vehicle Servicing</h4>
            <hr style={{ color: 'white', borderTop: '2px solid white' }} />
            <p style={{ fontSize: '28px' }}>We offer comprehensive car servicing to ensure your vehicle remains in top condition. From routine maintenance to major repairs, our certified technicians are here to help.</p>
          </div>
        </div>
      </section>


    </div>
  );
};

export default AboutUs;
