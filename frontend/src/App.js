import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import HomePage from './pages/HomePage';
import AboutPage from './pages/AboutPage';
import CarListingsPage from './pages/CarListingsPage';
import LoginPage from './pages/LoginPage';
import BaseLayout from './components/BaseLayout';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<BaseLayout><HomePage /></BaseLayout>} />
        <Route path="/about" element={<BaseLayout><AboutPage /></BaseLayout>} />
        <Route path="/cars" element={<BaseLayout><CarListingsPage /></BaseLayout>} />
        <Route path="/login" element={<BaseLayout><LoginPage /></BaseLayout>} />
      </Routes>
    </Router>
  );
}

export default App;
