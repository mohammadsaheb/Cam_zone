// resources/js/app.js

// Import dependencies
import './bootstrap';
import Alpine from 'alpinejs';

// Initialize AlpineJS
window.Alpine = Alpine;
Alpine.start();

// Global JavaScript functions

// Product image gallery functionality
document.addEventListener('DOMContentLoaded', function() {
    const productThumbnails = document.querySelectorAll('.product-thumbnail');
    const mainProductImage = document.querySelector('.main-product-image');
    
    if (productThumbnails.length && mainProductImage) {
        productThumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Update main image src
                mainProductImage.src = this.src;
                
                // Update active state
                productThumbnails.forEach(thumb => thumb.classList.remove('ring-2', 'ring-yellow-500'));
                this.classList.add('ring-2', 'ring-yellow-500');
            });
        });
    }
});

// Shopping cart functionality
class ShoppingCart {
    constructor() {
        this.items = JSON.parse(localStorage.getItem('cart')) || [];
        this.updateCartCount();
    }
    
    addItem(product) {
        const existingItemIndex = this.items.findIndex(item => item.id === product.id);
        
        if (existingItemIndex > -1) {
            this.items[existingItemIndex].quantity += 1;
        } else {
            this.items.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                quantity: 1
            });
        }
        
        this.saveCart();
        this.updateCartCount();
        
        // Show notification
        this.showNotification(`${product.name} added to cart`);
    }
    
    removeItem(productId) {
        this.items = this.items.filter(item => item.id !== productId);
        this.saveCart();
        this.updateCartCount();
    }
    
    updateQuantity(productId, quantity) {
        const itemIndex = this.items.findIndex(item => item.id === productId);
        
        if (itemIndex > -1) {
            if (quantity <= 0) {
                this.removeItem(productId);
            } else {
                this.items[itemIndex].quantity = quantity;
                this.saveCart();
            }
        }
    }
    
    getTotal() {
        return this.items.reduce((total, item) => {
            return total + (item.price * item.quantity);
        }, 0);
    }
    
    clearCart() {
        this.items = [];
        this.saveCart();
        this.updateCartCount();
    }
    
    saveCart() {
        localStorage.setItem('cart', JSON.stringify(this.items));
    }
    
    updateCartCount() {
        const cartCountElements = document.querySelectorAll('.cart-count');
        const itemCount = this.items.reduce((count, item) => count + item.quantity, 0);
        
        cartCountElements.forEach(element => {
            element.textContent = itemCount;
            
            if (itemCount > 0) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        });
    }
    
    showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-20 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg transform transition-all duration-500 opacity-0 translate-y-8';
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.remove('opacity-0', 'translate-y-8');
        }, 10);
        
        setTimeout(() => {
            notification.classList.add('opacity-0', 'translate-y-8');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 500);
        }, 3000);
    }
}

// Initialize cart when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.cart = new ShoppingCart();
    
    // Add to cart buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = parseInt(this.dataset.productId);
            const productName = this.dataset.productName;
            const productPrice = parseFloat(this.dataset.productPrice);
            const productImage = this.dataset.productImage;
            
            window.cart.addItem({
                id: productId,
                name: productName,
                price: productPrice,
                image: productImage
            });
        });
    });
    
    // Booking calendar functionality
    initBookingCalendar();
});

// Booking calendar functionality
function initBookingCalendar() {
    const calendarElement = document.getElementById('booking-calendar');
    
    if (!calendarElement) return;
    
    const bookingSlots = document.querySelectorAll('.booking-slot');
    
    bookingSlots.forEach(slot => {
        slot.addEventListener('click', function() {
            // Toggle active class
            bookingSlots.forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            
            // Update hidden input
            const bookingTimeInput = document.getElementById('booking_time');
            if (bookingTimeInput) {
                bookingTimeInput.value = this.dataset.time;
            }
        });
    });
}

// Handle floating labels for contact form
const formInputs = document.querySelectorAll('.floating-input');

formInputs.forEach(input => {
    input.addEventListener('focus', () => {
        input.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', () => {
        if (input.value === '') {
            input.parentElement.classList.remove('focused');
        }
    });
    
    // Check initial state
    if (input.value !== '') {
        input.parentElement.classList.add('focused');
    }
});