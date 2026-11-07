@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-grid me-2"></i>
                    Category Management
                </h5>

                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Category
                </a>

            </div>
        </div>

        <div class="card-body">

            @if($categories->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($categories as $key => $category)

                                <tr>
                                    <td>{{ $categories->firstItem() + $key }}</td>

                                    <td class="fw-semibold">
                                        {{ $category->name }}
                                    </td>

                                    <td>
                                        <span class="badge bg-light text-dark">
                                            {{ $category->slug }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ Str::limit($category->description, 35) ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $category->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this category?')">

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

                {{ $categories->links('pagination::bootstrap-5') }}

            @else

                <div class="text-center py-5">
                    <i class="bi bi-inbox display-4 text-secondary"></i>

                    <h5 class="mt-3">No Categories Found!</h5>

                    <p class="text-muted">
                        Start by creating your first category.
                    </p>

                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        Create Category
                    </a>
                </div>

            @endif

        </div>
    </div>

@endsection