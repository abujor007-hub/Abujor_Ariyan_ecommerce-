@extends('layouts.app')

@section('title', 'Create Subcategory')

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-plus-circle me-2"></i>
                        Create New Subcategory
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('subcategories.store') }}" method="POST">

                        @csrf

                        {{-- Category Select --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Select Category <span class="text-danger">*</span>
                            </label>

                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">

                                <option value="">Choose Category</option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($categories->isEmpty())
                                <small class="text-danger">
                                    Please create a category first.
                                </small>
                            @endif

                        </div>

                        {{-- Subcategory Name --}}

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Subcategory Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Enter subcategory name">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- Description --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror"
                                placeholder="Enter description">{{ old('description') }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('subcategories.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>

                            <button type="submit" class="btn btn-primary" {{ $categories->isEmpty() ? 'disabled' : '' }}>
                                <i class="bi bi-save"></i>
                                Save Subcategory
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection