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
        public function index(Request $request)
        {
            $query = Product::with('category')
                ->withAvg('userReviews', 'rating')
                ->withCount('userReviews');
                $trendingProducts = Product::with('userReviews')
                ->withAvg('userReviews', 'rating')
                ->withCount('userReviews')
                ->get()
                ->sortByDesc('user_reviews_avg_rating') // Sort by average rating (highest first)
                ->take(6); // Limit the trending products to 6 items
                $categories = ProductCategory::withCount('products')->get();
                $sort = $request->input('sort');
                switch ($sort) {
                    case 'az':
                        $query->orderBy('name', 'ASC');
                        break;
                    case 'za':
                        $query->orderBy('name', 'DESC');
                        break;
                    case 'low-high':
                        $query->orderBy('price', 'ASC');
                        break;
                    case 'high-low':
                        $query->orderBy('price', 'DESC');
                        break;
                    case 'rating-low-high':
                        $query->orderBy('user_reviews_avg_rating', 'asc');
                        break;
                    case 'rating-high-low':
                        $query->orderBy('user_reviews_avg_rating', 'desc');
                        break;
                }
            $filterCategories = $request->input('categories');
            if ($filterCategories && is_array($filterCategories)) {
                $query->whereIn('product_category_id', $filterCategories);
            }
            
            $search = $request->input('search');




            // Filter by category

            if ($search)
            {
                $query->where('name', 'LIKE', '%' . $search . '%');
            }
            

                // them truong rating khi lay data sp
                // case $sortRating === 'low-high':
                //     $query->orderBy('rating', 'asc');
                //     break;
                // case $sortRating === 'high-low':
                //     $query->orderBy('rating', 'desc');
                //     break;
            

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
