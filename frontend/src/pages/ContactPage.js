import React, { useState } from 'react';

const ContactForm = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    message: '',
  });

  const [errors, setErrors] = useState({
    name: '',
    email: '',
    phone: '',
    message: '',
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const validateForm = () => {
    let formIsValid = true;
    let newErrors = { ...errors };

    // Validate Name
    if (!formData.name) {
      newErrors.name = 'Name is required.';
      formIsValid = false;
    } else {
      newErrors.name = '';
    }

    // Validate Phone
    const phonePattern = /^[0-9]{8}$/;
    if (!phonePattern.test(formData.phone)) {
      newErrors.phone = 'Please enter a valid phone number (only 8 digits allowed).';
      formIsValid = false;
    } else {
      newErrors.phone = '';
    }

    // Validate Email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.(com|org|net|edu|gov|io)$/;
    if (!emailPattern.test(formData.email)) {
      newErrors.email = 'Please enter a valid email address (e.g., user@domain.com).';
      formIsValid = false;
    } else {
      newErrors.email = '';
    }

    // Validate Message
    if (!formData.message) {
      newErrors.message = 'Message is required.';
      formIsValid = false;
    } else {
      newErrors.message = '';
    }

    setErrors(newErrors);
    return formIsValid;
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (validateForm()) {
      alert('Form submitted successfully');
      // You can send the form data to your server here.
    }
  };

  return (
    <div style={{ background: 'url(images/background.jpg) no-repeat', backgroundSize: 'cover', backgroundAttachment: 'fixed' }}>
      <div className="contact-header" style={{ textAlign: 'center', fontSize: '36px', marginTop: '50px', color: 'white' }}>
        <h2>Contact Us</h2>
      </div>

      <div id="ContactForm" style={{ padding: '40px', borderRadius: '10px', maxWidth: '600px', margin: '30px auto' }}>
        <form onSubmit={handleSubmit}>
          <div className="row">
            <div style={{ width: '48%', float: 'left', marginRight: '4%' }}>
              <label htmlFor="name" style={{ fontSize: '16px', marginBottom: '5px', display: 'block', color: 'white' }}>Name</label>
              <input
                type="text"
                id="name"
                name="name"
                value={formData.name}
                onChange={handleChange}
                style={{ width: '100%', padding: '10px', margin: '10px 0', border: '1px solid #ccc', borderRadius: '5px', fontSize: '16px', color: 'white', backgroundColor: '#333' }}
              />
              {errors.name && <p style={{ color: 'red' }}>{errors.name}</p>}
            </div>

            <div style={{ width: '48%', float: 'left' }}>
              <label htmlFor="email" style={{ fontSize: '16px', marginBottom: '5px', display: 'block', color: 'white' }}>Email*</label>
              <input
                type="email"
                id="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                style={{ width: '100%', padding: '10px', margin: '10px 0', border: '1px solid #ccc', borderRadius: '5px', fontSize: '16px', color: 'white', backgroundColor: '#333' }}
              />
              {errors.email && <p style={{ color: 'red' }}>{errors.email}</p>}
            </div>
          </div>

          <div className="row">
            <label htmlFor="phone" style={{ fontSize: '16px', marginBottom: '5px', display: 'block', color: 'white' }}>Phone</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              value={formData.phone}
              onChange={handleChange}
              style={{ width: '100%', padding: '10px', margin: '10px 0', border: '1px solid #ccc', borderRadius: '5px', fontSize: '16px', color: 'white', backgroundColor: '#333' }}
            />
            {errors.phone && <p style={{ color: 'red' }}>{errors.phone}</p>}
          </div>

          <div className="row">
            <label htmlFor="message" style={{ fontSize: '16px', marginBottom: '5px', display: 'block', color: 'white' }}>Message</label>
            <textarea
              id="message"
              name="message"
              value={formData.message}
              onChange={handleChange}
              rows="4"
              style={{ width: '100%', padding: '10px', margin: '10px 0', border: '1px solid #ccc', borderRadius: '5px', fontSize: '16px', color: 'white', backgroundColor: '#333' }}
            ></textarea>
            {errors.message && <p style={{ color: 'red' }}>{errors.message}</p>}
          </div>

          <button
            type="submit"
            style={{ padding: '10px 20px', backgroundColor: '#4CAF50', color: 'white', border: 'none', borderRadius: '5px', cursor: 'pointer', fontSize: '16px' }}
          >
            Submit
          </button>
        </form>
      </div>
    </div>
  );
};

export default ContactForm;
