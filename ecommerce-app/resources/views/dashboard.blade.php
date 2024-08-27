<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css"  rel="stylesheet" />
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
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
    <!-- <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('dashboard.index') }}" class="bg-white p-6 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

               
                <div>
                    <label for="sort-alphabet" class="block text-gray-700">Sort by Alphabet</label>
                    <select name="sort-alphabet" id="sort-alphabet"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Select</option>
                        <option value="az" {{ request('sort-alphabet') == 'az' ? 'selected' : '' }}>A-Z</option>
                        <option value="za" {{ request('sort-alphabet') == 'za' ? 'selected' : '' }}>Z-A</option>
                    </select>
                </div>

              
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

               
                <div>
    <label for="category" class="block text-gray-700">Filter by Category</label>
    <select name="category" id="category"
        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
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
            <x-cart-side-bar />
        <div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 flex justify-end items-center space-x-4">
    <!-- Filter Button -->
    <button data-modal-toggle="filterModal" data-modal-target="filterModal" type="button" class="flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
        <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
        </svg>
        Filters
        <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
        </svg>
    </button>

<!-- Sort Button -->
<button id="sortDropdownButton1" data-dropdown-toggle="dropdownSort1" type="button" class="flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
    <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4" />
    </svg>
    Sort
    <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
    </svg>
</button>

<!-- Sort Dropdown -->
<div id="dropdownSort1" class="z-50 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
    <ul class="p-2 text-left text-sm font-medium text-gray-500 dark:text-gray-400" aria-labelledby="sortDropdownButton1">
        <li><button type="button" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" onclick="applySort('az')">A-Z</button></li>
        <li><button type="button" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" onclick="applySort('za')">Z-A</button></li>
        <li><button type="button" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" onclick="applySort('low-high')">Increasing price</button></li>
        <li><button type="button" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" onclick="applySort('high-low')">Decreasing price</button></li>
        <li><button type="button" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" onclick="applySort('rating-low-high')">Increasing ratings</button></li>
        <li><button type="button" class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white" onclick="applySort('rating-high-low')">Decreasing ratings</button></li>
    </ul>
</div>

<!-- Sort and Filter Form -->
<form id="filterSortForm" method="GET" action="{{ route('dashboard.index') }}">
    <!-- Existing filters will be passed here as hidden inputs -->
    <input type="hidden" name="sort" id="sortInput" value="">
    @if(is_array(request('categories')))
    @foreach(request('categories') as $categoryId)
        <input type="hidden" name="categories[]" value="{{ $categoryId }}">
    @endforeach
@else
    <input type="hidden" name="categories[]" value="{{ request('categories') }}">
@endif

    <input type="hidden" name="search" value="{{ request('search') }}">
    <!-- Any other necessary filters -->
</form>

</div>
<form action="{{ route('dashboard.index') }}" method="get" id="filterModal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0 md:h-full">
    <div class="relative h-full w-full max-w-xl md:h-auto">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-start justify-between rounded-t p-4 md:p-5">
                <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">Filters</h3>
                <button type="button" class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="filterModal">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="px-4 md:px-5">
                <div class="flex flex-wrap gap-4">
                    <div class="w-full">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">Category</h5>
                        <!-- Category List -->
                        <div class="grid grid-cols-2 gap-4">
                            @foreach($categories as $category)
                            <div class="flex items-center">
                                <input id="category-{{ $category->id }}" type="checkbox" value="{{ $category->id }}" name="categories[]" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                                <label for="category-{{ $category->id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }} ({{ $category->products_count }})</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center space-x-4 rounded-b p-4 dark:border-gray-600 md:p-5">
                <button type="submit" class="rounded-lg bg-primary-700 px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-800">Show 0 results</button>
                <button type="reset" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Reset</button>
            </div>
        </div>
            <x-cart-side-bar />
        <div>
        </div>
    </div>
</form>

<div class="flex-grow">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="h-56 w-full">
                        <a href="{{ route('products.show', ['product' => $product->id]) }}">
                            <img class="mx-auto h-full dark:hidden" src="{{ $product->image_url }}" alt="{{ $product->name }}" />
                        </a>
                    </div>
                    <div class="pt-6">
                        <a href="{{ route('products.show', ['product' => $product->id]) }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $product->name }}</a>
                        <p class="text-gray-500 mt-2">{{ $product->description }}</p>
                        <p class="text-gray-600 mt-2">Category: {{ $product->category?->name }}</p>
                        <div class="mt-2 flex items-center gap-2">
                            <div class="flex items-center">
                                @for ($i = 0; $i < floor($product->user_reviews_avg_rating); $i++)
                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>
                                @endfor
                                @for ($i = $product->user_reviews_avg_rating; $i < 5; $i++)
                                    <svg class="h-4 w-4 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>
                                @endfor
                                <span class="ml-2 text-gray-600">{{ number_format($product->user_reviews_avg_rating, 1) }}</span>
                                <span class="ml-2 text-gray-600">({{ $product->user_reviews_count }} reviews)</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between gap-4">
                            <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</p>
                            <button type="button" class="inline-flex items-center rounded-lg bg-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                            <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
              </svg>
    Add to cart
    </button>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    {{ $products->appends(request()->query())->links('pagination::tailwind') }}
</div>
</div>



@include('layouts.footer')
    <!-- Footer -->
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('myCartDropdownButton1').click();
});
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const categoryCheckboxes = document.querySelectorAll('input[name="categories[]"]');
    const resultsButton = document.querySelector('#filterModal button[type="submit"]');
    const resetButton = document.querySelector('#filterModal button[type="reset"]');
    const originalButtonText = resultsButton.textContent;

    function updateResultsButton() {
        const selectedCategories = Array.from(categoryCheckboxes).filter(checkbox => checkbox.checked);
        let totalProducts = 0;

        selectedCategories.forEach(function (checkbox) {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            const count = parseInt(label.textContent.match(/\((\d+)\)/)[1]);
            totalProducts += count;
        });

        resultsButton.textContent = totalProducts > 0 ? `Show ${totalProducts} results` : 'Show 0 results';
    }

    categoryCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', updateResultsButton);
    });

    resetButton.addEventListener('click', function () {
        // Reset the button text to "Show 0 results" when the reset button is clicked
        resultsButton.textContent = 'Show 0 results';
    });
});
</script>
<script>
function applySort(sortOption) {
    // Set the sort option in the hidden input
    document.getElementById('sortInput').value = sortOption;

    // Submit the form with existing filters and the selected sort option
    document.getElementById('filterSortForm').submit();
}
</script>



</body>

</html>
