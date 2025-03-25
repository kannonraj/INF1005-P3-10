import React from 'react';
import { Navbar, Nav, NavDropdown, Container } from 'react-bootstrap';
import { Link } from 'react-router-dom';

function NavbarComponent() {
  return (
    <Navbar expand="lg" bg="dark" variant="dark">
      <Container fluid>
        <Navbar.Brand as={Link} to="/">
          <img src="/images/logo.png" alt="logo" width="80" height="70" />
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link as={Link} to="/">Home</Nav.Link>
            <Nav.Link as={Link} to="/about">About Us</Nav.Link>

            <NavDropdown title="Rent A Car" id="basic-nav-dropdown">
              <NavDropdown.Item as={Link} to="/cars">All Cars</NavDropdown.Item>
              <NavDropdown.Item as={Link} to="/cars?category=sedan">Sedan</NavDropdown.Item>
              <NavDropdown.Item as={Link} to="/cars?category=suv">SUV</NavDropdown.Item>
              <NavDropdown.Item as={Link} to="/cars?category=hatchback">Hatchback</NavDropdown.Item>
              <NavDropdown.Item as={Link} to="/cars?category=convertible">Convertible</NavDropdown.Item>
              <NavDropdown.Item as={Link} to="/cars?category=coupe">Coupe</NavDropdown.Item>
              <NavDropdown.Item as={Link} to="/cars?category=truck">Truck</NavDropdown.Item>
              <NavDropdown.Item as={Link} to="/cars?category=minivan">Minivan</NavDropdown.Item>
            </NavDropdown>

            <Nav.Link as={Link} to="/contact">Contact</Nav.Link>
          </Nav>

          <div className="d-flex ms-auto">
            <Link to="/account" className="btn btn-outline-light me-2">
              <span className="material-icons">account_circle</span> Account
            </Link>
          </div>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default NavbarComponent;
