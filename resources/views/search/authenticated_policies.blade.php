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
            <x-sidebar active="Search" activeSub="Authenticated Policies" :$count />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/search',
                                'title' => 'Search',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Authenticated Policies',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="flex flex-col">
                            <div class="w-full pb-5">
                                <h2 class="text-2xl">Search results for: <i>{{ request('query') }}</i></h2>
                            </div>
                            <div class="w-full">
                                <h2 class="text-2xl text-center">Authenticated Policies</h2>
                            </div>
                            <div class="w-full pb-5">
                                <div class="relative overflow-x-auto w-full">
                                    <table id="insured-vehicles-table"
                                        class="bg-white w-full text-sm text-left rtl:text-right">
                                        <thead class="text-xs uppercase bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-4">Policy/COC</th>
                                                <th class="px-6 py-4">OR/Policy Type</th>
                                            <th class="px-6 py-4">Period of Insurance</th>
                                                <th class="px-6 py-4 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($authenticated_policies as $authenticated_policy)
                                                <tr class="group cursor-pointer">
                                                    <td class="group-hover:bg-violet-200 px-8 py-6 w-[220px]">
                                                        <b class="inline-block w-[60px] text-end">COC # :</b> {{ $authenticated_policy->coc_no ?? '--' }} <br>
                                                        <b class="inline-block w-[60px] text-end">Policy # :</b> {{ $authenticated_policy->policy_no ?? '--' }} <br>
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        <b>OR # :</b> {{ $authenticated_policy->or_no ?? '--' }} <br>
                                                        <b>Type :</b> {{ $authenticated_policy->type }}
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6 w-[180px]">
                                                        <b class="inline-block w-[60px] text-end">Issued :</b> {{ $authenticated_policy->date_issued ?? '--' }} <br>
                                                        <b class="inline-block w-[60px] text-end">Validity :</b> {{ $authenticated_policy->validity ?? '--' }}
                                                        @if($authenticated_policy->validity > 1)
                                                            <span>Years</span>
                                                        @else
                                                            <span>Year</span>
                                                        @endif
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        <a href="/authentication/policy/{{ $authenticated_policy->id }}" class="text-xl mx-auto border border-violet-600 hover:bg-violet-600 text-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded p-2 px-3 text-center inline-flex items-center">
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
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            window.onload = function() {
                new DataTable("#insured-vehicles-table", {
                    fixedHeight: true,
                    searchable: true,
                    perPage: 50,
                });
            };
        </script>
    </x-slot:scripts>
</x-layout>
