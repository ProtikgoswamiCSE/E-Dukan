@extends('admin.layouts.admin')

@section('title', 'Products Management – E-Dukan')

@section('content')
<style>
    /* Product Management Page Styles */

/* Container and Layout */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
        margin: 0;
    }
}

@media (max-width: 576px) {
    .container {
        padding: 5px;
    }
}

/* Card Styling */
.card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card.shadow {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
}

.card-header {
    padding: 20px 25px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    font-weight: 600;
}

.card-header.bg-primary {
    background: linear-gradient(135deg, #111111 0%, #333333 100%);
    color: #f5f5f5;
}

.card-header.bg-secondary {
    background: linear-gradient(135deg, #222222 0%, #444444 100%);
    color: #f5f5f5;
}

.card-header h5 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 25px;
    background: #ffffff;
}

/* Form Styling */
.form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-control, .form-select {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: #ffffff;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
    background-color: #ffffff;
}

.form-control:hover, .form-select:hover {
    border-color: #d1d5db;
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* Required field indicator */
.text-danger {
    color: #ef4444 !important;
    font-weight: 600;
}

/* Alert Styling */
.alert {
    border: none;
    border-radius: 10px;
    padding: 16px 20px;
    margin-bottom: 25px;
    font-weight: 500;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border-left: 4px solid #28a745;
}

/* Button Styling */
.btn {
    border-radius: 8px;
    padding: 12px 24px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-success {
    background: linear-gradient(135deg, #111111 0%, #333333 100%);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}

.btn-success:hover {
    background: linear-gradient(135deg, #000000 0%, #222222 100%);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.35);
}

.btn-primary {
    background: linear-gradient(135deg, #222222 0%, #444444 100%);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #111111 0%, #333333 100%);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.35);
}

.btn-danger {
    background: linear-gradient(135deg, #000000 0%, #222222 100%);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}

.btn-danger:hover {
    background: linear-gradient(135deg, #111111 0%, #333333 100%);
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.35);
}

.btn-sm {
    padding: 8px 16px;
    font-size: 0.85rem;
}

/* Table Styling */
.table {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 0;
}

.table thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    color: #374151;
    font-weight: 700;
    padding: 18px 15px;
    border: none;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody td {
    padding: 15px;
    vertical-align: middle;
    border-color: #f1f5f9;
    font-size: 0.95rem;
}

.table-hover tbody tr:hover {
    background-color: #f8fafc;
    transform: scale(1.01);
    transition: all 0.2s ease;
}

.table tbody tr {
    transition: all 0.2s ease;
}

/* Product Image Styling */
.table img {
    border-radius: 8px;
    object-fit: cover;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.table img:hover {
    transform: scale(1.1);
}

/* Text Alignment */
.text-end {
    text-align: right;
}

/* Margin and Spacing */
.mt-4 {
    margin-top: 2rem;
}

.mb-3 {
    margin-bottom: 1.5rem;
}

.mb-4 {
    margin-bottom: 2rem;
}

.mb-0 {
    margin-bottom: 0;
}

/* Pagination Styling */
.pagination {
    justify-content: center;
    margin-top: 25px;
}

.page-link {
    border: 2px solid #e5e7eb;
    color: #6b7280;
    padding: 10px 16px;
    border-radius: 8px;
    margin: 0 2px;
    transition: all 0.3s ease;
    font-weight: 500;
}

.page-link:hover {
    background: linear-gradient(135deg, #111111 0%, #333333 100%);
    border-color: #111111;
    color: #ffffff;
    transform: translateY(-1px);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #000000 0%, #222222 100%);
    border-color: #000000;
    color: #ffffff;
}

/* File Input Styling */
input[type="file"] {
    padding: 10px;
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
    transition: all 0.3s ease;
}

input[type="file"]:hover {
    border-color: #667eea;
    background: #f0f4ff;
}

/* Form Inline Styling */
form[style*="display:inline-block"] {
    display: inline-block !important;
    margin-left: 5px;
}

/* No Products Message */
.card-body p {
    text-align: center;
    color: #6b7280;
    font-style: italic;
    margin: 40px 0;
    font-size: 1.1rem;
}

/* Icons */
.fas {
    font-size: 0.9rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 0.8rem;
    }
    
    .table {
        font-size: 0.85rem;
    }
    
    .table thead th,
    .table tbody td {
        padding: 10px 8px;
    }
    
    .form-control, .form-select {
        padding: 10px 14px;
    }
}

@media (max-width: 576px) {
    .text-end {
        text-align: center;
    }
    
    .table-responsive {
        border-radius: 10px;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .btn-sm {
        width: auto;
        margin-bottom: 5px;
    }
}

/* Loading Animation for Buttons */
.btn:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

/* Custom Scrollbar */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
}
</style>

<div class="container mt-4">
    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Create New Product Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Products Management</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Create New Product
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Product</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" min="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}" min="0" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Supported formats: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_visible" class="form-check-input" id="is_visible" value="1" {{ old('is_visible') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_visible">
                            Make this product visible to customers
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Mark as Featured Product (shows on homepage)
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_best_seller" class="form-check-input" id="is_best_seller" value="1" {{ old('is_best_seller') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_best_seller">
                            Mark as Best Seller (shows in Best Sellers section)
                        </label>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Product List -->
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Product List</h5>
        </div>
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th>Best Seller</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50" height="50" style="object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 8px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        @if($product->description)
                                            <br><small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->category)
                                            <span class="badge bg-primary">{{ $product->category->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">No Category</span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong class="text-success">@money($product->price)</strong>
                                    </td>
                                    <td>
                                        @if($product->stock > 0)
                                            <span class="badge bg-success">{{ $product->stock }} in stock</span>
                                        @else
                                            <span class="badge bg-danger">Out of stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_visible)
                                            <span class="badge bg-success">Visible</span>
                                        @else
                                            <span class="badge bg-warning">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_featured)
                                            <span class="badge bg-secondary">Featured</span>
                                        @else
                                            <span class="badge bg-light text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_best_seller)
                                            <span class="badge bg-secondary">Best Seller</span>
                                        @else
                                            <span class="badge bg-light text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary" title="Edit Product">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Product">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('admin.components.pagination') }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-box fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No products found</h5>
                    <p class="text-muted">Start by adding your first product using the form above.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
