<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <!-- About Us Section with Logo -->
            <div class="col-md-4 mb-3">
                <div class="logo-container mb-3">
                    <img src="{{ asset('images/logo2.png') }}" alt="CamZone Logo" class="img-fluid" style="max-width: 180px;">
                </div>
                <p>CamZone is your one-stop shop for all things photography. We offer the best cameras, lenses, and accessories to make your photography experience unforgettable.</p>
            </div>

            <!-- Quick Links Section -->
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Home</a></li>
                    <li><a href="#" class="text-white">Shop</a></li>
                    <li><a href="#" class="text-white">Booking</a></li>
                    <li><a href="#" class="text-white">About Us</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="col-md-4 mb-3">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-phone-alt"></i> +1 234 567 890</li>
                    <li><i class="fas fa-envelope"></i> support@camzone.com</li>
                </ul>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="row mt-3">
            <div class="col text-center">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center mt-4">
            <p>&copy; 2025 CamZone. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<!-- Custom Styles -->
<style>
    footer {
        background-color:rgb(87, 129, 165); /* Dark background for the footer */
    }

    footer a {
        text-decoration: none;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: #3498db; /* Blue color for hover */
    }

    footer i {
        margin-right: 10px;
    }
    
    .logo-container {
        display: flex;
        align-items: center;    
        
        
    }
    
    /* Ensure responsiveness on smaller screens */
    @media (max-width: 767px) {
        .logo-container {
            justify-content: center;
            margin-bottom: 1rem;
        }
    }
</style>