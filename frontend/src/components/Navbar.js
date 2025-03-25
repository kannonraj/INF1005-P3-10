import React from 'react';
import { Navbar, Nav, NavDropdown, Container } from 'react-bootstrap';

function NavbarComponent() {
  return (
    <Navbar expand="lg" bg="dark" variant="dark">
      <Container fluid>
        <Navbar.Brand href="/">
          <img src="/images/logo.png" alt="logo" width="80" height="70" />
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <Nav.Link href="/">Home</Nav.Link>
            <Nav.Link href="/about">About Us</Nav.Link>

            <NavDropdown title="Rent A Car" id="basic-nav-dropdown">
              <NavDropdown.Item href="/cars">All Cars</NavDropdown.Item>
              <NavDropdown.Item href="/cars?category=sedan">Sedan</NavDropdown.Item>
              <NavDropdown.Item href="/cars?category=suv">SUV</NavDropdown.Item>
              <NavDropdown.Item href="/cars?category=hatchback">Hatchback</NavDropdown.Item>
              <NavDropdown.Item href="/cars?category=convertible">Convertible</NavDropdown.Item>
              <NavDropdown.Item href="/cars?category=coupe">Coupe</NavDropdown.Item>
              <NavDropdown.Item href="/cars?category=truck">Truck</NavDropdown.Item>
              <NavDropdown.Item href="/cars?category=minivan">Minivan</NavDropdown.Item>
            </NavDropdown>

            <Nav.Link href="/contact">Contact</Nav.Link>
          </Nav>

          <div className="d-flex ms-auto">
            <a href="/account" className="btn btn-outline-light me-2">
              <span className="material-icons">account_circle</span> Account
            </a>
          </div>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default NavbarComponent;
