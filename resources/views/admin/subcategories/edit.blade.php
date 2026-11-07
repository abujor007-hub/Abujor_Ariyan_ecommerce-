@extends('layouts.app')

@section('title', 'Edit Subcategory')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-8 col-lg-7">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">

                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Subcategory
                </h5>

            </div>

            <div class="card-body p-4">

                <form action="{{ route('subcategories.update', $subcategory->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    {{-- Category --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Select Category <span class="text-danger">*</span>
                        </label>

                        <select name="category_id"
                                class="form-select @error('category_id') is-invalid @enderror">

                            <option value="">Choose Category</option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Name --}}

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Subcategory Name <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $subcategory->name) }}"
                               placeholder="Enter subcategory name">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- Description --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Enter description">{{ old('description', $subcategory->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('subcategories.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Back
                        </a>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i>
                            Update Subcategory
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection