@props(['active'=>'Dashboard'])

@php
$activeClass = 'text-white bg-violet-700 block w-full px-4 py-3 border-b border-gray-200 cursor-pointer';
$inactiveClass = 'block w-full px-4 py-2 border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-700 focus:text-violet-700';

$links = [
    [
        'url'   => '/u',
        'title' => 'Dashboard',
    ],
    [
        'url'   => '/u/insurance',
        'title' => 'CTPL Insurance',
    ],
    [
        'url'   => '/u/customer_support',
        'title' => 'Customer Support',
    ],
]

@endphp
<div
    class="my-1 w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    @foreach($links as $link)
        <a href="{{ $link['url'] }}"
            class="{{ ($active==$link['title']) ? $activeClass : $inactiveClass }}">
            {{ $link['title'] }}
        </a>
    @endforeach
</div>
