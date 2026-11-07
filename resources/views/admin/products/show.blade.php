@extends('layouts.app')

@section('title', $product->name)

@section('content')

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">Product Details</h5>

                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>

            </div>
        </div>

        <div class="card-body p-4">

            <div class="row">

                <div class="col-md-5 mb-3">

                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded border w-100"
                        alt="{{ $product->name }}">

                </div>

                <div class="col-md-7">

                    <h3 class="fw-bold">{{ $product->name }}</h3>

                    <p class="text-muted">
                        {{ $product->description ?? 'No description available.' }}
                    </p>

                    <hr>

                    <p>
                        <strong>Category:</strong>
                        {{ $product->category->name }}
                    </p>

                    <p>
                        <strong>Subcategory:</strong>
                        {{ $product->subcategory->name }}
                    </p>

                    <p>
                        <strong>Slug:</strong>
                        {{ $product->slug }}
                    </p>

                    <div class="mt-3">

                        @if($product->old_price)
                            <del class="text-muted fs-5">
                                ৳{{ number_format($product->old_price, 2) }}
                            </del>
                        @endif

                        <h3 class="text-success fw-bold">
                            ৳{{ number_format($product->new_price, 2) }}
                        </h3>

                    </div>

                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning mt-3">
                        <i class="bi bi-pencil-square"></i>
                        Edit Product
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection