@extends('layouts.app')

@section('title', 'Manage Subcategories')

@section('content')

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0 fw-bold">
                    <i class="bi bi-diagram-3 me-2"></i>
                    Subcategory Management
                </h5>

                <a href="{{ route('subcategories.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Add Subcategory
                </a>

            </div>
        </div>

        <div class="card-body">

            @if($subcategories->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Slug</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($subcategories as $key => $subcategory)

                                <tr>

                                    <td>
                                        {{ $subcategories->firstItem() + $key }}
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $subcategory->category->name }}
                                        </span>
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $subcategory->name }}
                                    </td>

                                    <td>
                                        <small>{{ $subcategory->slug }}</small>
                                    </td>

                                    <td>
                                        {{ Str::limit($subcategory->description, 30) ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $subcategory->created_at->format('d M Y') }}
                                    </td>

                                    <td>

                                        <div class="d-flex gap-2">

                                            <a href="{{ route('subcategories.edit', $subcategory->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this subcategory?')">

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

                {{ $subcategories->links('pagination::bootstrap-5') }}

            @else

                <div class="text-center py-5">

                    <i class="bi bi-inbox display-4 text-secondary"></i>

                    <h5 class="mt-3">No Subcategories Found!</h5>

                    <p class="text-muted">
                        Create your first subcategory.
                    </p>

                    <a href="{{ route('subcategories.create') }}" class="btn btn-primary">
                        Create Subcategory
                    </a>

                </div>

            @endif

        </div>

    </div>

@endsection