<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Home</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    @include('layouts.navigation')
    
    <!-- Main Content -->
    <div class="flex-grow">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <h2 class="mb-6 text-2xl font-bold text-gray-800">Trending Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <x-product :product="$product" />
                @endforeach
            </div>
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
