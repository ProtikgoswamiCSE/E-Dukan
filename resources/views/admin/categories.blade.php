@extends('admin.layouts.admin')

@section('title', 'Categories Management – E-Dukan')

@section('content')
<style>
    /* Categories Management Page Styles */
    
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

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border-left: 4px solid #dc3545;
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

    .btn-success,
    .btn-primary,
    .btn-danger,
    .btn-warning {
        background: linear-gradient(135deg, #111111 0%, #333333 100%);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    .btn-success:hover,
    .btn-primary:hover,
    .btn-danger:hover,
    .btn-warning:hover {
        background: linear-gradient(135deg, #000000 0%, #222222 100%);
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
        background: linear-gradient(135deg, #111111 0%, #333333 100%);
        color: #ffffff;
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

    /* Form Inline Styling */
    form[style*="display:inline-block"] {
        display: inline-block !important;
        margin-left: 5px;
    }

    /* No Categories Message */
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

    .table-responsive::-webkit-scrollbar-thumb { background: #333333; border-radius: 10px; }
    .table-responsive::-webkit-scrollbar-thumb:hover { background: #444444; }
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

    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
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

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="is_visible" class="form-check-input" id="is_visible" value="1" {{ old('is_visible') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_visible">
                            Make this category visible to customers
                        </label>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories List -->
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Categories List</h5>
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Products Count</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                                    <td>
                                        <strong>{{ $category->name }}</strong>
                                        <br>
                                        <small class="text-muted">ID: {{ $category->id }}</small>
                                    </td>
                                    <td>
                                        @if($category->description)
                                            {{ Str::limit($category->description, 50) }}
                                        @else
                                            <span class="text-muted">No description</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($category->is_visible)
                                            <span class="badge bg-success">Visible</span>
                                        @else
                                            <span class="badge bg-warning">Hidden</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $category->products_count ?? 0 }} products</span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $category->created_at->format('M d, Y') }}<br>
                                            {{ $category->created_at->format('h:i A') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-primary edit-category-btn" title="Edit Category" 
                                                data-id="{{ $category->id }}" 
                                                data-name="{{ $category->name }}" 
                                                data-description="{{ $category->description }}" 
                                                data-visible="{{ $category->is_visible ? 'true' : 'false' }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Category">
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
                    {{ $categories->links('admin.components.pagination') }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-layer-group fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No categories found</h5>
                    <p class="text-muted">Start by adding your first category using the form above.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">
                    <i class="fas fa-edit me-2"></i>
                    Edit Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="editCategoryName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="editCategoryDescription" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="is_visible" id="editCategoryVisible" class="form-check-input" value="1">
                            <label class="form-check-label" for="editCategoryVisible">
                                Make this category visible to customers
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to all edit category buttons
    const editButtons = document.querySelectorAll('.edit-category-btn');
    
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const description = this.getAttribute('data-description');
            const isVisible = this.getAttribute('data-visible') === 'true';
            
            // Fill the modal form
            document.getElementById('editCategoryName').value = name;
            document.getElementById('editCategoryDescription').value = description;
            document.getElementById('editCategoryVisible').checked = isVisible;
            
            // Set the form action
            const form = document.getElementById('editCategoryForm');
            form.action = '/admin/categories/' + id;
            
            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            modal.show();
        });
    });
});
</script>
@endsection 