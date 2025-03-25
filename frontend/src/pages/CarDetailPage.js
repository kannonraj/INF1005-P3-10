import React, { useEffect, useState } from 'react';
import { useParams, useNavigate, Link } from 'react-router-dom';

function CarDetailsPage() {
  const { carId } = useParams();
  const navigate = useNavigate();
  const [car, setCar] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`/api/get_car_details.php?car_id=${carId}`)
      .then((res) => res.json())
      .then((data) => {
        setCar(data);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, [carId]);

  if (loading) return <p className="text-center mt-5">Loading car details...</p>;
  if (!car) return <p className="text-center mt-5 text-danger">Car not found.</p>;

  return (
    <div className="container mt-5">
      <div className="card shadow-lg">
        <img
          src={`/images/${car.image}`}
          alt={car.model}
          className="card-img-top"
          style={{ maxHeight: '400px', objectFit: 'cover' }}
        />
        <div className="card-body">
          <h3>{car.brand} {car.model} ({car.year})</h3>
          <p><strong>Category:</strong> {car.category}</p>
          <p><strong>Price per Day:</strong> ${car.price_per_day}</p>
          <p><strong>Description:</strong> {car.description || "No additional description."}</p>

          <Link to={`/book/${car.id}`} className="btn btn-success">
            Book This Car
          </Link>
        </div>
      </div>

      <div className="mt-5">
        <h4>Customer Reviews</h4>
        {/* Review section component (or PHP-generated HTML) can be embedded here */}
        <div className="alert alert-info">
          Review section coming soon or include from PHP if server-rendered.
        </div>
      </div>
    </div>
  );
}

export default CarDetailsPage;
