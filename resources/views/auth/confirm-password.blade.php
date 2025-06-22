<x-guest-layout>
    <!-- Camera Aperture Header -->
    <div class="auth-aperture">
        <div class="aperture-blades">
            @for ($i = 1; $i <= 8; $i++)
                <div class="blade blade-{{ $i }}"></div>
            @endfor
        </div>
        <div class="auth-lens-content">
            <h1>SECURE <span class="text-highlight">ACCESS</span></h1>
        </div>
    </div>

    <div class="view