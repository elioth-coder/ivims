<x-layout>
    <x-slot:title>Licenses - Companies</x-slot:title>
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
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar active="Licenses" activeSub="Companies" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/license',
                                'title' => 'Licenses',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Companies',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="mx-auto max-w-full">
                            @if (session('message'))
                                <x-alerts.success id="alert-company">
                                    {{ session('message') }}
                                </x-alerts.success>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <div class="w-full pb-5 flex gap-3 items-center justify-start">
                                <a href="/company/create"
                                    class="min-w-fit ps-5 text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center inline-flex items-center">
                                    New Company
                                    <svg class="w-4 h-4 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-7 7V5" />
                                    </svg>
                                </a>
                                <h3 class="block bg-violet-600 text-center w-full text-3xl font-bold p-2 text-white">Companies with License</h3>
                            </div>
                            <div class="relative overflow-x-auto w-full">
                                <table id="companies-table" class="bg-white w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4">Name</th>
                                            <th class="px-6 py-4">Valid Until</th>
                                            <th class="px-6 py-4">Status</th>
                                            <th class="px-6 py-4 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr class="group cursor-pointer">
                                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $company->name }}</td>
                                                <td class="min-w-[120px] group-hover:bg-violet-200 px-8 py-6">{{ $company->expiry_date ?? '--' }}</td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6 font-bold">
                                                    @php
                                                        $today  = strtotime(date('Y-m-d'));
                                                        $expiry = strtotime($company->expiry_date);

                                                        $expired = ($today >= $expiry);
                                                    @endphp

                                                    @if($expired)
                                                        @if($company->status=='revoked')
                                                            <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-yellow-600">REVOKED</span>
                                                        @else
                                                            <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-red-600">EXPIRED</span>
                                                        @endif
                                                    @else
                                                        <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-green-600">ACTIVE</span>
                                                    @endif
                                                </td>
                                                <td class="min-w-[150px] group-hover:bg-violet-200 px-8 py-6">
                                                    @if($expired)
                                                        <a href="/license/company/{{ $company->id }}/renew" title="Renew License"
                                                            class="text-green-600 mx-auto border border-green-600 hover:bg-green-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                            <i class="bi bi-arrow-clockwise w-5 h-5 inline-block"></i>
                                                        </a>
                                                    @else
                                                        <a href="/license/company/{{ $company->id }}/revoke" title="Revoke License"
                                                            class="text-yellow-600 mx-auto border border-yellow-600 hover:bg-yellow-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                            <i class="bi bi-x-circle w-5 h-5 inline-block"></i>
                                                        </a>
                                                    @endif
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
                    if (document.getElementById("companies-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#companies-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 5,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot:scripts>
</x-layout>
