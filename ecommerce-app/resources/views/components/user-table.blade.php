@php
    $headers = ['Name', 'Telephone', 'Status', 'Actions'];
@endphp

<x-data-table :headers="$headers">

    @foreach ($users as $user)
        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
            <td class="w-4 p-4">
                <div class="flex items-center">
                    <input id="checkbox-table-search-1" type="checkbox"
                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                </div>
            </td>
            {{-- Name and Email --}}
            <td class="p-4 mr-12 whitespace-nowrap">
                <div class="text-base font-semibold text-gray-900 dark:text-white">
                    {{ $user->first_name . ' ' . $user->last_name }}</div>
                <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    {{ $user->email }}
                </div>
            </td>
            <td
                class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $user->telephone }}
            </td>
            {{-- Status --}}
            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                <x-user-status :user="$user"/>
            </td>
            {{-- Actions --}}
            <td class="p-4 space-x-2 whitespace-nowrap">
                <x-action-button
                    :item="$user"
                    action="edit"
                    target="user"
                    color="primary"
                    modalPrefix="edit"/>

                <x-action-button
                    :item="$user"
                    action="delete"
                    target="user"
                    color="red"
                    modalPrefix="delete"/>
            </td>
        </tr>
    @endforeach

</x-data-table>
