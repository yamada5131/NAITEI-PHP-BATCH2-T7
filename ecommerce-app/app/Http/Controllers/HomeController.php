<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $products = Product::with('userReviews')
            ->withAvg('userReviews', 'rating')
            ->withCount('userReviews')
            // ->orderByDesc(['trendRating'])
            ->paginate(20);

        // dd($products->toArray());

        return view('home', [
            'user' => Auth::user(),
            'products' => $products,
        ]);
    }
}
