@props(['item','target','action' => 'edit','modalPrefix', 'color' => 'primary'])

@php
    // Define the appropriate colors based on the action
    $buttonColors = $color === 'primary' ? [
        'bg' => 'bg-primary-700',
        'hoverBg' => 'hover:bg-primary-800',
        'ring' => 'focus:ring-primary-300',
        'darkBg' => 'dark:bg-primary-600',
        'darkHoverBg' => 'dark:hover:bg-primary-700',
        'darkRing' => 'dark:focus:ring-primary-800'
    ] : [
        'bg' => 'bg-red-600',
        'hoverBg' => 'hover:bg-red-800',
        'ring' => 'focus:ring-red-300',
        'darkBg' => 'dark:bg-red-900',
        'darkHoverBg' => 'dark:hover:bg-red-900',
        'darkRing' => 'dark:focus:ring-red-900'
    ];
@endphp

<button
    data-modal-target="{{$modalPrefix}}-{{ $item->id }}-modal"
    data-modal-toggle="{{$modalPrefix}}-{{ $item->id }}-modal"
    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg {{ $buttonColors['bg'] }} {{ $buttonColors['hoverBg'] }} focus:ring-4 {{ $buttonColors['ring'] }} {{ $buttonColors['darkBg'] }} {{ $buttonColors['darkHoverBg'] }} {{ $buttonColors['darkRing'] }}">

    @if($action === 'edit')
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
            </path>
            <path fill-rule="evenodd"
                  d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                  clip-rule="evenodd"></path>
        </svg>
    @elseif($action === 'delete')
        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                  clip-rule="evenodd"></path>
        </svg>
    @endif

    {{-- Button label --}}
    {{ ucfirst($action) }} {{ $target }}

</button>
