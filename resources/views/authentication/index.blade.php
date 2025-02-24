<x-layout>
    <x-slot:title>Insurance Policy</x-slot:title>
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
        <style>
            html, body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="flex mx-auto max-w-screen-2xl">
            <x-sidebar active="Insurance Policies" activeSub="Insurance Policies" />
            <div class="w-full h-screen pt-2 overflow-hidden overflow-y-scroll" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Insurance Policies',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="min-h-screen py-3">
                        <div class="max-w-full mx-auto">
                            @if (session('message'))
                                <x-alerts.success id="alert-authentication">
                                    {{ session('message') }}
                                </x-alerts.success>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <div class="w-full pb-5">
                                <a href="/authentication/create"
                                    class="inline-flex items-center p-3 mx-auto text-sm font-medium text-center border rounded-lg ps-5 text-violet-600 border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300">
                                    New Authentication
                                    <svg class="w-4 h-4 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-7 7V5" />
                                    </svg>
                                </a>
                            </div>
                            <div class="relative w-full overflow-x-auto">
                                <table id="authentications-table" class="w-full text-sm text-left bg-white rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4">Date Issued</th>
                                            <th class="px-6 py-4">COC Number</th>
                                            <th class="px-6 py-4">Agent</th>
                                            <th class="px-6 py-4">Vehicle</th>
                                            <th class="px-6 py-4">Company</th>
                                            <th class="px-6 py-4 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($authentications as $authentication)
                                            <tr class="cursor-pointer group">
                                                <td class="px-8 py-6 group-hover:bg-violet-200">
                                                    {{ $authentication->date_issued }}
                                                </td>
                                                <td class="px-8 py-6 group-hover:bg-violet-200">
                                                    {{ $authentication->coc_no }}
                                                </td>
                                                <td class="px-8 py-6 uppercase group-hover:bg-violet-200">
                                                    {{ $authentication->first_name }}
                                                    {{ $authentication->last_name }}
                                                </td>
                                                <td class="px-8 py-6 group-hover:bg-violet-200">
                                                    {{ $authentication->make }}
                                                    {{ $authentication->model }}
                                                    ({{ strtoupper($authentication->color) }})
                                                </td>
                                                <td class="px-8 py-6 group-hover:bg-violet-200">
                                                    {{ $authentication->company_code }}
                                                </td>
                                                <td style="min-width: 200px;" class="px-8 py-6 group-hover:bg-violet-200">
                                                    <a href="/authentication/{{ $authentication->id }}/print" target="_blank" title="Print"
                                                        class="inline-flex items-center p-2 px-3 mx-auto text-xl font-medium text-center border rounded border-violet-600 hover:bg-violet-600 text-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300">
                                                        <i class="bi bi-printer-fill"></i>
                                                    </a>
                                                    <a href="/authentication/policy/{{ $authentication->id }}" target="_blank" title="Print"
                                                        class="inline-flex items-center p-2 px-3 mx-auto text-xl font-medium text-center border rounded border-violet-600 hover:bg-violet-600 text-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300">
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
            window.onload = function() {
                new DataTable("#authentications-table", {
                    fixedHeight: true,
                    searchable: true,
                    perPage: 5,
                });
            };
        </script>
    </x-slot:scripts>
</x-layout>
