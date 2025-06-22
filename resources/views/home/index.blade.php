@extends('layouts.app')

@section('content')
    <!-- Hero Section with Slider (Carousel) -->
<section class="hero-section">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Slide 1: Shop Now -->
            <div class="carousel-item active">
                <div class="container">
                    <div class="row hero-row">
                        <div class="col-lg-6 order-2 order-lg-1 text-dark hero-text">
                            <h1 class="hero-heading">Capture Your Perfect Moment</h1>
                            <p class="hero-subheading">Discover our premium collection of cameras and accessories</p>
                            <a href="{{ route('shop.index') }}" class="btn btn-secondary btn-lg hero-button">Shop Now</a>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 hero-image">
                            <img src="{{ asset('images/camera_hero.png') }}" class="img-fluid" alt="Featured Camera 1">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 2: Book Session -->
            <div class="carousel-item">
                <div class="container">
                    <div class="row hero-row">
                        <div class="col-lg-6 order-2 order-lg-1 text-dark hero-text">
                            <h1 class="hero-heading">Book Your Photoshoot Session</h1>
                            <p class="hero-subheading">Professional photography services tailored to your needs.</p>
                            <a href="{{ route('bookings.create') }}" class="btn btn-secondary btn-lg hero-button">Book Session</a>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 hero-image">
                            <img src="{{ asset('images/photoshoot.jpg') }}" class="img-fluid" alt="Featured Camera 2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
    
    <!-- Popular Cameras and Lenses Section for Home Page -->
<section class="popular-cameras-lenses py-5">
    <div class="container">
        <!-- Section Header with "Show All" Link -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-heading" id="popularSectionHeading">Popular Cameras & Lenses</h2>
            <!-- "Show All" Link that takes you to the Shop page -->
            <a href="{{ route('shop.index') }}" class="text-decoration-none" style="font-size: 1rem; color: #6c757d;">Show All</a>
        </div>

        <!-- Product Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($featuredProducts->take(4) as $product)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <div class="position-relative">
                            @if($product->is_featured)
                                <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2">Featured</span>
                            @endif
                            
                            <!-- Product Image -->
                            <div style="height: 200px; background-color: #f8f9fa; position: relative;">
                            @if($product->images && $product->images->count() > 0)
                                <img src="{{ $product->images->first()->image_url }}" 
                                    class="card-img-top" alt="{{ $product->name }}"
                                    style="height: 100%; width: 100%; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <i class="fas fa-camera text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                                                            
                                <!-- Quick Add to Cart -->
                                <div class="position-absolute bottom-0 end-0 m-2">
                                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-secondary btn-sm cart-btn">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->brand }}</p>
                            <div class="price-tag bg-secondary text-white d-inline-block px-2 py-1 mb-2" style="width: fit-content;">
                                <span class="fw-bold">{{ number_format($product->price, 3) }} JOD</span>
                            </div>
                            <p class="card-text flex-grow-1">{{ Str::limit($product->description, 80) }}</p>
                            <a href="{{ route('shop.product.show', $product->id) }}" class="btn btn-outline-secondary mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    <!-- Featured Brands Section -->
<section class="featured-brands py-5">
    <div class="container text-center">
        <!-- Section Header -->
        <h2 class="section-heading" id="brandsHeading">Featured Brands</h2>
        
        <section>
    <div class="container">
       
        
        <!-- Carousel/Brand Logos Slider -->
        <div id="brandsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <img src="https://1000logos.net/wp-content/uploads/2016/10/Canon-Logo.png" class="d-block w-100" alt="Canon">
                        </div>
                        <div class="col-2">
                            <img src="https://1000logos.net/wp-content/uploads/2021/05/Sony-logo.png" class="d-block w-100" alt="Sony">
                        </div>
                        <div class="col-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Nikon_Logo.svg/2048px-Nikon_Logo.svg.png" class="d-block w-100" alt="Nikon">
                        </div>
                        <div class="col-2">
                            <img src="https://logowik.com/content/uploads/images/dji3302.logowik.com.webp" class="d-block w-100" alt="Apple">
                        </div>
                        <div class="col-2">
                            <img src="https://download.logo.wine/logo/Pentax/Pentax-Logo.wine.png" class="d-block w-100" alt="Pentax">
                        </div>
                        <div class="col-2">
                            <img src="https://cdn.hasselblad.com/hasselblad-com/418e7df8-87fc-44e9-8bf4-1941b31ba362_logo_whitesq-01.jpg?auto=format&q=97" class="d-block w-100" alt="Hasselblad">
                        </div>
                    </div>
                </div>
                
            
        
           
            
            <!-- Carousel Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#brandsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#brandsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
        </div>
    </div>
