@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Your Cart</h3>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="row">
        <div class="col-lg-8">
            @if($cartItems->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        @foreach($cartItems as $item)
                            <div class="d-flex p-3 border-bottom">
                            <div class="me-3" style="width: 80px; height: 80px;">
                                @if($item->product->images && $item->product->images->count() > 0)
                                    <img src="{{ $item->product->images->first()->image_url }}" 
                                        alt="{{ $item->product->name }}" 
                                        class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 bg-light rounded">
                                        <i class="fas fa-camera text-muted" style="font-size: 1.5rem;"></i>
                                    </div>
                                @endif
                            </div>
                                
                                <div class="d-flex flex-column flex-grow-1">
                                    <h5 class="mb-1">{{ $item->product->name }}</h5>
                                    <p class="text-muted mb-0">{{ $item->product->brand }}</p>
                                    <div class="price-tag bg-warning text-dark d-inline-block px-2 py-1 mt-auto mb-0" style="width: fit-content;">
                                        <span class="fw-bold">{{ number_format($item->product->price, 3) }}</span>
                                    </div>
                                </div>
                                
                                <div class="d-flex flex-column align-items-end">
                                    <div class="quantity-control d-flex align-items-center mb-3">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            <button type="button" class="btn btn-light btn-sm quantity-btn" data-action="decrease">−</button>
                                            <input type="number" name="quantity" class="form-control form-control-sm mx-2 text-center quantity-input" 
                                                   value="{{ $item->quantity }}" min="1" style="width: 50px;">
                                            <button type="button" class="btn btn-light btn-sm quantity-btn" data-action="increase">+</button>
                                            <button type="submit" class="d-none update-cart-btn">Update</button>
                                        </form>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="me-3">
                                            <span class="fw-bold">{{ number_format($item->product->price * $item->quantity, 3) }}</span>
                                        </div>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-danger p-0">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-shopping-cart text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Your cart is empty</h4>
                        <p class="text-muted">Looks like you haven't added any products to your cart yet.</p>
                      
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            @if($cartItems->count() > 0)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Order Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span class="fw-bold">{{ number_format($total, 3) }} JOD</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold fs-5">{{ number_format($total, 3) }} JOD</span>
                        </div>
                        
                        <div class="d-grid">
                            <a href="{{ route('checkout.index') }}" class="btn btn-warning py-2 fw-bold">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity buttons functionality
        const quantityBtns = document.querySelectorAll('.quantity-btn');
        
        if (quantityBtns) {
            quantityBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.closest('.quantity-control').querySelector('.quantity-input');
                    let value = parseInt(input.value);
                    
                    if (this.dataset.action === 'increase') {
                        value++;
                    } else if (this.dataset.action === 'decrease' && value > 1) {
                        value--;
                    }
                    
                    input.value = value;
                    
                    // Auto-update cart after a short delay
                    setTimeout(() => {
                        this.closest('form').querySelector('.update-cart-btn').click();
                    }, 500);
                });
            });
        }
    });
</script>
@endpush

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

.btn-warning {
    background-color: #ffde59;
    border-color: #ffde59;
}

.btn-warning:hover {
    background-color: #ffd600;
    border-color: #ffd600;
}

.quantity-input::-webkit-inner-spin-button, 
.quantity-input::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    margin: 0;
}


</style>
@endsection