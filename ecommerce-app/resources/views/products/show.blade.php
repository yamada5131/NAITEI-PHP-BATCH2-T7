<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - My Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    @include('layouts.navigation')

    <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                    <img class="w-full dark:hidden" src="{{ asset("storage/" . $product->image_url) }}" alt="{{ $product->image_url }}" />
                </div>

        <!-- Product Info -->
        <div class="w-full lg:w-1/2">
            <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
            <p class="mt-4 text-gray-600">{{ $product->description }}</p>
            <p class="mt-4 text-2xl font-semibold text-gray-900">${{ $product->price }}</p>

            <div class="mt-4 flex items-center">
                <!-- Product Rating -->
                @for ($i = 0; $i < floor($userReviewAverage); $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" width="21.87" height="20.801"
                        class="text-yellow-400 fill-current">
                        <path
                            d="m4.178 20.801 6.758-4.91 6.756 4.91-2.58-7.946 6.758-4.91h-8.352L10.936 0 8.354 7.945H0l6.758 4.91-2.58 7.946z" />
                    </svg>
                @endfor
                @for ($i = floor($userReviewAverage); $i < 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" width="21.87" height="20.801"
                        class="text-gray-300 fill-current">
                        <path
                            d="m4.178 20.801 6.758-4.91 6.756 4.91-2.58-7.946 6.758-4.91h-8.352L10.936 0 8.354 7.945H0l6.758 4.91-2.58 7.946z" />
                    </svg>
                @endfor
                <span class="ml-2 text-gray-600">{{ $userReviewAverage }} stars</span>
                <span class="ml-2 text-gray-600">({{ $userReviewCount }} reviews)</span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</body>

</html>