</section>
    <!-- Booking Ideas Section -->
    <section class="booking-ideas py-5">
    <div class="container text-center">
        <h2 class="section-heading mb-4" id="bookingIdeasHeading">Booking Ideas</h2>
        <p class="lead">Looking for inspiration? Check out our top photoshoot ideas and book your session today!</p>

        <div class="row mt-4">
            <!-- Portrait Session Idea -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="https://th.bing.com/th/id/OIP.-DyP5tcK7RL8zinB_qeiowHaKV?rs=1&pid=ImgDetMain" class="card-img-top img-fluid" alt="Portrait Session" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Portrait Session</h5>
                        <p class="card-text">Capture your best self with a personalized portrait session, whether it's for a professional headshot or creative expression.</p>
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>

            <!-- Family Session Idea -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="https://anniedawson.com.au/wp-content/uploads/2023/05/Brisbane-Family-Photographer-256.jpg" class="card-img-top img-fluid" alt="Family Session" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Family Session</h5>
                        <p class="card-text">Create beautiful memories with your family in a relaxing photoshoot session at your favorite location.</p>
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>

            <!-- Product Photography Session Idea -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="https://m.media-amazon.com/images/I/51F5sDCCeQL._AC_UF894,1000_QL80_.jpg" class="card-img-top img-fluid" alt="Product Photography" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Product Photography</h5>
                        <p class="card-text">Showcase your products in the best light with high-quality, detailed product shots for your business or portfolio.</p>
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>

            <!-- Event Photography Session Idea -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img src="https://media.istockphoto.com/id/479977238/photo/table-setting-for-an-event-party-or-wedding-reception.jpg?s=612x612&w=0&k=20&c=yIKLzW7wMydqmuItTTtUGS5cYTmrRGy0rXk81AltdTA=" class="card-img-top img-fluid" alt="Event Photography" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Event Photography</h5>
                        <p class="card-text">Whether it's a wedding, party, or corporate event, we'll capture every special moment of your event.</p>
                        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Customer Reviews Section -->
