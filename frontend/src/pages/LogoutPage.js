import { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';

function Logout() {
  const navigate = useNavigate();

  useEffect(() => {
    // Call your PHP logout API to destroy session
    fetch('/api/logout.php', { method: 'POST' })
      .then(() => {
        // Redirect to homepage after logout
        navigate('/');
      });
  }, [navigate]);

  return (
    <div className="container text-center mt-5">
      <p>Logging you out...</p>
    </div>
  );
}

export default Logout;
