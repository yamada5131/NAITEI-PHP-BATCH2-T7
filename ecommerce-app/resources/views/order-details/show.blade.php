<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Navigation Bar -->
    @include('layouts.navigation')

	<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
		<div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
			<h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Track the delivery of order {{ $orderDetail->id }}</h2>

			<div class="mt-6 sm:mt-8 lg:flex lg:gap-8">
				<div class="w-full overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700 lg:max-w-xl xl:max-w-2xl">
					@foreach ($orderItems as $orderItem)
					<div class="space-y-4 p-6">
						<div class="flex items-center gap-6">
							<a href="/products/{{ $orderItem-> product_id }}" class="h-14 w-14 shrink-0">
								<img class="h-full w-full dark:hidden" src="{{ $orderItem->product->image_url }}" alt="imac image" />
							</a>

							<a href="/products/{{ $orderItem-> product_id }}" class="min-w-0 flex-1 font-medium text-gray-900 hover:underline dark:text-white"> {{ $orderItem->product->name }} </a>
						</div>

						<div class="flex items-center justify-between gap-4">
							<p class="text-sm font-normal text-gray-500 dark:text-gray-400"><span class="font-medium text-gray-900 dark:text-white">Product ID:</span> {{ $orderItem->product_id }}</p>

							<div class="flex items-center justify-end gap-4">
								<p class="text-base font-normal text-gray-900 dark:text-white">x{{ $orderItem->qty }}</p>

								<p class="text-xl font-bold leading-tight text-gray-900 dark:text-white">${{ $orderItem->product->price }}</p>
							</div>
						</div>
					</div>
					@endforeach
					<div class="space-y-4 bg-gray-50 p-6 dark:bg-gray-800">
						<div class="space-y-2">
							<dl class="flex items-center justify-between gap-4">
								<dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
								<dd class="text-lg font-bold text-gray-900 dark:text-white">${{ $orderDetail->order_total }}</dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
