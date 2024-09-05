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
				<div class="w-full overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
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
						<div class="w-full mx-auto">
							<form action="{{ route('review.store', ['order_item_id' => $orderItem->id]) }}" method="POST" class="w-full flex items-center gap-4">
								@csrf
								@method('POST')
								<div class="mt-4 w-3/4">
									<textarea id="comment" name="comment" rows="4" placeholder="Your feedback"
										class="mt-1 block w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
								</div>
								<div class="flex items-center gap-4">
									<div class="mt-4">
										<select id="rating" name="rating"
											class="mt-1 block w-full h-12 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
											<option value="5">5 Stars</option>
											<option value="4">4 Stars</option>
											<option value="3">3 Stars</option>
											<option value="2">2 Stars</option>
											<option value="1">1 Star</option>
										</select>
									</div>
									<div class="mt-6">
										<button 
											type="submit"
											class="h-12 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none flex items-center justify-center"
										>
											Submit Feedback
										</button>
									</div>
								</div>
							</form>
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