<!-- Customer Reviews Section -->
<section class="customer-reviews py-5">
    <div class="container text-center">
        <h2 class="section-heading mb-4">What Our Customers Are Saying</h2>
        <p class="lead mb-5">See why our customers love Camzone! Check out their reviews and get inspired to start your own photography journey!</p>

        <div class="row justify-content-center">
            @foreach ($reviews as $review)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card review-card shadow-sm border-0 p-4">
                        <div class="card-body">
                          
                            <!-- Review Comment and Name -->
                            <p class="card-text" style="font-size: 1.2rem; font-style: italic;">"{{ $review->comment }}"</p>
                            <h5 class="card-title" style="font-size: 1.3rem; font-weight: bold; color: #333;">- {{ $review->user->name }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Newsletter Subscription Section -->
<section class="newsletter-subscribe py-5" style="background-color: #f4f4f4;">
    <div class="container text-center">
        <h2 class="section-heading mb-4">Subscribe Our Newsletter</h2>
        <p class="lead">Get updates for news, offers, and photography tips!</p>

        <!-- Subscription Form -->
        <div class="input-group mb-3" style="max-width: 500px; margin: 0 auto;">
            <input type="email" class="form-control" placeholder="Enter your email here" aria-label="Recipient's email" aria-describedby="subscribe-btn" required>
            <button class="btn btn-primary" type="button" id="subscribe-btn">
                <i class="fas fa-paper-plane"></i> Subscribe
            </button>
        </div>
    </div>
</section>


    


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Initialize both carousels with smooth transitions
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Carousel
        var heroCarousel = document.getElementById('heroCarousel');
        var bsHeroCarousel = new bootstrap.Carousel(heroCarousel, {
            interval: 5000,
            wrap: true,
            keyboard: true,
            touch: true
        });
        
        // Brands Carousel
        var brandsCarousel = document.getElementById('brandsCarousel');
        var bsBrandsCarousel = new bootstrap.Carousel(brandsCarousel, {
            interval: 3000,
            wrap: true,
            keyboard: true
        });
        
        // Add animation reset when slides change
        heroCarousel.addEventListener('slide.bs.carousel', function (e) {
            const activeItem = this.querySelector(".active");
            if (activeItem) {
                const heroText = activeItem.querySelector(".hero-text");
                const heroImage = activeItem.querySelector(".hero-image");
                
                if (heroText) heroText.style.animation = 'none';
                if (heroImage) heroImage.style.animation = 'none';
            }
        });
        
        heroCarousel.addEventListener('slid.bs.carousel', function (e) {
            const activeItem = this.querySelector(".active");
            if (activeItem) {
                const heroText = activeItem.querySelector(".hero-text");
                const heroImage = activeItem.querySelector(".hero-image");
                
                setTimeout(function() {
                    if (heroText) {
                        heroText.style.animation = '';
                        heroText.style.animationName = 'fadeInLeft';
                    }
                    if (heroImage) {
                        heroImage.style.animation = '';
                        heroImage.style.animationName = 'fadeInRight';
                    }
                }, 50);
            }
        });
    });
</script>








    <!-- Custom Styles -->
    <style>
        /* Hero Section Enhanced Styles */
.hero-section {
    background-color: #f8f9fa;
    overflow: hidden;
    position: relative;
    padding: 0;
}

.hero-row {
    min-height: 75vh;
    align-items: center;
}

.carousel-item {
    transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
}

.hero-text {
    animation-duration: 1s;
    animation-fill-mode: both;
    padding: 2rem;
    text-align: center;
}

