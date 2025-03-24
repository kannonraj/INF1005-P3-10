import React from 'react';
import Navbar from './Navbar';
import Footer from './Footer';
import '../styles/main.css';

function BaseLayout({ children }) {
  return (
    <div>
      <Navbar />
      <main>
        <div>
          {children}
        </div>
      </main>
      <Footer />
    </div>
  );
}

export default BaseLayout;
