<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CamZone')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #4CAF50;
            --accent-color: #f0f0f0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar Component -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.Footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        // This file can be placed in your public/js folder
// In your app.js or a separate cart.js file

document.addEventListener('DOMContentLoaded', function() {
    // Handle quantity increment/decrement
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    
    if (quantityBtns) {
        quantityBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const input = this.closest('.input-group').querySelector('.quantity-input');
                let value = parseInt(input.value);
                
                if (this.dataset.action === 'increase') {
                    value++;
                } else if (this.dataset.action === 'decrease' && value > 1) {
                    value--;
                }
                
                input.value = value;
                
                // Auto-update cart after a short delay (optional)
                if (this.closest('form').querySelector('.update-cart-btn')) {
                    setTimeout(() => {
                        this.closest('form').querySelector('.update-cart-btn').click();
                    }, 500);
                }
            });
        });
    }
    
    // Add to cart animation (for product pages)
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');
    
    if (addToCartForms) {
        addToCartForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // You can add animation here
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;
                
                button.innerHTML = '<i class="bi bi-check-circle"></i> Added!';
                button.classList.add('btn-success');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('btn-success');
                }, 2000);
                
                // If you want to prevent form submission and use AJAX instead
                // e.preventDefault();
                // Then add your AJAX code here
            });
        });
    }
    
    // Cart item removal confirmation
    const removeButtons = document.querySelectorAll('.btn-danger');
    
    if (removeButtons) {
        removeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to remove this item from your cart?')) {
                    e.preventDefault();
                }
            });
        });
    }
});
    </script>

</body>
</html>