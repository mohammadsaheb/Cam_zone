@extends('layouts.app')
@section('content')

<section class="about-page">
    <div class="container">
        

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h2 class="hero-title">Capturing Your Moments, Creating Memories</h2>
                <p class="hero-text">Welcome to CamZone Studio, where passion meets photography. We believe that every moment tells a story, and our mission is to help you preserve those precious memories through the art of professional photography.</p>
            </div>
            <div class="hero-image">
                <img src="{{ asset('images/CamZone_studio.png') }}" alt="CamZone Studio" class="hero-img">
            </div>
        </div>

        <!-- Our Story -->
        <div class="story-section">
            <h2 class="section-title">Our Story</h2>
            <div class="story-content">
                <div class="story-text">
                    <p>Founded in 2010, CamZone Studio started with a simple vision: to provide high-quality photography services that capture the essence of every special moment. What began as a small studio has grown into a passionate team of photographers dedicated to excellence.</p>
                    <p>Over the years, we've been honored to document thousands of life's most important moments - from intimate portraits to grand celebrations, product showcases to family legacies.</p>
                </div>
            </div>
        </div>

        <!-- Behind the Scenes -->
        <div class="bts-section">
            <h2 class="section-title">Behind the Scenes</h2>
            <div class="bts-grid">
                <div class="bts-item">
                    <div class="bts-image-container">
                        <img src="{{ asset('images/setting.png') }}" alt="Setup" class="bts-img">
                    </div>
                    <p class="bts-description">Setting up a product shoot with attention to every detail.</p>
                </div>
                <div class="bts-item">
                    <div class="bts-image-container">
                        <img src="{{ asset('images/wedding.png') }}" alt="Lighting test" class="bts-img">
                    </div>
                    <p class="bts-description">Testing lighting and mood for a wedding shoot.</p>
                </div>
                <div class="bts-item">
                    <div class="bts-image-container">
                        <img src="{{ asset('images/editing.png') }}" alt="Post-processing" class="bts-img">
                    </div>
                    <p class="bts-description">Editing photos with professional-grade tools for stunning results.</p>
                </div>
            </div>
        </div>

        <!-- Our Services -->
        <div class="services-section">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3 class="service-title">Portrait Photography</h3>
                    <p class="service-description">Professional headshots and individual portraits that capture your unique personality.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="service-title">Family Sessions</h3>
                    <p class="service-description">Creating timeless family portraits that preserve your most cherished relationships.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <h3 class="service-title">Product Photography</h3>
                    <p class="service-description">Professional product imagery that showcases your products in the best light.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 class="service-title">Event Coverage</h3>
                    <p class="service-description">Complete documentation of your special events, corporate functions, and celebrations.</p>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="features-section">
            <h2 class="section-title">Why Choose CamZone Studio?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <h3 class="feature-title">Professional Excellence</h3>
                    <p class="feature-description">State-of-the-art equipment and techniques for the highest quality results.</p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Personalized Approach</h3>
                    <p class="feature-description">Every session is tailored to your unique needs and vision.</p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Quick Turnaround</h3>
                    <p class="feature-description">Receive your professionally edited photos within 7–10 business days.</p>
                </div>
                <div class="feature-card">
                    <h3 class="feature-title">Competitive Pricing</h3>
                    <p class="feature-description">Affordable packages without compromising on quality.</p>
                </div>
            </div>
        </div>

        <!-- Location & Contact -->
        <div class="location-section">
            <h2 class="section-title">Visit Our Studio</h2>
            <div class="location-container">
                <div class="location-info">
                    <h3 class="location-title">CamZone Studio</h3>
                    <div class="contact-details">
                        <p class="contact-item"><i class="fas fa-map-marker-alt"></i> 123 Photography Lane, Studio District</p>
                        <p class="contact-item"><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                        <p class="contact-item"><i class="fas fa-envelope"></i> info@camzonestudio.com</p>
                        <p class="contact-item"><i class="fas fa-clock"></i> Mon–Sat: 9:00 AM – 8:00 PM</p>
                        <p class="contact-item"><i class="fas fa-clock"></i> Sunday: By Appointment Only</p>
                    </div>
                </div>
               
            </div>
        </div>

        <!-- Call to Action -->
        <div class="cta-section">
            <h2 class="cta-title">Ready to Capture Your Story?</h2>
            <p class="cta-text">Book your photography session today and let us help you create lasting memories.</p>
            <a href="{{ route('bookings.create') }}" class="cta-button">Book a Session</a>
        </div>
    </div>
</section>

