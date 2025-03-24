import React, { useState } from 'react';

function ContactPage() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  });
  const [success, setSuccess] = useState('');
  const [error, setError] = useState('');

  const handleChange = (e) => {
    setFormData(prev => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setSuccess('');
    setError('');

    try {
      const response = await fetch('/api/contact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
      const result = await response.json();

      if (result.success) {
        setSuccess('Your message has been sent!');
        setFormData({ name: '', email: '', message: '' });
      } else {
        setError(result.message || 'Something went wrong.');
      }
    } catch {
      setError('Failed to connect to server.');
    }
  };

  return (
    <div className="container mt-5">
      <h2 className="text-center mb-4">Contact Us</h2>

      <div className="card shadow p-4 mx-auto" style={{ maxWidth: '600px' }}>
        {success && <div className="alert alert-success">{success}</div>}
        {error && <div className="alert alert-danger">{error}</div>}

        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label className="form-label">Your Name:</label>
            <input
              type="text"
              name="name"
              className="form-control"
              required
              value={formData.name}
              onChange={handleChange}
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Your Email:</label>
            <input
              type="email"
              name="email"
              className="form-control"
              required
              value={formData.email}
              onChange={handleChange}
            />
          </div>

          <div className="mb-3">
            <label className="form-label">Message:</label>
            <textarea
              name="message"
              rows="5"
              className="form-control"
              required
              value={formData.message}
              onChange={handleChange}
            ></textarea>
          </div>

          <div className="d-grid">
            <button className="btn btn-primary" type="submit">
              Send Message
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

export default ContactPage;
