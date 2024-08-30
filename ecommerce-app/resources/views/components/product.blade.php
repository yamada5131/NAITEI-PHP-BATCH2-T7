@props(
  ['product']
)

<div class="bg-white p-4 rounded-lg shadow">
    <a href="{{ route('products.show', ['product' => $product->id]) }}">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded">
    </a>
    <h3 class="mt-4 text-lg font-semibold">
        <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->name }}</a>
    </h3>
    <p class="text-gray-500">{{ $product->description }}</p>
    <p class="text-gray-600 mt-2">Category: {{ $product->category?->name }}</p>
    <p class="text-gray-800 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
    <div class="mt-2 flex items-center">
        <!-- Display stars for the product -->
        @for ($i = 0; $i < floor($product->rating); $i++)
            <svg xmlns="http://www.w3.org/2000/svg" width="21.87" height="20.801"
                class="text-yellow-400 fill-current">
                <path
                    d="m4.178 20.801 6.758-4.91 6.756 4.91-2.58-7.946 6.758-4.91h-8.352L10.936 0 8.354 7.945H0l6.758 4.91-2.58 7.946z" />
            </svg>
        @endfor
        @for ($i = $product->rating; $i < 5; $i++)
            <svg xmlns="http://www.w3.org/2000/svg" width="21.87" height="20.801"
                class="text-gray-300 fill-current">
                <path
                    d="m4.178 20.801 6.758-4.91 6.756 4.91-2.58-7.946 6.758-4.91h-8.352L10.936 0 8.354 7.945H0l6.758 4.91-2.58 7.946z" />
            </svg>
        @endfor
        <span class="ml-2 text-gray-600">{{ $product->rating }}</span>
        <span class="ml-2 text-gray-600">({{ $product->user_reviews_count }} reviews)</span>
    </div>
</div>
