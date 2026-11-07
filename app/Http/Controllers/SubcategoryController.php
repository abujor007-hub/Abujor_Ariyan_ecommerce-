<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SubcategoryController extends Controller
{
    
    public function index()
    {
        $subcategories = Subcategory::with('category')->latest()->paginate(10);

        return view( 'admin.subcategories.index',compact('subcategories'));
    }

    
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.subcategories.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',

            'name' => ['required','string','max:255',
                Rule::unique('subcategories', 'name')
                    ->where('category_id', $request->category_id),
            ],

            'description' => 'nullable|string|max:1000',
        ]);

        $category = Category::findOrFail($validated['category_id']);

        Subcategory::create([
            'category_id' => $category->id,
            'name' => $validated['name'],
            'slug' => Str::slug($category->name . '-' . $validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()  ->route('subcategories.index') ->with('success', 'Subcategory created successfully!');
    }

    
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy('name')->get();

        return view( 'admin.subcategories.edit', compact('subcategory', 'categories')
        );
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',

            'name' => [ 'required', 'string',  'max:255',
                Rule::unique('subcategories', 'name')
                    ->where('category_id', $request->category_id)
                    ->ignore($subcategory->id),
            ],

            'description' => 'nullable|string|max:1000',
        ]);

        $category = Category::findOrFail($validated['category_id']);

        $subcategory->update([
            'category_id' => $category->id,
            'name' => $validated['name'],
            'slug' => Str::slug($category->name . '-' . $validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()  ->route('subcategories.index')  ->with('success', 'Subcategory updated successfully!');
    }

    
public function destroy(Subcategory $subcategory)
{
    if ($subcategory->products()->exists()) {
        return redirect() ->route('subcategories.index') ->with('error', 'Cannot delete! This subcategory has products.');
    }

    $subcategory->delete();

    return redirect() ->route('subcategories.index') ->with('success', 'Subcategory deleted successfully!');
}
}