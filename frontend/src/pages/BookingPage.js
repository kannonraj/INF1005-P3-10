import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';

function BookingPage() {
  const { carId } = useParams();
  const navigate = useNavigate();
  const [car, setCar] = useState(null);
  const [formData, setFormData] = useState({
    start_date: '',
    end_date: ''
  });
  const [error, setError] = useState('');

  useEffect(() => {
    fetch(`/api/get_car_details.php?car_id=${carId}`)
      .then((res) => res.json())
      .then((data) => setCar(data))
      .catch(() => setError("Unable to fetch car details."));
  }, [carId]);

  const handleChange = (e) => {
    setFormData((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch('/api/process_booking.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ car_id: carId, ...formData })
      });

      const result = await response.json();
      if (result.success) {
        navigate('/account');
      } else {
        setError(result.message || "Booking failed.");
      }
    } catch (err) {
      setError("Server error.");
    }
  };

  if (!car) return <p className="text-center mt-5">Loading car details...</p>;

  return (
    <div className="container mt-5">
      <h2 className="text-center mb-4">Book {car.brand} {car.model}</h2>

      <div className="card shadow p-4 mx-auto" style={{ maxWidth: '500px' }}>
        {error && <div className="alert alert-danger">{error}</div>}
        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label htmlFor="start_date" className="form-label">Start Date:</label>
            <input
              type="date"
              name="start_date"
              className="form-control"
              required
              onChange={handleChange}
            />
          </div>
          <div className="mb-3">
            <label htmlFor="end_date" className="form-label">End Date:</label>
            <input
              type="date"
              name="end_date"
              className="form-control"
              required
              onChange={handleChange}
            />
          </div>
          <button type="submit" className="btn btn-success w-100">Confirm Booking</button>
        </form>
      </div>
    </div>
  );
}

export default BookingPage;
