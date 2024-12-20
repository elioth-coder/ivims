@php
    $defaults = [
        'class' => 'w-full bg-white rounded-lg shadow border',
];
@endphp

<div {{ $attributes($defaults) }}>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        {{ $slot }}
    </div>
</div>
