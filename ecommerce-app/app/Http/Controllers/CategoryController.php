<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();

        return view('admin.crud.categories', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        ProductCategory::create($validated);

        return redirect()->route('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $validated = $request->validated();

        $category->update($validated);

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index');
    }


    public function exportToCsv()
    {
        $categories = ProductCategory::all();

        $csvData = [];
        $csvData[] = ['ID', 'Name', 'Description'];

        foreach ($categories as $category) {
            $csvData[] = [
                $category->id,
                $category->name,
                $category->description,
            ];
        }

        $filename = 'categories_' . date('Ymd_His') . '.csv';
        $handle = fopen($filename, 'w');

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
