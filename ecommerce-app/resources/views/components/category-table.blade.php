@php
    $headers = ['Name', 'Description', 'Actions'];
@endphp

<x-data-table :headers="$headers">

    @foreach ($categories as $category)
        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <input id="checkbox-table-search-1" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                </div>
            </td>
            {{-- Name --}}
            <td
                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $category->name }}
            </td>
            {{-- Description --}}
            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $category->description }}
            </td>
            {{-- Actions --}}
            <td class="p-4 space-x-2 whitespace-nowrap">
                <x-action-button
                    :item="$category"
                    action="edit"
                    target="category"
                    color="primary"
                    modalPrefix="edit"/>

                <x-action-button
                    :item="$category"
                    action="delete"
                    target="category"
                    color="red"
                    modalPrefix="delete"/>
            </td>
        </tr>
    @endforeach

</x-data-table>
