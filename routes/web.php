<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Models\Category;

Route::get('/', function () {
    return redirect()->route('categories.index');
});

Route::resource('categories', CategoryController::class)  ->except(['show']);

 Route::resource('subcategories', SubcategoryController::class)->except(['show']);


Route::resource('products', ProductController::class) ->except(['show']);

Route::get('/product/{product:slug}', [ProductController::class, 'show'])  ->name('products.show');

Route::get('/categories/{category}/subcategories', function (Category $category) {

    return response()->json(
        $category->subcategories()
            ->select('id', 'name')
            ->orderBy('name')
            ->get()
    );
})->name('categories.subcategories');