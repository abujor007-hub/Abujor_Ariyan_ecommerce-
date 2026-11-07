@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-9">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Product
                </h5>
            </div>

            <div class="card-body p-4">

                <form action="{{ route('products.update', $product->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- Category --}}

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Category *
                            </label>

                            <select name="category_id"
                                    id="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror">

                                <option value="">Select Category</option>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- Subcategory --}}

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Subcategory *
                            </label>

                            <select name="subcategory_id"
                                    id="subcategory_id"
                                    class="form-select @error('subcategory_id') is-invalid @enderror">

                                <option value="">Select Subcategory</option>

                                @foreach($subcategories as $subcategory)

                                    <option value="{{ $subcategory->id }}"
                                        {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>

                                        {{ $subcategory->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('subcategory_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- Name --}}

                        <div class="col-12 mb-3">

                            <label class="form-label fw-semibold">
                                Product Name *
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $product->name) }}"
                                   placeholder="Enter product name">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- Description --}}

                        <div class="col-12 mb-3">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea name="description"
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Enter description">{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- Current Image --}}

                        <div class="col-12 mb-3">

                            <label class="form-label fw-semibold">
                                Current Product Image
                            </label>

                            <div class="mb-3">
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     width="120"
                                     height="120"
                                     class="rounded border"
                                     style="object-fit:cover"
                                     alt="{{ $product->name }}">
                            </div>

                            <label class="form-label fw-semibold">
                                Change Image
                            </label>

                            <input type="file"
                                   name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*">

                            <small class="text-muted">
                                Leave empty to keep the current image.
                            </small>

                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- Old Price --}}

                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Old Price
                            </label>

                            <input type="number"
                                   name="old_price"
                                   step="0.01"
                                   min="0"
                                   class="form-control @error('old_price') is-invalid @enderror"
                                   value="{{ old('old_price', $product->old_price) }}">

                            @error('old_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- New Price --}}

                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                New Price *
                            </label>

                            <input type="number"
                                   name="new_price"
                                   step="0.01"
                                   min="0.01"
                                   class="form-control @error('new_price') is-invalid @enderror"
                                   value="{{ old('new_price', $product->new_price) }}">

                            @error('new_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('products.index') }}"
                           class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i>
                            Back
                        </a>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i>
                            Update Product
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');

    async function loadSubcategories(categoryId, selectedId = '') {

        subcategorySelect.innerHTML =
            '<option value="">Loading...</option>';

        subcategorySelect.disabled = true;

        if (!categoryId) {
            subcategorySelect.innerHTML =
                '<option value="">Select Subcategory</option>';
            return;
        }

        try {
            const url = "{{ route('categories.subcategories', ':id') }}"
                .replace(':id', categoryId);

            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Unable to load subcategories');
            }

            const data = await response.json();

            subcategorySelect.innerHTML =
                '<option value="">Select Subcategory</option>';

            data.forEach(function(item) {

                const option = document.createElement('option');

                option.value = item.id;
                option.textContent = item.name;

                if (String(item.id) === String(selectedId)) {
                    option.selected = true;
                }

                subcategorySelect.appendChild(option);
            });

            subcategorySelect.disabled = false;

        } catch (error) {

            subcategorySelect.innerHTML =
                '<option value="">Unable to load subcategories</option>';

            console.error(error);
        }
    }

    categorySelect.addEventListener('change', function() {
        loadSubcategories(this.value);
    });

    categorySelect.value = @json(old('category_id', $product->category_id));

    loadSubcategories(
        categorySelect.value,
        @json(old('subcategory_id', $product->subcategory_id))
    );
</script>
@endpush