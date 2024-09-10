<tbody class="divide-y divide-gray-200 dark:divide-gray-800">
    <tr>
        <td class="whitespace-nowrap py-4 md:w-[384px]">
            <div class="flex items-center gap-4">
                <a href="#" class="flex items-center aspect-square w-10 h-10 shrink-0">
                    <img class="h-auto w-full max-h-full dark:hidden" src="{{ $orderItem->product->image_url }}"
                        alt="watch image" />
                    <img class="hidden h-auto w-full max-h-full dark:block"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg"
                        alt="watch image" />
                    <a href="#" class="hover:underline">{{ $orderItem->product->name }}</a>
            </div>
        </td>

        <td class="p-4 text-base font-normal text-gray-900 dark:text-white">
            x{{ $orderItem->qty }}</td>
        <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">
            ${{ $orderItem->product->price * $orderItem->qty }}
        </td>
    </tr>
</tbody>
