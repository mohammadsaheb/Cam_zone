@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Breadcrumb Navigation -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-secondary">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none text-secondary">Shop</a></li>
                    @if($product->category)
                        <li class="breadcrumb-item"><a href="{{ route('shop.index', ['category' => $product->category->id]) }}" class="text-decoration-none text-secondary">{{ $product->category->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- Product Images Column -->
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Carousel Indicators -->
                    @if($product->images && $product->images->count() > 0)
                        <div class="carousel-indicators">
                            @foreach($product->images as $key => $image)
                                <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="{{ $key }}" 
                                        class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                                        aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                    @endif

                    <!-- Carousel Items -->
                    <div class="carousel-inner rounded">
                        @if($product->images && $product->images->count() > 0)
                            @foreach($product->images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ $image->image_url }}" class="d-block w-100" alt="{{ $product->name }}" 
                                         style="height: 400px; object-fit: cover;" loading="lazy">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 400px;">
                                    <i class="fas fa-camera text-muted" style="font-size: 5rem;"></i>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Carousel Controls -->
                    @if($product->images && $product->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>

                <!-- Thumbnail Navigation -->
                @if($product->images && $product->images->count() > 1)
                    <div class="d-flex mt-2 overflow-auto thumbnail-container">
                        @foreach($product->images as $key => $image)
                            <div class="thumbnail-item me-2 {{ $key == 0 ? 'active' : '' }}" data-bs-target="#productCarousel" data-bs-slide-to="{{ $key }}">
                                <img src="{{ $image->image_url }}" alt="Thumbnail {{ $key + 1 }}" 
                                     style="width: 70px; height: 70px; object-fit: cover;" class="rounded">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details Column -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <!-- Product Badges -->
                    <!-- <div class="mb-3">
                        @if($product->is_featured)
                            <span class="badge bg-warning text-dark">Featured</span>
                        @endif
                        @if($product->stock_quantity > 0)
                            <span class="badge bg-success">In Stock</span>
                        @else
                            <span class="badge bg-danger">Out of Stock</span>
                        @endif
                        @if($product->is_new)
                            <span class="badge bg-info text-dark">New Arrival</span>
                        @endif
                    </div> -->

                    <!-- Product Name and Brand -->
                    <h2 class="mb-2">{{ $product->name }}</h2>
                    <p class="text-muted mb-3">
                        <span class="fw-bold">Brand:</span> {{ $product->brand }}
                    </p>

                    <!-- Price Display -->
                    <div class="price-tag bg-secondary text-white d-inline-block px-3 py-2 mb-3" style="width: fit-content; border-radius: 4px;">
                        <span class="fs-4 fw-bold">{{ number_format($product->price, 3) }} JOD</span>
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <h5 class="fw-bold">Description</h5>
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Product Specifications -->
                    <div class="mb-4">
                        <h5 class="fw-bold">Specifications</h5>
                        <div class="row">
                            @if($product->category)
                                <div class="col-6 mb-2">
                                    <span class="fw-bold">Category:</span> {{ $product->category->name }}
                                </div>
                            @endif
                            @if($product->sku)
                                <div class="col-6 mb-2">
                                    <span class="fw-bold">SKU:</span> {{ $product->sku }}
                                </div>
                            @endif
                            <!-- If you have more specifications in your database, add them here -->
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add', $product->id) }}" method="GET" class="mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary qty-btn" data-action="decrease">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity ?? 10 }}" 
                                           class="form-control text-center" id="quantity-input">
                                    <button type="button" class="btn btn-outline-secondary qty-btn" data-action="increase">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-secondary w-100 add-to-cart-btn">
                                    <i class="fas fa-cart-plus me-2"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </form>

                   
                </div>
            </div>
        </div>

        <!-- Product Tabs Section -->
        <div class="col-12 mt-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" 
                                    type="button" role="tab" aria-controls="details" aria-selected="true">
                                Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" 
                                    type="button" role="tab" aria-controls="shipping" aria-selected="false">
                                Shipping & Returns
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="productTabsContent">
                        <!-- Details Tab -->
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Product Features</h5>
                                    <ul class="list-unstyled">
                                        <!-- You can implement features dynamically if stored in your database -->
                                        <li class="mb-2"><i class="fas fa-check-circle text-secondary me-2"></i> High-quality materials</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-secondary me-2"></i> Durable construction</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-secondary me-2"></i> Modern design</li>
                                        <li class="mb-2"><i class="fas fa-check-circle text-secondary me-2"></i> Easy to use</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Additional Information</h5>
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td class="fw-bold">Warranty:</td>
                                                <td>1 Year Limited Warranty</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Weight:</td>
                                                <td>{{ $product->weight ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Dimensions:</td>
                                                <td>{{ $product->dimensions ?? 'N/A' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shipping & Returns Tab -->
                        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-truck me-2 text-secondary"></i> Shipping Information</h5>
                                    <p>We offer the following shipping options for delivery within Jordan:</p>
                                    <ul>
                                        <li class="mb-2">Standard Shipping (3-5 business days): 2 JOD</li>
                                        <li class="mb-2">Express Shipping (1-2 business days): 5 JOD</li>
                                        <li class="mb-2">Free shipping on orders over 50 JOD</li>
                                    </ul>
                                    <p>International shipping is available at variable rates depending on the destination.</p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3"><i class="fas fa-undo-alt me-2 text-secondary"></i> Return Policy</h5>
                                    <p>We want you to be completely satisfied with your purchase. If you're not happy with your order, you can return it within 14 days of delivery.</p>
                                    <p>To be eligible for a return, your item must be unused and in the same condition that you received it, with all original packaging and tags attached.</p>
                                    <p>To initiate a return, please contact our customer service team.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if($relatedProducts && $relatedProducts->count() > 0)
            <div class="col-12 mt-5">
                <h4 class="mb-4">You May Also Like</h4>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                <div class="position-relative">
                                    @if($relatedProduct->is_featured)
                                        <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2">Featured</span>
                                    @endif
                                    
                                    <!-- Product Image -->
                                    <div style="height: 180px; background-color: #f8f9fa; position: relative;">
                                        @if($relatedProduct->images && $relatedProduct->images->count() > 0)
                                            <img src="{{ $relatedProduct->images->first()->image_url }}" 
                                                class="card-img-top" alt="{{ $relatedProduct->name }}"
                                                style="height: 100%; width: 100%; object-fit: cover;"
                                                loading="lazy">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <i class="fas fa-camera text-muted" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif
                                            
                                        <!-- Quick Add to Cart -->
                                        <div class="position-absolute bottom-0 end-0 m-2">
                                            <a href="{{ route('cart.add', $relatedProduct->id) }}" class="btn btn-secondary btn-sm cart-btn">
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                    <p class="card-text text-muted">{{ $relatedProduct->brand }}</p>
                                    <div class="price-tag bg-secondary text-white d-inline-block px-2 py-1 mb-2" style="width: fit-content;">
                                        <span class="fw-bold">{{ number_format($relatedProduct->price, 3) }} JOD</span>
                                    </div>
                                    <a href="" class="btn btn-outline-secondary mt-auto">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Share Modal
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share This Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-around">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-outline-primary">
                        <i class="fab fa-facebook-f me-2"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($product->name) }}" target="_blank" class="btn btn-outline-info">
                        <i class="fab fa-twitter me-2"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($product->name . ' - ' . request()->url()) }}" target="_blank" class="btn btn-outline-success">
                        <i class="fab fa-whatsapp me-2"></i> WhatsApp
                    </a>
                </div>
                <div class="mt-4">
                    <label for="share-link" class="form-label">Product Link</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="share-link" value="{{ request()->url() }}" readonly>
                        <button class="btn btn-secondary" type="button" id="copy-link-btn">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity input control
        const qtyBtns = document.querySelectorAll('.qty-btn');
        const qtyInput = document.getElementById('quantity-input');
        const maxQty = parseInt(qtyInput.getAttribute('max'));
        
        qtyBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const action = this.getAttribute('data-action');
                let currentQty = parseInt(qtyInput.value);
                
                if (action === 'increase' && currentQty < maxQty) {
                    qtyInput.value = currentQty + 1;
                } else if (action === 'decrease' && currentQty > 1) {
                    qtyInput.value = currentQty - 1;
                }
            });
        });
        
        // Image thumbnails
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                thumbnails.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Copy link button
        const copyLinkBtn = document.getElementById('copy-link-btn');
        const shareLinkInput = document.getElementById('share-link');
        
        if (copyLinkBtn && shareLinkInput) {
            copyLinkBtn.addEventListener('click', function() {
                shareLinkInput.select();
                document.execCommand('copy');
                
                // Change button text temporarily
                const originalHtml = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(() => {
                    this.innerHTML = originalHtml;
                }, 2000);
            });
        }
    });