<style>
    /* Root Variables */
    :root {
        --primary-color: #000000;
        --secondary-color: #6c757d;
        --accent-color: #ffffff;
        --text-color: #444;
        --light-bg: #f9f9f9;
        --white: #ffffff;
        --border-radius: 12px;
        --transition: all 0.3s ease;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    /* General Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        
        line-height: 1.7;
        color: var(--text-color);
        background-color: var(--white);
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Typography */
    h1, h2, h3 {
        font-family: 'Playfair Display', serif;
        color: var(--primary-color);
        line-height: 1.2;
    }

    .main-title {
        font-size: 3.5rem;
        text-align: center;
        margin: 60px 0;
        position: relative;
    }

    .main-title::after {
        content: '';
        width: 100px;
        height: 4px;
        background: var(--accent-color);
        display: block;
        margin: 20px auto 0;
    }

    .section-title {
        font-size: 2.5rem;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .section-title::after {
        content: '';
        width: 60px;
        height: 3px;
        background: var(--secondary-color);
        display: block;
        margin: 10px auto 0;
    }

    /* Hero Section */
    .hero-section {
        display: flex;
        gap: 60px;
        align-items: center;
        margin-bottom: 100px;
        background: linear-gradient(to right, #f8f9fa, var(--light-bg));
        padding: 60px;
        border-radius: var(--border-radius);
        margin-top: 20px;
    }

    .hero-content {
        flex: 1;
    }

    .hero-title {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--primary-color);
    }

    .hero-text {
        font-size: 1.3rem;
        color: var(--text-color);
        font-weight: 300;
    }

    .hero-image {
        flex: 1;
    }

    .hero-img {
        width: 100%;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        transform: perspective(1000px) rotateY(-5deg);
        transition: var(--transition);
    }

    .hero-img:hover {
        transform: perspective(1000px) rotateY(0);
    }

    /* Story Section */
    .story-section {
        margin-bottom: 100px;
    }

    .story-content {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .story-text p {
        font-size: 1.3rem;
        margin-bottom: 20px;
        font-weight: 300;
    }

    /* Behind the Scenes */
    .bts-section {
        margin-bottom: 100px;
        background: var(--light-bg);
        padding: 80px 0;
    }

    .bts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .bts-item {
        background: var(--white);
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .bts-item:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .bts-image-container {
        position: relative;
        overflow: hidden;
    }

    .bts-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: var(--transition);
    }

    .bts-item:hover .bts-img {
        transform: scale(1.1);
    }

    .bts-description {
        padding: 20px;
        font-size: 1.1rem;
        color: var(--text-color);
        text-align: center;
    }

    /* Services Section */
    .services-section {
        margin-bottom: 100px;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .service-card {
        background: var(--white);
        padding: 40px;
        border-radius: var(--border-radius);
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border: 1px solid transparent;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--accent-color);
    }

    .service-icon {
        font-size: 3rem;
        color: var(--secondary-color);
        margin-bottom: 20px;
    }

    .service-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: var(--primary-color);
    }

    .service-description {
        font-size: 1.1rem;
        color: var(--text-color);
        font-weight: 300;
    }

    /* Features Section */
    .features-section {
        margin-bottom: 100px;
        background: #6c757d;
        color: var(--white);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
        border-radius: var(--border-radius);
    }

    .features-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('pattern.png') repeat;
        opacity: 0.05;
    }

    .features-section .section-title {
        color: var(--white);
    }

    .features-section .section-title::after {
        background: var(--accent-color);
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-top: 40px;
        position: relative;
        z-index: 1;
    }

    .feature-card {
        padding: 30px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius);
        transition: var(--transition);
    }

    .feature-card:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateY(-5px);
    }

    .feature-title {
        font-size: 1.3rem;
        margin-bottom: 15px;
        color: var(--accent-color);
    }

    .feature-description {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 300;
    }

    /* Location Section */
    .location-section {
        margin-bottom: 100px;
    }

    .location-container {
        display: flex;
        gap: 60px;
        align-items: center;
        background: var(--light-bg);
        padding: 60px;
        border-radius: var(--border-radius);
    }

    .location-info {
        flex: 1;
    }

    .location-title {
        font-size: 1.8rem;
        margin-bottom: 30px;
        color: var(--primary-color);
    }

    .contact-details {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1rem;
    }

    .contact-item i {
        color: var(--secondary-color);
        width: 20px;
        text-align: center;
    }

    .location-image {
        flex: 1;
    }

    .location-img {
        width: 100%;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        padding: 80px 40px;
        border-radius: var(--border-radius);
        text-align: center;
        color: var(--white);
        margin-top: 80px;
        margin-bottom: 40px;
    }

    .cta-title {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--white);
    }

    .cta-text {
        font-size: 1.2rem;
        margin-bottom: 30px;
        font-weight: 300;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-button {
        display: inline-block;
        padding: 15px 40px;
        background: var(--accent-color);
        color: var(--primary-color);
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: var(--transition);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        background: #f0c025;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-title {
            font-size: 2.5rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .hero-section,
        .location-container {
            flex-direction: column;
            padding: 40px 20px;
            gap: 30px;
        }

        .hero-title {
            font-size: 1.8rem;
        }

        .hero-img {
            transform: none;
        }

        .cta-title {
            font-size: 1.8rem;
        }

        .services-grid,
        .features-grid,
        .bts-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection
