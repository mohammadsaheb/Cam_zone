<x-guest-layout>
    <!-- Camera Aperture Header -->
    <div class="auth-aperture">
        <div class="aperture-blades">
            @for ($i = 1; $i <= 8; $i++)
                <div class="blade blade-{{ $i }}"></div>
            @endfor
        </div>
        <div class="auth-lens-content">
            <!-- Logo -->
            <div class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="site-logo">
            </div>
            <h1>WELCOME <span class="btext-highlight">BACK</span></h1>
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="viewfinder-card">
        <div class="viewfinder-border">
            <div class="viewfinder-corner top-left"></div>
            <div class="viewfinder-corner top-right"></div>
            <div class="viewfinder-corner bottom-left"></div>
            <div class="viewfinder-corner bottom-right"></div>
            
            <div class="exposure-header">
                <span class="exposure-data">ISO 100</span>
                <span class="exposure-data">f/2.8</span>
                <span class="exposure-data">1/125s</span>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="focus-label">
                        <span>{{ __('Email') }}</span>
                        <div class="focus-ring"></div>
                    </x-input-label>
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="focus-label">
                        <span>{{ __('Password') }}</span>
                        <div class="focus-ring"></div>
                    </x-input-label>
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-500 shadow-sm focus:ring-amber-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-amber-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ml-3 bg-amber-500 hover:bg-amber-600">
                        <i class="fa fa-sign-in mr-2"></i> {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="auth-footer">
        <p>Don't have an account? <a href="{{ route('register') }}" class="text-highlight">Register</a></p>
        <div class="film-perforations">
            <div class="perforation"></div>
            <div class="perforation"></div>
            <div class="perforation"></div>
            <div class="perforation"></div>
            <div class="perforation"></div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Aperture animation on hover
        const aperture = document.querySelector('.auth-aperture');
        if (aperture) {
            aperture.addEventListener('mousemove', function(e) {
                const x = e.clientX / window.innerWidth;
                const y = e.clientY / window.innerHeight;
                
                const blades = document.querySelectorAll('.blade');
                blades.forEach((blade, index) => {
                    const scale = 0.8 + (x * 0.2);
                    const rotation = (index * 45) + (y * 10);
                    blade.style.transform = `rotate(${rotation}deg) translate(-50%, -50%)`;
                    blade.style.width = `${scale * 100}%`;
                    blade.style.height = `${scale * 100}%`;
                });
            });
        }
        
        // Focus effect on form fields
        const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                const label = this.previousElementSibling;
                if (label && label.classList.contains('focus-label')) {
                    const focusRing = label.querySelector('.focus-ring');
                    if (focusRing) {
                        focusRing.style.backgroundColor = '#f8ae3e';
                    }
                }
            });
            
            input.addEventListener('blur', function() {
                const label = this.previousElementSibling;
                if (label && label.classList.contains('focus-label')) {
                    const focusRing = label.querySelector('.focus-ring');
                    if (focusRing) {
                        focusRing.style.backgroundColor = 'transparent';
                    }
                }
            });
        });
    });
</script>

<style>
    /* Custom photography-themed styles */
    .auth-aperture {
        background-color:black;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        border-radius: 8px;
    }
    
    .aperture-blades {
        position: absolute;
        width: 100%;
        height: 100%;
    }
    
    .blade {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200%;
        height: 200%;
        background: #6c757d;
        transform-origin: 0 0;
        opacity: 0.9;
        transition: all 1s ease;
    }
    
    .blade-1 { transform: rotate(0deg) translate(-50%, -50%); }
    .blade-2 { transform: rotate(45deg) translate(-50%, -50%); }
    .blade-3 { transform: rotate(90deg) translate(-50%, -50%); }
    .blade-4 { transform: rotate(135deg) translate(-50%, -50%); }
    .blade-5 { transform: rotate(180deg) translate(-50%, -50%); }
    .blade-6 { transform: rotate(225deg) translate(-50%, -50%); }
    .blade-7 { transform: rotate(270deg) translate(-50%, -50%); }
    .blade-8 { transform: rotate(315deg) translate(-50%, -50%); }
    
    .auth-aperture:hover .blade {
        width: 80%;
        height: 80%;
    }
    
    .auth-lens-content {
        text-align: center;
        color: white;
        z-index: 10;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .auth-lens-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-top: 15px;
    }
    
    /* Logo Styling */
    .logo-container {
        margin-bottom: 10px;
        display: flex;
        justify-content: center; /* Center the logo */
        align-items: center;
        position: relative;
    }

    .site-logo {
        height: 80px; /* Slightly larger for better visibility */
        width: auto;
        filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.8));
        transition: transform 0.3s ease-in-out;
    }

    .site-logo:hover {
        transform: scale(1.1); /* Make logo slightly larger on hover */
    }

    @media (max-width: 768px) {
        .site-logo {
            height: 60px;
        }
    }

    @media (max-width: 480px) {
        .site-logo {
            height: 50px;
        }
    }

    .text-highlight {
        color: #6c757d;
    }
    .btext-highlight {
        color:rgb(255, 255, 255);
    }
   
    .viewfinder-card {
        position: relative;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(167, 32, 32, 0.1);
    }
    
    .viewfinder-border {
        position: relative;
        padding: 25px;
        border: 1px solid #ddd;
        margin: 15px;
        border-radius: 5px;
    }
    
    .viewfinder-corner {
        position: absolute;
        width: 20px;
        height: 20px;
        border-color:  #6c757d;
        border-style: solid;
        border-width: 0;
    }
    
    .top-left {
        top: 0;
        left: 0;
        border-top-width: 2px;
        border-left-width: 2px;
    }
    
    .top-right {
        top: 0;
        right: 0;
        border-top-width: 2px;
        border-right-width: 2px;
    }
    
    .bottom-left {
        bottom: 0;
        left: 0;
        border-bottom-width: 2px;
        border-left-width: 2px;
    }
    
    .bottom-right {
        bottom: 0;
        right: 0;
        border-bottom-width: 2px;
        border-right-width: 2px;
    }
    
    .exposure-header {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
        font-family: 'Courier New', monospace;
    }
    
    .exposure-data {
        background: rgba(0,0,0,0.1);
        color: #333;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        margin: 0 5px;
    }
    
    .focus-label {
        display: flex;
        align-items: center;
        font-weight: 600;
    }
    
    .focus-label span {
        margin-right: 10px;
    }
    
    .focus-ring {
        width: 10px;
        height: 10px;
        border: 1px solid  #6c757d;
        border-radius: 50%;
    }
    
    /* Override Breeze's default button colors */
    .bg-amber-500 {
        background-color: #6c757d !important;
    }
    
    .hover\:bg-amber-600:hover {
        background-color: #6c757d !important;
    }
    
    .text-amber-500 {
        color: #6c757d !important;
    }
    
    .focus\:ring-amber-500:focus {
        --ring-color: #6c757d !important;
    }
    
    /* Footer styling */
    .auth-footer {
        text-align: center;
        margin-top: 20px;
    }
    
    .auth-footer p {
        margin-bottom: 15px;
    }
    
    .film-perforations {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .perforation {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: transparent;
        border: 1px solid #666;
        margin: 0 5px;
    }
    
    /* Media queries for responsiveness */
    @media (max-width: 768px) {
        .auth-lens-content h1 {
            font-size: 2rem;
        }
        
        .site-logo {
            height: 50px;
        }
    }
    
    @media (max-width: 480px) {
        .auth-lens-content h1 {
            font-size: 1.5rem;
        }
        
        .site-logo {
            height: 40px;
        }
    }
</style>
