{{--  TODO: Breaking form into blade component  --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <form action="/orders" method="POST" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            @csrf
            <div class="mx-auto max-w-3xl">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order summary</h2>

                <div class="mt-6 space-y-4 border-b border-t border-gray-200 py-8 dark:border-gray-700 sm:mt-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Billing & Delivery information</h4>

                    <dl>
                        <dt class="text-base font-medium text-gray-900 dark:text-white">
                            {{ $user->first_name . ' ' . $user->last_name }}
                        </dt>
                        <dd id="selectedAddress" class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400">
                            {{ $defaultAddress->address_line1 . ' ' . $defaultAddress->address_line2 . ' ' . $defaultAddress->city . ' ' . $defaultAddress->state . ' ' . $defaultAddress->postal_code }}
                        </dd>
                    </dl>

                    <button type="button" data-modal-target="billingInformationModal"
                        data-modal-toggle="billingInformationModal"
                        class="text-base font-medium text-primary-700 hover:underline dark:text-primary-500">Edit</button>
                </div>

                <div class="mt-6 sm:mt-8">
                    <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                        <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                            @foreach ($orderItems as $orderItem)
                                <x-orders.order-item :orderItem="$orderItem" />
                            @endforeach
                        </table>
                    </div>

                    <div class="mt-4 space-y-6">
                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</h4>

                        <div class="space-y-4">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-gray-500 dark:text-gray-400">Original price</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">${{ $totalPrice }}
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-gray-500 dark:text-gray-400">Savings</dt>
                                    <dd class="text-base font-medium text-green-500">-$000.00</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-gray-500 dark:text-gray-400">Store Pickup</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">$00</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-gray-500 dark:text-gray-400">Tax</dt>
                                    <dd class="text-base font-medium text-gray-900 dark:text-white">$000</dd>
                                </dl>
                            </div>

                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-lg font-bold text-gray-900 dark:text-white">${{ $totalPrice }}</dd>
                            </dl>
                        </div>

                        <div class="flex items-start sm:items-center">
                            <input id="terms-checkbox-2" type="checkbox" name="terms" value="1"
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="terms-checkbox-2"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"> I agree with the <a
                                    href="#" title=""
                                    class="text-primary-700 underline hover:no-underline dark:text-primary-500">Terms
                                    and
                                    Conditions</a> of use of the Flowbite marketplace </label>
                        </div>

                        <div class="gap-4 sm:flex sm:items-center">
                            <button type="button"
                                class="w-full rounded-lg  border border-gray-200 bg-white px-5  py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Return
                                to Shopping
                            </button>
                            <!-- Order Details -->
                            {{-- <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> --}}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="order_date" value="{{ now() }}">
                            <input type="hidden" name="address_id" value="{{ $defaultAddress->id }}">
                            <input type="hidden" name="order_total" value="{{ $totalPrice }}">

                            <!-- Order Items -->
                            @foreach ($orderItems as $item)
                                <input type="hidden" name="order_items[{{ $loop->index }}][product_id]"
                                    value="{{ $item->product_id }}">
                                <input type="hidden" name="order_items[{{ $loop->index }}][qty]"
                                    value="{{ $item->qty }}">
                                <input type="hidden" name="order_items[{{ $loop->index }}][price]"
                                    value="{{ $item->product->price }}">
                            @endforeach
                            <button type="submit"
                                class="mt-4 flex w-full items-center justify-center rounded-lg bg-primary-700  px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300  dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0">Send
                                the order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

</body>

</html>
