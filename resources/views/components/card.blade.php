@php
    $defaults = [
        'class' => 'w-full bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700',
];
@endphp

<div {{ $attributes($defaults) }}>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        {{ $slot }}
    </div>
</div>
