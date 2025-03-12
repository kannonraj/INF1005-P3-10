<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <!-- Logo on the left -->
        <a class="navbar-brand" href="index.php">
    <img src="images/logo.png" alt="logo" width="80" height="70"/>
</a>


        <!-- Toggler button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <!-- Rent A Car dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Rent A Car
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Sedan</a></li>
                        <li><a class="dropdown-item" href="#">SUV</a></li>
                        <li><a class="dropdown-item" href="#">Hatchback</a></li>
                        <li><a class="dropdown-item" href="#">Convertible</a></li>
                        <li><a class="dropdown-item" href="#">Coupe</a></li>
                        <li><a class="dropdown-item" href="#">Truck</a></li>
                        <li><a class="dropdown-item" href="#">Minivan</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Right-side Account and Cart Icons -->
        <div class="d-flex ms-auto">
            <!-- Account Icon with Google Material Icon -->
            <a href="account.php" class="btn btn-outline-light me-2">
                <span class="material-icons">account_circle</span> Account
            </a>

            <!-- Cart Icon with Google Material Icon -->
            <a href="cart.php" class="btn btn-outline-light">
                <span class="material-icons">shopping_cart</span> Cart
            </a>
        </div>
    </div>
</nav>
