<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])   ->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',

            'subcategory_id' => [
                'required',
                Rule::exists('subcategories', 'id')->where('category_id', $request->category_id),
            ],

            'name' => 'required|string|max:255|unique:products,name',

            'description' => 'nullable|string|max:5000',

            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            'old_price' => 'nullable|numeric|min:0',

            'new_price' => 'required|numeric|min:0.01',
        ]);


        $imagePath = $request->file('image')->store('products', 'public');

        
        Product::create([
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'slug' => $this->generateSlug($validated['name']),
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'old_price' => $validated['old_price'] ?? null,
            'new_price' => $validated['new_price'],
        ]);

        return redirect()  ->route('products.index')  ->with('success', 'Product created successfully!');
    }

    
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        $subcategories = Subcategory::where(
            'category_id',
            $product->category_id
        )->orderBy('name')->get();

        return view(
            'admin.products.edit',
            compact('product', 'categories', 'subcategories')
        );
    }

    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',

            'subcategory_id' => [
                'required',
                Rule::exists('subcategories', 'id')
                    ->where('category_id', $request->category_id),
            ],

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($product->id),
            ],

            'description' => 'nullable|string|max:5000',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'old_price' => 'nullable|numeric|min:0',

            'new_price' => 'required|numeric|min:0.01',
        ]);

        $imagePath = $product->image;

        
        if ($request->hasFile('image')) {

            Storage::disk('public')->delete($product->image);

            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'slug' => $this->generateSlug($validated['name'], $product->id),
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'old_price' => $validated['old_price'] ?? null,
            'new_price' => $validated['new_price'],
        ]);

        return redirect() ->route('products.index') ->with('success', 'Product updated successfully!');
    }

    // Product Details
    public function show(Product $product)
    {
        $product->load(['category', 'subcategory']);

        return view('admin.products.show', compact('product'));
    }

    
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }


    private function generateSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}