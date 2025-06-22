@extends('layouts.admin')
@section('content')
<style>
/* Modal/Popup Styles */
.modal-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1050;
}

.modal-content {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    width: 80%;
    max-width: 900px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {transform: translateY(-50px); opacity: 0;}
    to {transform: translateY(0); opacity: 1;}
}

.modal-header {
    padding: 15px 20px;
    border-bottom: 1px solid #eaeaea;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 1;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.modal-title {
    margin: 0;
    font-weight: 600;
    color: #333;
    font-size: 1.5rem;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #777;
    transition: color 0.2s;
}

.modal-close:hover {
    color: #333;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    padding: 15px 20px;
    border-top: 1px solid #eaeaea;
    text-align: right;
    position: sticky;
    bottom: 0;
    background-color: white;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}

/* Product Details Styles */
.product-details {
    margin-bottom: 20px;
    line-height: 1.6;
}

.product-details strong {
    color: #555;
    min-width: 100px;
    display: inline-block;
    margin-bottom: 5px;
}

.info-row {
    margin-bottom: 10px;
    display: flex;
    flex-wrap: wrap;
}

.info-label {
    font-weight: 600;
    width: 120px;
}

.info-value {
    flex: 1;
}

.description-box {
    margin-top: 5px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 5px;
    line-height: 1.5;
}

.images-header {
    color: #333;
    margin: 25px 0 15px;
    font-weight: 600;
    border-bottom: 1px solid #eaeaea;
    padding-bottom: 8px;
}

.product-image-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.product-image {
    transition: transform 0.2s;
    border-radius: 5px;
    overflow: hidden;
}

.product-image:hover {
    transform: scale(1.03);
}

.img-fluid {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    height: 180px;
    object-fit: cover;
    width: 100%;
}

.no-images {
    font-style: italic;
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 5px;
    display: inline-block;
}

.btn-back {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
    padding: 8px 20px;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    transition: background-color 0.2s;
}

.btn-back:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: normal;
    display: inline-block;
}

.badge-active {
    background-color: #28a745;
    color: white;
}

.badge-inactive {
    background-color: #dc3545;
    color: white;
}

.badge-featured {
    background-color: #007bff;
    color: white;
}

.badge-not-featured {
    background-color: #6c757d;
    color: white;
}

.price-value {
    font-weight: 600;
    color: #28a745;
}

@media (max-width: 768px) {
    .modal-content {
        width: 95%;
    }
    
    .info-label {
        width: 100%;
        margin-bottom: 5px;
    }
    
    .info-value {
        width: 100%;
    }
    
    .product-image-container {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}
</style>

<div class="modal-container">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Product Details</h2>
            <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="product-details">
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value">{{ $product->name }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Category:</div>
                    <div class="info-value">{{ $product->category->name ?? '-' }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Brand:</div>
                    <div class="info-value">{{ $product->brand }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Price:</div>
                    <div class="info-value"><span class="price-value">{{ $product->price }} JD</span></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Quantity:</div>
                    <div class="info-value">{{ $product->quantity }}</div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value">
                        <span class="status-badge {{ $product->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Featured:</div>
                    <div class="info-value">
                        <span class="status-badge {{ $product->is_featured ? 'badge-featured' : 'badge-not-featured' }}">
                            {{ $product->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Description:</div>
                    <div class="info-value">
                        <div class="description-box">{{ $product->description }}</div>
                    </div>
                </div>
            </div>
            
            <h4 class="images-header">Product Images</h4>
            <div class="product-image-container">
                @forelse($product->images as $image)
                    <div class="product-image">
                        <img src="{{ $image->image_url }}" class="img-fluid" alt="{{ $product->name }}">
                    </div>
                @empty
                    <div class="no-images">No images for this product.</div>
                @endforelse
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('admin.products.index') }}" class="btn-back">Back to Products</a>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        window.location.href = "{{ route('admin.products.index') }}";
    }
    
    // Close modal when clicking outside
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.querySelector('.modal-container');
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
        
        // Close on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    });
</script>
@endsection