import React, { useEffect, useState } from 'react';

function AccountPage() {
  const [bookings, setBookings] = useState([]);
  const [loading, setLoading] = useState(true);
  const [flash, setFlash] = useState('');

  useEffect(() => {
    fetch('/api/get_user_bookings.php')
      .then(res => res.json())
      .then(data => {
        if (data.flash) setFlash(data.flash);
        setBookings(data.bookings || []);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, []);

  const handleCancel = async (bookingId) => {
    const confirm = window.confirm("Are you sure you want to cancel this booking?");
    if (!confirm) return;

    try {
      const res = await fetch('/api/cancel_booking.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ booking_id: bookingId })
      });
      const result = await res.json();
      if (result.success) {
        setBookings(prev => prev.filter(b => b.id !== bookingId));
      }
    } catch (err) {
      alert("Cancel failed.");
    }
  };

  return (
    <div className="container mt-5">
      <h2 className="mb-4 text-center">My Bookings</h2>

      {flash && (
        <div className="alert alert-success">{flash}</div>
      )}

      {loading ? (
        <p>Loading your bookings...</p>
      ) : bookings.length === 0 ? (
        <div className="alert alert-info">You have no bookings yet.</div>
      ) : (
        bookings.map((booking) => (
          <div key={booking.id} className="card mb-3 shadow-sm">
            <div className="card-body">
              <h5>{booking.brand} {booking.model} ({booking.year})</h5>
              <p>
                <strong>From:</strong> {booking.start_date} <br />
                <strong>To:</strong> {booking.end_date} <br />
                <strong>Status:</strong> {booking.status} <br />
                <strong>Payment:</strong>{' '}
                <span className={
                  booking.payment_status === 'completed' ? 'text-success fw-bold' :
                  booking.payment_status === 'pending' ? 'text-warning fw-bold' :
                  'text-danger fw-bold'
                }>
                  {booking.payment_status}
                </span>
              </p>

              {booking.status === 'active' && (
                <button className="btn btn-danger" onClick={() => handleCancel(booking.id)}>
                  Cancel Booking
                </button>
              )}
            </div>
          </div>
        ))
      )}
    </div>
  );
}

export default AccountPage;
