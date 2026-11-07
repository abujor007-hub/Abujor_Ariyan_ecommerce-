<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'E-commerce Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('categories.index') }}">
                Abujor_Ariyan E-Commerce Admin
            </a>

            <div class="navbar-nav ms-auto">
                <a href="{{ route('categories.index') }}" class="nav-link text-white">
                    Categories
                </a>

                <a href="{{ route('subcategories.index') }}" class="nav-link text-white">
                    Subcategories
                </a>
                <a href="{{ route('products.index') }}" class="nav-link text-white">
                    Products
                </a>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @include('alart.message')

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    </script>
    @stack('scripts')
</body>

</html>