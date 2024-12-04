<form {{ $attributes(["class" => "space-y-4 md:space-y-6", "method" => "GET"]) }}>
    @if ($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @method($attributes->get('verb') ?? $attributes->get('method'))
    @endif

    {{ $slot }}
</form>
