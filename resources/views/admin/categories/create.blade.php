@extends('layouts.app')

@section('title', 'Create Category')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-plus-circle me-2"></i>
                        Create New Category
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('categories.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Category Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter category name" value="{{ old('name') }}">

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
                                placeholder="Enter category description">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                Save Category
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

@endsection