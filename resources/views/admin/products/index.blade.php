@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-box-seam me-2"></i>
                    Product Management
                </h5>

                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Product
                </a>

            </div>
        </div>

        <div class="card-body">

            @if($products->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Old Price</th>
                                <th>New Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($products as $key => $product)

                                <tr>

                                    <td>{{ $products->firstItem() + $key }}</td>

                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" width="55" height="55"
                                            class="rounded border" style="object-fit:cover" alt="{{ $product->name }}">
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $product->name }}
                                    </td>

                                    <td>
                                        {{ $product->category->name }}
                                    </td>

                                    <td>
                                        {{ $product->subcategory->name }}
                                    </td>

                                    <td>
                                        @if($product->old_price)
                                            <del class="text-muted">
                                                ৳{{ number_format($product->old_price, 2) }}
                                            </del>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td class="fw-bold text-success">
                                        ৳{{ number_format($product->new_price, 2) }}
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('products.show', $product->slug) }}"
                                                class="btn btn-sm btn-info text-white">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{ $products->links('pagination::bootstrap-5') }}

            @else

                <div class="text-center py-5">
                    <i class="bi bi-box-seam display-4 text-secondary"></i>

                    <h5 class="mt-3">No Products Found!</h5>

                    <p class="text-muted">Create your first product.</p>

                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        Add Product
                    </a>
                </div>

            @endif

        </div>

    </div>

@endsection