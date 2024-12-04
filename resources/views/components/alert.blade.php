@props(['color','id'])

<div id="{{ $id }}"
    class="flex items-center p-4 mb-4 text-{{ $color }}-800 rounded-lg bg-{{ $color }}-50 dark:bg-gray-800 dark:text-{{ $color }}-400"
    role="alert">
    {{ $icon }}
    <div class="ms-3 text-sm font-medium">
        {{ $slot }}
    </div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-{{ $color }}-50 text-{{ $color }}-500 rounded-lg focus:ring-2 focus:ring-{{ $color }}-400 p-1.5 hover:bg-{{ $color }}-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-{{ $color }}-400 dark:hover:bg-gray-700"
        data-dismiss-target="#{{ $id }}" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>
