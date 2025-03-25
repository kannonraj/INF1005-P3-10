import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';

function RegisterPage() {
  const navigate = useNavigate();
  const [formData, setFormData] = useState({
    fname: '',
    lname: '',
    email: '',
    password: '',
    confirmPassword: ''
  });

  const [error, setError] = useState('');

  const handleChange = (e) => {
    setFormData((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    if (formData.password !== formData.confirmPassword) {
      setError('Passwords do not match.');
      return;
    }

    try {
      const response = await fetch('/api/process_register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });

      const result = await response.json();
      if (result.success) {
        navigate('/login');
      } else {
        setError(result.message || 'Registration failed.');
      }
    } catch (err) {
      setError('Server error.');
    }
  };

  return (
    <div className="container mt-5">
      <h2 className="text-center mb-4">Register</h2>
      <div className="card shadow p-4 mx-auto" style={{ maxWidth: '500px' }}>
        {error && <div className="alert alert-danger">{error}</div>}
        <form onSubmit={handleSubmit}>
          <div className="mb-3">
            <label htmlFor="fname" className="form-label">First Name:</label>
            <input type="text" className="form-control" name="fname" value={formData.fname} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <label htmlFor="lname" className="form-label">Last Name:</label>
            <input type="text" className="form-control" name="lname" value={formData.lname} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <label htmlFor="email" className="form-label">Email:</label>
            <input type="email" className="form-control" name="email" value={formData.email} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <label htmlFor="password" className="form-label">Password:</label>
            <input type="password" className="form-control" name="password" value={formData.password} onChange={handleChange} required />
          </div>
          <div className="mb-3">
            <label htmlFor="confirmPassword" className="form-label">Confirm Password:</label>
            <input type="password" className="form-control" name="confirmPassword" value={formData.confirmPassword} onChange={handleChange} required />
          </div>
          <div className="d-grid">
            <button type="submit" className="btn btn-success">Register</button>
          </div>
        </form>
      </div>
    </div>
  );
}

export default RegisterPage;
