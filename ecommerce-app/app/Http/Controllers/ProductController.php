<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UserReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::all(); // Assuming you have a Category model

        return view('admin.crud.products', compact('products', 'categories'));
    }

    public function exportToCsv()
    {
        $products = Product::all();

        $csvData = [];
        $csvData[] = ['ID', 'Name', 'Description', 'Price', 'Category', 'Image URL', 'Quantity in Stock'];

        foreach ($products as $product) {
            $csvData[] = [
                $product->id,
                $product->name,
                $product->description,
                $product->price,
                $product->categories->first()->name ?? 'N/A', // Assuming you have a relationship set up
                $product->image_url,
                $product->qty_in_stock,
            ];
        }

        $filename = 'products_'.date('Ymd_His').'.csv';
        $handle = fopen($filename, 'w');

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        return response()->download($filename)->deleteFileAfterSend(true);
    }

    public function show(Product $product)
    {
        $userReviews = UserReview::withWhereHas('orderItem', function ($query) use ($product) {
            $query->where('product_id', $product->id);
        })->get();
        $userReviewCount = $userReviews->count();
        $userReviewAverage = $userReviews->avg('rating');

        return view('products.show', [
            'product' => $product,
            'userReviews' => $userReviews,
            'userReviewCount' => $userReviewCount,
            'userReviewAverage' => $userReviewAverage,
        ]);
    }

    public function create()
    {
        $categories = ProductCategory::all();

        return view('admin.products.create', compact('categories'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();

        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image_url')) {
            $new_image = $request->file('image_url')->store('products');

            if ($product->image_url && Storage::exists($product->image_url)) {
                Storage::delete($product->image_url);
            }
        } else {
            $new_image = $product->image_url;
        }

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'product_category_id' => $validated['category_id'],
            'image_url' => $new_image,
            'qty_in_stock' => $validated['qty_in_stock'],
        ]);

        return redirect(route('admin.products.index'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $path = $request->file('image_url')->store('products');
        $product->image_url = $path;
        $product->qty_in_stock = $validated['qty_in_stock'];
        $product->product_category_id = $validated['category_id'];

        $product->save();

        return redirect(route('admin.products.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('admin.products.index'));
    }
}
