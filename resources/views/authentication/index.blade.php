<x-layout>
    <x-slot:title>Authentication</x-slot:title>
    <x-slot:head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
        <style>
            html, body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="mx-auto flex">
            <x-sidebar active="Authenticated" activeSub="List of Authenticated" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Authenticated',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="mx-auto max-w-full">
                            @if (session('message'))
                                <x-alerts.success id="alert-authentication">
                                    {{ session('message') }}
                                </x-alerts.success>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <div class="w-full pb-5">
                                <a href="/authentication/create"
                                    class="ps-5 text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center inline-flex items-center">
                                    New Authentication
                                    <svg class="w-4 h-4 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-7 7V5" />
                                    </svg>
                                </a>
                            </div>
                            <div class="relative overflow-x-auto w-full">
                                <table id="authentications-table" class="bg-white w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4">Date Issued</th>
                                            <th class="px-6 py-4">COC No.</th>
                                            <th class="px-6 py-4">Policy Holder</th>
                                            <th class="px-6 py-4">Vehicle</th>
                                            <th class="px-6 py-4">Premium</th>
                                            <th class="px-6 py-4 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authentications as $authentication)
                                            <tr class="group cursor-pointer">
                                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                                    {{ $authentication->date_issued }}
                                                </td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                                    {{ $authentication->coc_no }}
                                                </td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                                    {{ $authentication->first_name }}
                                                    {{ $authentication->last_name }}
                                                </td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                                    {{ $authentication->make }}
                                                    {{ $authentication->model }}
                                                    ({{ strtoupper($authentication->color) }})
                                                </td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6">
                                                    {{ number_format($authentication->premium, 2) }}
                                                </td>

                                                <td class="group-hover:bg-violet-200 px-8 py-6 text-center">
                                                    <a href="/authentication/{{ $authentication->id }}/print" target="_blank" title="Print"
                                                        class="text-xl mx-auto border border-violet-600 hover:bg-violet-600 text-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded p-2 px-3 text-center inline-flex items-center">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </a>
                                                    <a href="/authentication/policy/{{ $authentication->id }}" target="_blank" title="Print"
                                                        class="text-xl mx-auto border border-violet-600 hover:bg-violet-600 text-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded p-2 px-3 text-center inline-flex items-center">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            (function() {
                setTimeout(() => {
                    if (document.getElementById("authentications-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#authentications-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 50,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot:scripts>
</x-layout>
