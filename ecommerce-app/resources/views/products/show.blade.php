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

    <!-- Product Details -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8">
        <!-- Product Image -->
        <div class="w-full lg:w-1/2">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover rounded-lg shadow-lg">
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

    <!-- Feedback Form (Visible to Authenticated Users Only) -->
    @auth
        <div class="w-1/2 mx-auto py-6 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800">Leave Your Feedback</h2>
            <form action="{{ route('review.store', ['order_item_id' => $product['id']]) }}" method="POST">
                @csrf
                @method('POST')
                <div class="mt-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Your Feedback</label>
                    <textarea id="comment" name="comment" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div class="mt-4">
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                    <select id="rating" name="rating"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <div class="mt-6">
                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700">Submit
                        Feedback</button>
                </div>
            </form>
        </div>
    @endauth

    <!-- Feedback Section -->
    <div class="w-1/2 mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800">Customer Feedback</h2>

        @forelse ($userReviews as $userReview)
            <div class="bg-white p-4 mt-4 rounded-lg shadow">
                <div class="flex items-center inline-flex">
                    <!-- Feedback Rating -->
                    @for ($i = 0; $i < floor($userReview['rating']); $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.87" height="20.801"
                            class="text-yellow-400 fill-current">
                            <path
                                d="m4.178 20.801 6.758-4.91 6.756 4.91-2.58-7.946 6.758-4.91h-8.352L10.936 0 8.354 7.945H0l6.758 4.91-2.58 7.946z" />
                        </svg>
                    @endfor
                    @for ($i = $userReview['rating']; $i < 5; $i++)
                        <svg xmlns="http://www.w3.org/2000/svg" width="21.87" height="20.801"
                            class="text-gray-300 fill-current">
                            <path
                                d="m4.178 20.801 6.758-4.91 6.756 4.91-2.58-7.946 6.758-4.91h-8.352L10.936 0 8.354 7.945H0l6.758 4.91-2.58 7.946z" />
                        </svg>
                    @endfor
                    <a class="ml-4">Edit</a>
                    <a class="ml-4">Delete</a>
                </div>
                <p class="mt-2 text-gray-600">{{ $userReview['comment'] }}</p>
            </div>
        @empty
            <p class="mt-4 text-gray-600">No feedback available for this product.</p>
        @endforelse
    </div>

    

    <!-- Footer -->
    @include('layouts.footer')
</body>

</html>
