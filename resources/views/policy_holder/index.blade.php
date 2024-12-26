<x-layout>
    <x-slot:title>Home</x-slot:title>
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
        <style>
            html,
            body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar-policy_holder />
    <div class="w-full pt-[70px]">
        <main class="max-w-screen-lg mx-auto flex">
            <div class="w-full overflow-hidden min-h-screen">
                <div class="grid grid-cols-4 gap-4">
                    <div class="py-4">
                        <x-policy_holder.sidebar />
                    </div>
                    <div class="col-span-3 py-4">
                        <x-policy_holder.breadcrumb />
                    </div>
                </div>

                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script></script>
    </x-slot:scripts>
</x-layout>
