@props(['size'=>'8'])

@php
    $defaults = [
        'class' => 'flex items-center text-2xl font-semibold text-gray-900 text-white'
    ];
@endphp

<a href="/" {{ $attributes($defaults) }}>
    <x-logo class="w-{{ $size }} h-{{ $size }} mr-2" />
    @if ($slot->isEmpty())
        IVIM System <sup class="hidden sm:inline">v1.0.0</sup>
    @else
        {{ $slot }}
    @endif
</a>
