<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    @include('layouts.navigation')
    <!-- Display Error Message -->
    @if (Session::has('error'))
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">{{ Session::get('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Filter & Sort Form -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('dashboard.index') }}" class="bg-white p-6 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Sort by Alphabet -->
                <div>
                    <label for="sort-alphabet" class="block text-gray-700">Sort by Alphabet</label>
                    <select name="sort-alphabet" id="sort-alphabet"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="az" {{ request('sort-alphabet') == 'az' ? 'selected' : '' }}>A-Z</option>
                        <option value="za" {{ request('sort-alphabet') == 'za' ? 'selected' : '' }}>Z-A</option>
                    </select>
                </div>

                <!-- Sort by Price -->
                <div>
                    <label for="sort-price" class="block text-gray-700">Sort by Price</label>
                    <select name="sort-price" id="sort-price"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="low-high" {{ request('sort-price') == 'low-high' ? 'selected' : '' }}>Lowest to
                            Highest</option>
                        <option value="high-low" {{ request('sort-price') == 'high-low' ? 'selected' : '' }}>Highest to
                            Lowest</option>
                    </select>
                </div>

                <!-- Sort by Rating -->
                <div>
                    <label for="sort-rating" class="block text-gray-700">Sort by Rating</label>
                    <select name="sort-rating" id="sort-rating"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="low-high" {{ request('sort-rating') == 'low-high' ? 'selected' : '' }}>Lowest to
                            Highest</option>
                        <option value="high-low" {{ request('sort-rating') == 'high-low' ? 'selected' : '' }}>Highest to
                            Lowest</option>
                    </select>
                </div>

                <!-- Filter by Category (Hardcoded) -->
                <div>
                    <label for="category" class="block text-gray-700">Filter by Category</label>
                    <select name="category" id="category"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">All Categories</option>
                        <option value="Kitchen" {{ request('category') == 'Kitchen' ? 'selected' : '' }}>Kitchen</option>
                        <option value="Furniture" {{ request('category') == 'Furniture' ? 'selected' : '' }}>Furniture
                        </option>
                        <option value="Electronics" {{ request('category') == 'Electronics' ? 'selected' : '' }}>
                            Electronics</option>
                    </select>
                </div>

            </div>
            <div class="mt-6 text-right">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Main Content -->
    <div class="flex-grow">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <x-product :product="$product" />
                @endforeach
            </div>
        </div>

        <div>
            <x-cart-side-bar test="testdata" />
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-400 py-8 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-white">My Shop</h3>
                    <p class="mt-2">Your one-stop shop for all things cool and trendy.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white">Quick Links</h4>
                    <ul class="mt-2 space-y-2">
                        <li><a href="#" class="hover:text-white">Home</a></li>
                        <li><a href="#" class="hover:text-white">Shop</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-white">Contact Us</h4>
                    <ul class="mt-2 space-y-2">
                        <li>Email: support@myshop.com</li>
                        <li>Phone: +123 456 7890</li>
                        <li>Address: 123 Main Street, Anytown</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
