@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row gx-5">
        <div class="col-md-6">
            <h3 class="mb-4">Checkout</h3>
            
            <h5 class="mb-3">Shipping Information</h5>
            <form action="{{ route('checkout.place-order') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-sm-6 mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" value="{{ Auth::user()->name ?? '' }}">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email ?? '' }}">
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                
                <div class="mb-3">
                    <label for="shippingAddress" class="form-label">Shipping Address</label>
                    <textarea class="form-control" id="shippingAddress" name="shipping_address" rows="3"></textarea>
                </div>
                
                <div class="row mb-4">
                    <div class="col-sm-6 mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" name="postal_code">
                    </div>
                </div>
                
                <h5 class="mb-3">Payment Method</h5>
                <div class="mb-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input payment-method-radio" type="radio" name="payment_method" id="cashOnDelivery" value="cash_on_delivery" checked>
                        <label class="form-check-label" for="cashOnDelivery">Cash on Delivery</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input payment-method-radio" type="radio" name="payment_method" id="visa" value="visa">
                        <label class="form-check-label" for="visa">
                            <i class="bi bi-credit-card me-2"></i>Visa
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input payment-method-radio" type="radio" name="payment_method" id="mastercard" value="mastercard">
                        <label class="form-check-label" for="mastercard">
                            <i class="bi bi-credit-card me-2"></i>Mastercard
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input payment-method-radio" type="radio" name="payment_method" id="mada" value="mada">
                        <label class="form-check-label" for="mada">
                            <i class="bi bi-credit-card me-2"></i>Mada
                        </label>
                    </div>
                    
                    <!-- Credit Card Payment Form (initially hidden) -->
                    <div id="creditCardForm" class="card border-0 bg-light p-3 mt-3 mb-3" style="display: none;">
                        <div class="card-body">
                            <h6 class="mb-3">Enter Card Details</h6>
                            
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="XXXX XXXX XXXX XXXX">
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                </div>
                                <div class="col-6">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" placeholder="XXX">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="cardName" class="form-label">Name on Card</label>
                                <input type="text" class="form-control" id="cardName">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-warning py-2 fw-bold">Place Order</button>
                </div>
            </form>
        </div>
        
        <div class="col-md-6">
            <h3 class="mb-4">Order Summary</h3>
            
            <div class="order-summary">
                @foreach($cartItems as $item)
                    <div class="d-flex mb-3">
                        <div style="width: 40px; height: 40px;" class="me-3">
                        @if($item->product->images && $item->product->images->count() > 0)
                            <img src="{{ $item->product->images->first()->image_url }}" 
                                alt="{{ $item->product->name }}" 
                                class="img-fluid" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light" style="width: 40px; height: 40px;">
                                <i class="fas fa-camera text-muted" style="font-size: 0.8rem;"></i>
                            </div>
                        @endif
                        </div>
                        
                        <div class="me-auto">
                            <div class="fw-bold">{{ $item->product->name }}</div>
                            <div class="text-muted small">{{ $item->quantity }} x {{ number_format($item->product->price, 3) }}</div>
                        </div>
                        
                        <div class="text-end ms-3">
                            <div class="fw-bold">{{ number_format($item->product->price * $item->quantity, 3) }}</div>
                        </div>
                    </div>
                @endforeach
                
                <hr class="my-3">
                
                <div class="d-flex justify-content-between mb-2">
                    <div>Subtotal</div>
                    <div class="fw-bold">{{ number_format($total, 3) }} JOD</div>
                </div>
                
                <div class="d-flex justify-content-between mb-2">
                    <div>Shipping</div>
                    <div>Free</div>
                </div>
                
                <hr class="my-3">
                
                <div class="d-flex justify-content-between mb-2">
                    <div class="fw-bold">Total</div>
                    <div class="fw-bold">{{ number_format($total, 3) }} JOD</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Processing Modal -->
<div class="modal fade" id="paymentProcessingModal" tabindex="-1" aria-labelledby="paymentProcessingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentProcessingModalLabel">Processing Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-warning mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Please wait while we process your payment...</p>
                <p class="text-muted small">Do not close this window or refresh the page.</p>
            </div>
        </div>
    </div>
</div>

<style>
body, html {
    overflow-x: hidden;
}

.container {
    max-width: 1140px;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

.row {
    --bs-gutter-x: 1.5rem;
}

.form-check-input:checked {
    background-color: #ffc107;
    border-color: #ffc107;
}

.btn-warning {
    background-color: #ffde59;
    border-color: #ffde59;
}

.btn-warning:hover {
    background-color: #ffd600;
    border-color: #ffd600;
}

.order-summary {
    min-width: 0;  /* Prevent flex items from expanding beyond container */
}

@media (max-width: 767.98px) {
    .col-md-6:last-child {
        margin-top: 2rem;
    }
}
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show/hide credit card form based on payment method selection
        const paymentRadios = document.querySelectorAll('.payment-method-radio');
        const creditCardForm = document.getElementById('creditCardForm');
        
        paymentRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'visa' || this.value === 'mastercard' || this.value === 'mada') {
                    creditCardForm.style.display = 'block';
                } else {
                    creditCardForm.style.display = 'none';
                }
            });
        });
        
        // Form submission with payment processing modal
        const checkoutForm = document.querySelector('form');
        const paymentProcessingModal = new bootstrap.Modal(document.getElementById('paymentProcessingModal'));
        
        checkoutForm.addEventListener('submit', function(e) {
            const selectedPayment = document.querySelector('input[name="payment_method"]:checked').value;
            
            if (selectedPayment !== 'cash_on_delivery') {
                e.preventDefault(); // Prevent form submission
                
                // Display payment processing modal
                paymentProcessingModal.show();
                
                // Simulate payment processing (would be replaced with actual payment gateway)
                setTimeout(function() {
                    paymentProcessingModal.hide();
                    checkoutForm.submit(); // Submit form after "processing"
                }, 3000);
            }
        });
    });
</script>
@endpush
@endsection