<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    // public function index()
    // {
    //     $categories = ProductCategory::all();
    //     return view('admin.categories.index',compact('categories'));
    // }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        ProductCategory::create($validated);

        return redirect()->route('/admin')
                        ->with('success','Category created successfully.');
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('admin.categories.edit',compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $validated = $request->validated();

        $category->update($validated);

        return redirect()->route('/admin')
                        ->with('success','Category updated successfully');
    }

    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('/admin')
                        ->with('success','Category deleted successfully');
    }
}
