import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import BaseLayout from './components/BaseLayout';

import HomePage from './pages/HomePage';
import AboutPage from './pages/AboutPage';
import ContactPage from './pages/ContactPage';
import CarListingsPage from './pages/CarListingsPage';
import CarDetailPage from './pages/CarDetailPage';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';
import AccountPage from './pages/AccountPage';
import BookingPage from './pages/BookingPage';
import FaqPage from './pages/FaqPage';

import PolicyPrivacyPage from './pages/policy-privacyPage';
import PolicyRefundPage from './pages/policy-refundPage';
import PolicyTOSPage from './pages/policy-tosPage';
import PolicyWarrantyPage from './pages/policy-warrantyPage';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<BaseLayout><HomePage /></BaseLayout>} />
        <Route path="/about" element={<BaseLayout><AboutPage /></BaseLayout>} />
        <Route path="/contact" element={<BaseLayout><ContactPage /></BaseLayout>} />
        <Route path="/cars" element={<BaseLayout><CarListingsPage /></BaseLayout>} />
        <Route path="/car/:id" element={<BaseLayout><CarDetailPage /></BaseLayout>} />
        <Route path="/login" element={<BaseLayout><LoginPage /></BaseLayout>} />
        <Route path="/register" element={<BaseLayout><RegisterPage /></BaseLayout>} />
        <Route path="/account" element={<BaseLayout><AccountPage /></BaseLayout>} />
        <Route path="/booking" element={<BaseLayout><BookingPage /></BaseLayout>} />
        <Route path="/faq" element={<BaseLayout><FaqPage /></BaseLayout>} />

        <Route path="/privacy" element={<BaseLayout><PolicyPrivacyPage /></BaseLayout>} />
        <Route path="/refund" element={<BaseLayout><PolicyRefundPage /></BaseLayout>} />
        <Route path="/tos" element={<BaseLayout><PolicyTOSPage /></BaseLayout>} />
        <Route path="/warranty" element={<BaseLayout><PolicyWarrantyPage /></BaseLayout>} />
      </Routes>
    </Router>
  );
}

export default App;
