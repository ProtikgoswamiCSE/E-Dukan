<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results – E-Dukan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('shop.partials.header')

    <main class="py-4">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search Results</li>
                </ol>
            </nav>

            <!-- Search Results Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2>Search Results</h2>
                    @if($query)
                    <p class="text-muted">
                        Showing results for "<strong>{{ $query }}</strong>"
                        ({{ $products->total() }} {{ Str::plural('result', $products->total()) }} found)
                    </p>
                    @endif
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row">
                @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                            <div class="mb-2">
                                <span class="badge bg-secondary">{{ $product->category->name }}</span>
                            </div>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary">@money($product->price)</span>
                                    <small class="text-muted">Stock: {{ $product->stock }}</small>
                                </div>
                                <div class="d-grid mt-2">
                                    <a href="{{ route('shop.product', $product->id) }}" class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No products found</h4>
                        @if($query)
                        <p class="text-muted">
                            No products match your search for "<strong>{{ $query }}</strong>".
                            <br>Try different keywords or browse our categories.
                        </p>
                        @else
                        <p class="text-muted">Please enter a search term to find products.</p>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('shop.index') }}" class="btn btn-primary me-2">Browse All Products</a>
                            <a href="{{ route('shop.category') }}" class="btn btn-outline-primary">View Categories</a>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            {{ $products->appends(['q' => $query])->links('components.pagination') }}

            <!-- Search Suggestions -->
            @if($products->isEmpty() && $query)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search Suggestions</h5>
                            <ul class="list-unstyled mb-0">
                                <li>• Check your spelling</li>
                                <li>• Try more general keywords</li>
                                <li>• Try different keywords</li>
                                <li>• Browse our categories to discover products</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2025 E-Dukan. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-white me-3">Privacy Policy</a>
                    <a href="#" class="text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>