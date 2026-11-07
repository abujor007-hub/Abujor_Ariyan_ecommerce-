@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Category
                    </h5>

                </div>

                <div class="card-body p-4">

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Category Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name) }}" placeholder="Enter category name">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter description">{{ old('description', $category->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>

                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i>
                                Update Category
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection