@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <div class="bg-success text-white d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-check-lg" style="font-size: 2.5rem;"></i>
                        </div>
                        <h3 class="fw-bold">Order Placed Successfully!</h3>
                        <p class="text-muted">Thank you for your purchase. We've received your order.</p>
                    </div>

                    <div class="bg-light p-4 rounded mb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h6 class="fw-bold">Order Number</h6>
                                <p class="mb-0">#{{ $order->id }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Order Date</h6>
                                <p class="mb-0">{{ $order->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Order Details</h5>
                        
                        @foreach($order->items as $item)
                            <div class="d-flex mb-3">
                                <div style="width: 40px; height: 40px;" class="me-3">
                                    @php
                                        $product = $item->product;
                                        $mainImage = $product->images->where('is_main', true)->first();
                                        if (!$mainImage) {
                                            $mainImage = $product->images->first();
                                        }
                                    @endphp
                                    
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
                                    <div class="fw-bold">{{ $product->name }}</div>
                                    <div class="text-muted small">{{ $item->quantity }} x {{ number_format($item->price, 3) }}</div>
                                </div>
                                
                                <div class="text-end ms-3">
                                    <div class="fw-bold">{{ number_format($item->price * $item->quantity, 3) }}</div>
                                </div>
                            </div>
                        @endforeach
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between mb-2">
                            <div>Subtotal</div>
                            <div class="fw-bold">{{ number_format($order->total_amount, 3) }} JOD</div>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <div>Shipping</div>
                            <div>Free</div>
                        </div>
                        
                        <hr class="my-3">
                        
                        <div class="d-flex justify-content-between mb-3">
                            <div class="fw-bold">Total</div>
                            <div class="fw-bold">{{ number_format($order->total_amount, 3) }} JOD</div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h6 class="fw-bold">Shipping Address</h6>
                            <p class="mb-0">{{ $order->shipping_address }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Payment Method</h6>
                            <p class="mb-0">
                                @if($order->payment_method == 'cash_on_delivery')
                                    Cash on Delivery
                                @elseif($order->payment_method == 'visa')
                                    Visa
                                @elseif($order->payment_method == 'mastercard')
                                    Mastercard
                                @elseif($order->payment_method == 'mada')
                                    Mada
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Order Status</h6>
                        <div class="progress" role="progressbar" style="height: 5px;">
                            @php
                                $statusProgress = 0;
                                switch($order->order_status) {
                                    case 'pending':
                                        $statusProgress = 20;
                                        break;
                                    case 'processing':
                                        $statusProgress = 40;
                                        break;
                                    case 'shipped':
                                        $statusProgress = 70;
                                        break;
                                    case 'delivered':
                                        $statusProgress = 100;
                                        break;
                                    default:
                                        $statusProgress = 0;
                                }
                            @endphp
                            <div class="progress-bar bg-success" ></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <small class="@if($order->order_status == 'pending') fw-bold @endif">Pending</small>
                            <small class="@if($order->order_status == 'processing') fw-bold @endif">Processing</small>
                            <small class="@if($order->order_status == 'shipped') fw-bold @endif">Shipped</small>
                            <small class="@if($order->order_status == 'delivered') fw-bold @endif">Delivered</small>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="mb-4">We'll send order status updates to your email.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="" class="btn btn-outline-dark">
                                Continue Shopping
                            </a>
                            
                        </div>
                    </div>
                </div>
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

.btn-warning {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-warning:hover {
    background-color: #6c757d;
    border-color: #6c757d;
}
</style>
@endsection