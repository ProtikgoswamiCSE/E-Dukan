@extends('admin.layouts.admin')

@section('title', 'Slider Management')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Slider Management</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSliderModal">
            <i class="fas fa-plus"></i> Add New Slider
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Sliders Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0">All Sliders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Button</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                        <tr>
                            <td>
                                @if($slider->image)
                                <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}"
                                    class="img-thumbnail" style="width: 80px; height: 50px; object-fit: cover;">
                                @else
                                <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $slider->title }}</td>
                            <td>{{ Str::limit($slider->description, 50) }}</td>
                            <td>
                                @if($slider->button_text)
                                <span class="badge bg-secondary">{{ $slider->button_text }}</span>
                                @else
                                <span class="text-muted">No button</span>
                                @endif
                            </td>
                            <td>{{ $slider->sort_order }}</td>
                            <td>
                                @if($slider->is_active)
                                <span class="badge bg-secondary">Active</span>
                                @else
                                <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editSliderModal{{ $slider->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Are you sure you want to delete this slider?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No sliders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $sliders->links('admin.components.pagination') }}
        </div>
    </div>
</div>

<!-- Add Slider Modal -->
<div class="modal fade" id="addSliderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="0" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Slider Image *</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        <small class="form-text text-muted">Recommended size: 1920x600px. Max size: 2MB</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_text" class="form-label">Button Text</label>
                                <input type="text" class="form-control" id="button_text" name="button_text" placeholder="e.g., Shop Now">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="button_link" class="form-label">Button Link</label>
                                <input type="text" class="form-control" id="button_link" name="button_link" placeholder="/shop/category or full URL">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Slider</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Slider Modals -->
@foreach($sliders as $slider)
<div class="modal fade" id="editSliderModal{{ $slider->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_title{{ $slider->id }}" class="form-label">Title *</label>
                                <input type="text" class="form-control" id="edit_title{{ $slider->id }}"
                                    name="title" value="{{ $slider->title }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_sort_order{{ $slider->id }}" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="edit_sort_order{{ $slider->id }}"
                                    name="sort_order" value="{{ $slider->sort_order }}" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description{{ $slider->id }}" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description{{ $slider->id }}"
                            name="description" rows="3">{{ $slider->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image{{ $slider->id }}" class="form-label">Slider Image</label>
                        <input type="file" class="form-control" id="edit_image{{ $slider->id }}"
                            name="image" accept="image/*">
                        <small class="form-text text-muted">Leave empty to keep current image. Recommended size: 1920x600px. Max size: 2MB</small>
                        @if($slider->image)
                        <div class="mt-2">
                            <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}"
                                class="img-thumbnail" style="width: 200px; height: 120px; object-fit: cover;">
                        </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_button_text{{ $slider->id }}" class="form-label">Button Text</label>
                                <input type="text" class="form-control" id="edit_button_text{{ $slider->id }}"
                                    name="button_text" value="{{ $slider->button_text }}" placeholder="e.g., Shop Now">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_button_link{{ $slider->id }}" class="form-label">Button Link</label>
                                <input type="text" class="form-control" id="edit_button_link{{ $slider->id }}"
                                    name="button_link" value="{{ $slider->button_link }}" placeholder="https://example.com">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="edit_is_active{{ $slider->id }}"
                                name="is_active" value="1" {{ $slider->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="edit_is_active{{ $slider->id }}">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Slider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection