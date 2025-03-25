import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import HomePage from './pages/HomePage';
import AboutPage from './pages/AboutPage';
import ContactPage from './pages/ContactPage';
import CarListingsPage from './pages/CarListingsPage';
import LoginPage from './pages/LoginPage';
import BaseLayout from './components/BaseLayout';
import PolicyWarrantyPage from './pages/policy-warrantyPage';
import PolicyTOSPage from './pages/policy-tosPage';
import PolicyPrivacyPage from './pages/policy-privacyPage';
import PolicyRefundPage from './pages/policy-refundPage';
import FaqPage from './pages/FaqPage';


function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<BaseLayout><HomePage /></BaseLayout>} />
        <Route path="/about" element={<BaseLayout><AboutPage /></BaseLayout>} />
        <Route path="/cars" element={<BaseLayout><CarListingsPage /></BaseLayout>} />
        <Route path="/login" element={<BaseLayout><LoginPage /></BaseLayout>} />
        <Route path="/contact" element={<BaseLayout><ContactPage /></BaseLayout>} />
        <Route path="/warranty" element={<BaseLayout><PolicyWarrantyPage/></BaseLayout>} />
        <Route path="/tos" element={<BaseLayout><PolicyTOSPage /></BaseLayout>} />
        <Route path="/privacy" element={<BaseLayout><PolicyPrivacyPage/></BaseLayout>} />
        <Route path="/refund" element={<BaseLayout><PolicyRefundPage/></BaseLayout>} />
        <Route path="/faq" element={<BaseLayout><FaqPage/></BaseLayout>} />
      </Routes>
    </Router>
  );
}

export default App;
