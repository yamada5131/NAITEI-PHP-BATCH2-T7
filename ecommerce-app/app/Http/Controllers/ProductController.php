<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\UserReview;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.crud.products', compact('products'));
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
        Product::where('id', $product->id)
            ->update([
                'name' => $request->name,
                //                'description' => $request->description,
                'price' => $request->price,
                'image_url' => $request->image_url,
                'qty_in_stock' => $request->qty_in_stock,
            ]);

        return redirect(route('admin.products.index'));
    }

    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image_url = $request->image_url;
        $product->qty_in_stock = $request->qty_in_stock;
        $product->product_category_id = '8ce2ad96-0604-4c5a-8bee-bdd91462d580';

        $product->save();

        return redirect(route('admin.products.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('admin.products.index'));
    }
}
