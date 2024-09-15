@props(['user'])
<div class="flex items-center">
    <form method="POST"
          action="{{ route('admin.users.toggleStatus', $user) }}"
          id="updateStatusForm-{{ $user->id }}">
        @csrf
        @method('PUT')
        <label class="inline-flex items-center me-5 cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer"
                   name="active-status[]"
                   {{ $user->is_active ? 'checked' : '' }}
                   onchange="document.getElementById('updateStatusForm-{{ $user->id }}').submit();">
            <div
                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                {{ $user->is_active ? 'Active' : 'Offline' }}
            </span>
        </label>
    </form>
</div>
