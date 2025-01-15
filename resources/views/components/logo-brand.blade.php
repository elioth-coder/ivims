@props(['size'=>'12'])

@php
    $defaults = [
        'class' => 'flex items-center text-3xl font-semibold text-gray-900 text-white'
    ];
@endphp

<a href="/" {{ $attributes($defaults) }}>
    <x-logo class="w-12 mr-2" />
    @if ($slot->isEmpty())
        IVIM System <sup class="hidden sm:inline">v1.0.0</sup>
    @else
        {{ $slot }}
    @endif
</a>
