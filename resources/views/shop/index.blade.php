@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="mb-3">Filters</h4>

                    <form action="{{ route('shop.index') }}" method="GET" id="filter-form">
                        <!-- Categories Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">Categories</h6>
                            @foreach($categories as $category)
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="radio" name="category" 
                                           id="category-{{ $category->id }}" value="{{ $category->id }}"
                                           {{ $selectedCategory == $category->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category-{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                            <!-- Clear Categories Option -->
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="radio" name="category" 
                                       id="category-clear" value=""
                                       {{ $selectedCategory == null ? 'checked' : '' }}>
                                <label class="form-check-label" for="category-clear">
                                    All Categories
                                </label>
                            </div>
                        </div>

                        <!-- Brands Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">Brands</h6>
                            @foreach($brands as $brand)
                                <div class="form-check mb-2">
                                    <input class="form-check-input filter-checkbox" type="radio" name="brand" 
                                           id="brand-{{ $brand }}" value="{{ $brand }}"
                                           {{ $selectedBrand == $brand ? 'checked' : '' }}>
                                    <label class="form-check-label" for="brand-{{ $brand }}">
                                        {{ $brand }}
                                    </label>
                                </div>
                            @endforeach
                            <!-- Clear Brands Option -->
                            <div class="form-check mb-2">
                                <input class="form-check-input filter-checkbox" type="radio" name="brand" 
                                       id="brand-clear" value=""
                                       {{ $selectedBrand == null ? 'checked' : '' }}>
                                <label class="form-check-label" for="brand-clear">
                                    All Brands
                                </label>
                            </div>
                        </div>

                        <!-- Price Range Slider -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-2">Price Range</h6>
                            <div class="range-slider">
                                <input type="range" class="form-range" min="{{ $minProductPrice }}" max="{{ $maxProductPrice }}" 
                                       step="10" id="price-slider" value="{{ $maxPrice }}">
                                <div class="d-flex justify-content-between">
                                    <span id="min-price-display">{{ number_format($minPrice, 3) }} JOD</span>
                                    <span id="max-price-display">{{ number_format($maxPrice, 3) }} JOD</span>
                                </div>
                                <input type="hidden" name="min_price" id="min-price-input" value="{{ $minPrice }}">
                                <input type="hidden" name="max_price" id="max-price-input" value="{{ $maxPrice }}">
                            </div>
                        </div>

                        <!-- Apply/Clear Filters Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-secondary">Apply Filters</button>
                            <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">Clear All</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>All Products</h4>
                
                <!-- Sort Dropdown -->
                <div class="d-flex align-items-center">
                    <span class="me-2">Sort by:</span>
                    <select class="form-select" id="sort-select" onchange="updateSort(this.value)">
                        <option value="newest" {{ $selectedSort == 'newest' ? 'selected' : '' }}>Newest</option>
                        <option value="price_low_high" {{ $selectedSort == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high_low" {{ $selectedSort == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                    <input type="hidden" name="sort" value="{{ $selectedSort }}" form="filter-form">
                </div>
            </div>

            @if($products->count() > 0)
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm product-card">
                                <div class="position-relative">
                                    @if($product->is_featured)
                                        <span class="position-absolute top-0 start-0 badge bg-warning text-dark m-2">Featured</span>
                                    @endif
                                    
                                    <!-- Product Image -->
                                    <div style="height: 200px; background-color: #f8f9fa; position: relative;">
                                        @if($product->images && $product->images->count() > 0)
                                                        <img src="{{ $product->images->first()->image_url }}" 
                                                class="card-img-top" alt="{{ $product->name }}"
                                                style="height: 100%; width: 100%; object-fit: cover;"
                                                loading="lazy">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100">
                                                <i class="fas fa-camera text-muted" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif
                                        
                                        <!-- Quick Add to Cart -->
                                        <div class="position-absolute bottom-0 end-0 m-2">
                                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-secondary btn-sm cart-btn">
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-muted">{{ $product->brand }}</p>
                                    <div class="price-tag bg-secondary text-white d-inline-block px-2 py-1 mb-2" style="width: fit-content;">
                                        <span class="fw-bold">{{ number_format($product->price, 3) }} JOD</span>
                                    </div>
                                    <p class="card-text flex-grow-1">{{ Str::limit($product->description, 80) }}</p>
                                    <a href="{{ route('shop.product.show', $product->id) }}" class="btn btn-outline-secondary mt-auto">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="custom-pagination mt-4">
                    <div class="pagination-info mb-2">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
                    </div>
                    
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($products->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left small"></i> Prev
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">
                                    <i class="fas fa-chevron-left small"></i> Prev
                                </a>
                            </li>
                        @endif

                        {{-- Page Number Links --}}
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item {{ ($products->currentPage() == $i) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($products->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">
                                    Next <i class="fas fa-chevron-right small"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    Next <i class="fas fa-chevron-right small"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
            @else
                <div class="alert alert-info">
                    No products found matching your criteria.
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Price slider functionality
        const priceSlider = document.getElementById('price-slider');
        const minPriceInput = document.getElementById('min-price-input');
        const maxPriceInput = document.getElementById('max-price-input');
        const minPriceDisplay = document.getElementById('min-price-display');
        const maxPriceDisplay = document.getElementById('max-price-display');
        
        if (priceSlider) {
            priceSlider.addEventListener('input', function() {
                maxPriceInput.value = this.value;
                maxPriceDisplay.textContent = parseFloat(this.value).toFixed(3) + ' JOD';
            });
        }
        
        // Filter auto-submit
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });
    });
    
    // Update sort and submit form
    function updateSort(value) {
        document.querySelector('input[name="sort"]').value = value;
        document.getElementById('filter-form').submit();
    }
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
    
    /* Filter styling */
    .form-check-input:checked {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    /* Range slider custom styling */
    .form-range::-webkit-slider-thumb {
        background: #6c757d;
    }
    
    .form-range::-moz-range-thumb {
        background: #6c757d;
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
    
    /* Pagination styling */
    .custom-pagination {
        margin-top: 2rem;
    }

    .pagination-info {
        text-align: center;
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .pagination {
        margin-bottom: 1rem;
    }

    .pagination .page-item .page-link {
        color: #6c757d;
        border-radius: 4px;
        margin: 0 3px;
        padding: 0.4rem 0.75rem;
        font-size: 0.9rem;
        border: 1px solid #dee2e6;
        background-color: #fff;
        display: flex;
        align-items: center;
    }

    .pagination .page-item .page-link i {
        font-size: 0.7rem;
        margin-top: 1px;
    }

    .pagination .page-item.active .page-link {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .pagination .page-item.disabled .page-link {
        color: #ccc;
        pointer-events: none;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .pagination .page-item .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #5a6268;
    }
</style>
@endsection