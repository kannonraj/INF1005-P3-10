import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

function CarListingsPage() {
  const [cars, setCars] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('/api/get_cars.php') // Adjust this to your backend route
      .then((res) => res.json())
      .then((data) => {
        setCars(data);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, []);

  return (
    <div className="container mt-5">
      <h2 className="text-center mb-4">Available Cars</h2>

      {loading && <p>Loading cars...</p>}

      {!loading && cars.length === 0 && (
        <div className="alert alert-warning">No available cars right now.</div>
      )}

      <div className="row">
        {cars.map((car) => (
          <div key={car.id} className="col-md-4 mb-4">
            <div className="card h-100 shadow-sm">
              <img
                src={`/images/${car.image}`} // assumes images are in /public/images/
                alt={car.model}
                className="card-img-top"
                style={{ height: '200px', objectFit: 'cover' }}
              />
              <div className="card-body">
                <h5 className="card-title">
                  {car.brand} {car.model}
                </h5>
                <p className="card-text">
                  <strong>Year:</strong> {car.year} <br />
                  <strong>Price:</strong> ${car.price_per_day}/day <br />
                  <strong>Category:</strong> {car.category}
                </p>
                <Link to={`/car/${car.id}`} className="btn btn-primary w-100">
                  View Details
                </Link>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default CarListingsPage;
