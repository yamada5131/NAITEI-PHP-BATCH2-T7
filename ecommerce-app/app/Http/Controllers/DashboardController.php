<?php

    namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\Models\Product;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\Models\ViewedProduct;
    use App\Models\ProductCategory;
    use Illuminate\Support\Facades\Auth;

    class DashboardController extends Controller
    {
        $products = Product::with('userReviews')
            ->withAvg('userReviews', 'rating')
            ->withCount('userReviews');



        // Filter by category
        if ($filterCategory) {
            $products = $products->where('product_category_id', $filterCategory);
        }

        if ($search)
        {
            $products = $products->where('name', 'LIKE', '%' . $search . '%');
        }
        
        switch (true) {
            case $sortAlphabet === 'az':
                $products = $products->orderBy('name', 'ASC');
                break;
            case $sortAlphabet === 'za':
                $products = $products->orderBy('name', 'DESC');
                break;
            case $sortPrice === 'low-high':
                $products = $products->orderBy('price', 'ASC');
                break;
            case $sortPrice === 'high-low':
                $products = $products->orderBy('price', 'DESC');
                break;
            case $sortRating === 'low-high':
                $products = $products->orderBy('user_reviews_avg_rating', 'asc');
                break;
            case $sortRating === 'high-low':
                $products = $products->orderBy('user_reviews_avg_rating', 'desc');
                break;
        }

        $products = $products->get();

        return view('dashboard', [
            'products' => $products,
        ]);
    }

            $products = $query->paginate(15);;
            $recentlyViewedProducts = collect();
            if (Auth::check()) {
                $recentlyViewedProducts = ViewedProduct::where('user_id', Auth::id())
                    ->with('product')
                    ->orderBy('viewed_at', 'desc')
                    ->take(5)
                    ->get();
            }
            return view('dashboard', [
                'products' => $products,
                'categories' => $categories,
                'recentlyViewedProducts' => $recentlyViewedProducts,
                'trendingProducts' => $trendingProducts,
            ]);
        }

        public function search(Request $request)
        {
            $search = $request->input('search');

            if ($search)
            {
                $products = DB::table('products')->where('name', $search)->get();
                return view('dashboard', [
                    'products' => $products,
                ]);
            }

            $products = Product::all();
            return view('dashboard', [
                'products' => $products,
            ]);
        }
    }
