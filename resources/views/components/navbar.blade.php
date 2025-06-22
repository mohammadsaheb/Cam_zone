<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="CamZone Logo" class="navbar-logo">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bookings.create') }}">Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About Us</a>
                </li>
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout-btn">
                                        <span><i class="fas fa-sign-out-alt me-2"></i> Logout</span>
                                    </button>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </li>

                <!-- Cart Icon -->
                <li class="nav-item">
    <a class="nav-link" href="{{ route('cart.view') }}">
        <i class="fas fa-shopping-cart" style="font-size: 1.5rem;"></i>
        <!-- Cart item count -->
        <span class="badge bg-danger" style="position: absolute; top: -5px; right: -10px; font-size: 10px;">
            {{ $cartItemCount ?? 0 }}
        </span>
    </a>
</li>

            </ul>

            <!-- Search Bar -->
            <form class="d-flex ms-3" action="" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search for products..." aria-label="Search" name="query">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>

<!-- Custom Styles -->
<style>
    .navbar {
        background-color: #fff;
        border-bottom: 2px solid #eee; /* Light border at the bottom */
    }
    
    .navbar-light .navbar-nav .nav-link {
        color: #333; /* Dark text color for navbar links */
        font-weight: 500;
        padding: 10px 15px;
        position: relative;
        transition: color 0.3s ease-in-out, border-bottom 0.3s ease-in-out;
    }
    
    .navbar-light .navbar-nav .nav-link:hover {
        color: #000; /* Black color when hovered */
    }

    /* Underline effect on hover */
    .navbar-light .navbar-nav .nav-link:hover::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px; /* Thickness of the underline */
        background-color: #000; /* Black underline */
    }

    .navbar-light .navbar-nav .nav-item.active .nav-link {
        color: #000 !important; /* Black for active link */
    }

    .navbar-light .navbar-nav .dropdown-menu {
        background-color: #fff;
        border: 1px solid #ddd; /* Border around dropdown */
        box-shadow: 0 4px 6px rgba(230, 226, 226, 0.1);
    }

    .navbar-logo {
        height: 40px;
        width: auto;
        transition: transform 0.3s ease;
    }

    .navbar-logo:hover {
        transform: scale(1.1); /* Logo zoom effect on hover */
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    .navbar-toggler {
        border-color: #ccc; /* Toggler border color */
    }

   

    .navbar-nav .nav-item {
        margin-left: 15px;
    }

    /* Cart Icon color */
    .nav-item .fa-shopping-cart {
        color: #333;
    }

    .nav-item .fa-shopping-cart:hover {
        color: #000; /* Cart icon hover color */
    }

    /* Custom style for the search bar */
    .navbar .form-control {
        width: 250px;
        border-radius: 25px;
    }

    .navbar .btn-outline-secondary {
        border-radius: 25px;
        background-color: #6c757d;
        color: white;
    }

    .navbar .btn-outline-secondary:hover {
        background-color: #6c757d;
    }
    
    /* Logout button styling */
    .logout-btn {
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .logout-btn:hover {
        background-color: #f8f9fa;
    }
    
    .logout-btn:focus {
        outline: none;
    }
</style>