.hero-image {
    animation-duration: 1s;
    animation-fill-mode: both;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

@media (min-width: 992px) {
    .hero-text {
        text-align: left;
    }
}

.carousel-item.active .hero-text {
    animation-name: fadeInUp;
}

.carousel-item.active .hero-image {
    animation-name: fadeInDown;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 50px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translate3d(0, -50px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@media (min-width: 992px) {
    .carousel-item.active .hero-text {
        animation-name: fadeInLeft;
    }

    .carousel-item.active .hero-image {
        animation-name: fadeInRight;
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translate3d(-50px, 0, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translate3d(50px, 0, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
}

.hero-heading {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #212529;
}

.hero-subheading {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    color: #495057;
}

.hero-button {
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
    border-radius: 50px;
    text-transform: uppercase;
    font-weight: 600;
    transition: all 0.3s ease;
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
}

.hero-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 8px rgba(0,0,0,0.15);
    background-color: #5a6268;
    border-color: #5a6268;
}

.hero-image img {
    max-height: 60vh;
    max-width: 100%;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

@media (min-width: 992px) {
    .hero-heading {
        font-size: 3.5rem;
    }
    
    .hero-subheading {
        font-size: 1.25rem;
    }
    
    .hero-image img {
        max-height: 75vh;
    }
}

/* Make carousel controls more visible */
.carousel-control-prev,
.carousel-control-next {
    width: 5%;
    opacity: 0.7;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(108, 117, 125, 0.5);
    border-radius: 50%;
    padding: 2rem;
}
        .product-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    /* Price tag styling */
    .price-tag {
        border-radius: 4px;
        background-color: #6c757d !important;
    }
    
    /* Button styling */
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-outline-secondary {
        color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
    
    /* Cart button styling */
    .cart-btn {
        transition: all 0.3s;
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .cart-btn:hover {
        background-color: #5a6268;
        transform: scale(1.1);
    }
    /* Custom styles for the brand logos */
    section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        
        .section-title h2 {
            font-size: 28px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
            position: relative;
        }
        
        .section-title h2::after {
            content: "";
            height: 3px;
            width: 70px;
            background-color: #007bff;
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        #brandsCarousel {
            margin: 20px auto;
        }
        
        #brandsCarousel .carousel-item img {
            height: 100px;
            object-fit: contain;
            transition: transform 0.3s ease;
            padding: 10px;
        }
        
        #brandsCarousel .carousel-item img:hover {
            transform: scale(1.05);
        }
        
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
            padding: 15px;
        }
        
        .carousel-indicators {
            bottom: -30px;
        }
        
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ccc;
            margin: 0 5px;
        }
        
        .carousel-indicators button.active {
            background-color: #007bff;
        }
        
        @media (max-width: 768px) {
            .col-2 {
                flex: 0 0 33.333%;
                max-width: 33.333%;
            }
        }
        
        @media (max-width: 576px) {
            .col-2 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
        /* Custom styles for Booking Ideas Section */
        .booking-ideas .card {
            border: none;
            border-radius: 10px;
        
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .booking-ideas .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .booking-ideas .card-text {
            font-size: 0.95rem;
            color: #555;
        }

        .booking-ideas .btn-primary {
            background-color: #6c757d;
            border-color:#6c757d;
        }

        .booking-ideas .btn-primary:hover {
            background-color:rgb(69, 71, 74);
            border-color:rgb(69, 71, 74);
        }
        /* Customer Reviews Section Styles */
    .customer-reviews .card {
        border-radius: 20px;
        background-color:rgb(220, 222, 222); /* Light background */
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        height: 250px; /* Set a fixed height for consistency */
    }

    .customer-reviews .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
    }

    .customer-reviews .card-body {
        padding: 1.5rem;
        flex-grow: 1; /* Ensures the content stretches to fill available space */
    }

    .customer-reviews .card-text {
        font-size: 1.2rem;
        font-style: italic;
        color: #333;
        margin-bottom: 1rem;
    }

    .customer-reviews .card-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
    }

    .customer-reviews .rounded-circle {
        border: 4px solid #3498db;
        margin-bottom: 1rem;
    }

    .customer-reviews .section-heading {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .customer-reviews .lead {
        font-size: 1.1rem;
        color: #777;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .customer-reviews .col-md-6 {
            max-width: 100%;
        }
    }
    /* Newsletter Section Styling */
.newsletter-subscribe {
    background-image: url('https://img.freepik.com/free-photo/top-view-photo-camera-indoors-still-life_23-2150630943.jpg?t=st=1745954457~exp=1745958057~hmac=390c2dc799858db81145d02a7e55bc5c5a9b99b06decb210592f95eb9ea0374d&w=1380'); /* Optional: Add a background image */
    background-size: cover;
    color: white;
    padding: 60px 0;
    position: relative;
    z-index: 1;
}

.newsletter-subscribe .section-heading {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.newsletter-subscribe .lead {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.input-group {
    display: flex;
    justify-content: center;
}

.input-group input {
    border-radius: 25px 0 0 25px;
    padding: 12px;
    font-size: 1rem;
    width: 75%;
}

.input-group button {
    border-radius: 0 25px 25px 0;
    font-size: 1rem;
    padding: 12px 20px;
    background-color:#6c757d;
    color: white;
    border: none;
    cursor: pointer;
}

.input-group button:hover {
    background-color: #2980b9;
}
    </style>
@endsection