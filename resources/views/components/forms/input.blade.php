@props([
    'list' => '',
    'name' => '',
    'value' => '',
    'type' => 'text',
])

@php
    $defaults = [
        'id' => $name,
        'name' => $name,
        'type' => $type,
        'list' => $list,
        'placeholder' => '',
        'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'value' => (old($name)) ? old($name) : $value,
    ];
@endphp

<input {{ $attributes($defaults) }} />
