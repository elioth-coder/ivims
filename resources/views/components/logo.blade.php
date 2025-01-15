@php
    $defaults = [
        'class' => '',
    ];
@endphp

<img {{ $attributes($defaults) }} src="{{ asset('images/logo.png') }}" alt="logo">
