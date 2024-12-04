@php
$path = '/search/insured_vehicles';
if(str_starts_with(request()->path(), 'search/')) {
    $path = "/". request()->path();
}
@endphp

<form class="w-full" action="{{ $path }}" method="GET">
    <div class="flex">
        <section class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600">
            Search
        </section>
        <div class="relative w-full">
            <input type="search"
                name="query"
                value="{{ request('query') ?? '' }}"
                class="block p-2.5 w-full z-20 text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-gray-500"
                placeholder="COC no, plate no, MV file no"
            />
            <button type="submit" class="absolute top-0 end-0 p-2.5 px-4 text-sm font-medium h-full text-gray-900 bg-gray-100 rounded-e-lg border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-100 dark:focus:ring-gray-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </div>
    </div>
</form>
