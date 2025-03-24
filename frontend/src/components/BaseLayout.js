import React from 'react';
import Navbar from './Navbar';
import Footer from './Footer';

function BaseLayout({ children }) {
  return (
    <div className="d-flex flex-column min-vh-100">
      <Navbar />
      <main className="flex-fill">
        <div className="container py-4">
          {children}
        </div>
      </main>
      <Footer />
    </div>
  );
}

export default BaseLayout;
