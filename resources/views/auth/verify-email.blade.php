<x-guest-layout>
    <!-- Camera Aperture Header -->
    <div class="auth-aperture">
        <div class="aperture-blades">
            @for ($i = 1; $i <= 8; $i++)
                <div class="blade blade-{{ $i }}"></div>
            @endfor
        </div>
        <div class="auth-lens-content">
            <h1>CONFIRM <span class="text-highlight">VIEW</span></h1>
        </div>
    </div>

    <div class="viewfinder-card">
        <div class="viewfinder-border">
            <div class="viewfinder-corner top-left"></div>
            <div class="viewfinder-corner top-right"></div>
            <div class="viewfinder-corner bottom-left"></div>
            <div class="viewfinder-corner bottom-right"></div>
            
            <div class="exposure-header">
                <span class="exposure-data">ISO 160</span>
                <span class="exposure-data">f/3.5</span>
                <span class="exposure-data">1/80s</span>
            </div>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-primary-button class="bg-amber-500 hover:bg-amber-600">
                            <i class="fa fa-envelope mr-2"></i> {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-amber-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="auth-footer">
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
    });
</script>

<style>
    /* Custom photography-themed styles */
    .auth-aperture {
        background-color: #000;
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
        background: #000;
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
    }
    
    .auth-lens-content h1 {
        font-size: 2.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
    }
    
    .text-highlight {
        color:white;
    }
    
    .viewfinder-card {
        position: relative;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
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
        border-color: #6c757d;
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
    
    /* Override Breeze's default button colors */
    .bg-amber-500 {
        background-color:  #6c757d !important;
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
</style>