</script>
@endpush

<style>
    /* Product card hover effect */
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
    
    /* Thumbnail styling */
    .thumbnail-container {
        scrollbar-width: thin;
        scrollbar-color: #6c757d #f8f9fa;
    }
    
    .thumbnail-container::-webkit-scrollbar {
        height: 6px;
    }
    
    .thumbnail-container::-webkit-scrollbar-track {
        background: #f8f9fa;
    }
    
    .thumbnail-container::-webkit-scrollbar-thumb {
        background-color: #6c757d;
        border-radius: 6px;
    }
    
    .thumbnail-item {
        cursor: pointer;
        opacity: 0.7;
        transition: all 0.2s;
        border: 2px solid transparent;
    }
    
    .thumbnail-item:hover {
        opacity: 0.9;
    }
    
    .thumbnail-item.active {
        opacity: 1;
        border-color: #6c757d;
    }
    
    /* Tab styling */
    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        border-bottom: 3px solid transparent;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        color: #6c757d;
        border-bottom: 3px solid #6c757d;
        background-color: transparent;
    }
    
    /* Form control styling */
    .form-check-input:checked {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    /* Carousel custom styling */
    .carousel-indicators [data-bs-target] {
        background-color: #6c757d;
    }
    
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(108, 117, 125, 0.5);
        border-radius: 50%;
        padding: 10px;
    }
    
    /* Breadcrumb styling */
    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
    }
    
    /* Modal styling */
    .modal-header {
        border-bottom: 1px solid #e9ecef;
    }
    
    /* Input group quantity styling */
    .input-group .form-control {
        text-align: center;
        border-left: none;
        border-right: none;
    }
    
    .input-group .btn-outline-secondary {
        z-index: 0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .carousel-inner img,
        .carousel-inner .bg-light {
            height: 300px !important;
        }
    }
</style>