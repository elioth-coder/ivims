<x-layout>
    <x-slot:title>Search</x-slot:title>
    <x-slot:head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
        <style>
            html,
            body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="mx-auto flex">
            <x-sidebar active="Search" activeSub="Home" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Search',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="flex flex-col">

                        </div>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            window.onload = function() {
                new DataTable("#policy-holders-table", {
                    fixedHeight: true,
                    searchable: true,
                    perPage: 50,
                });
                new DataTable("#insured-vehicles-table", {
                    fixedHeight: true,
                    searchable: true,
                    perPage: 50,
                });
            };
        </script>
    </x-slot:scripts>
</x-layout>
