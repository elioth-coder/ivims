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
            <x-sidebar active="Search" activeSub="Policy Holders" :$count />
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
                                'title' => 'Policy Holders',
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
                                <h2 class="text-2xl text-center">Policy Holders</h2>
                            </div>
                            <div class="w-full pb-5">
                                <div class="relative overflow-x-auto w-full">
                                    <table id="policy-holders-table"
                                        class="bg-white w-full text-sm text-left rtl:text-right">
                                        <thead class="text-xs uppercase bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-4">Personal ID</th>
                                                <th class="px-6 py-4">Full Name</th>
                                                <th class="px-6 py-4">Age</th>
                                                <th class="px-6 py-4">Gender</th>
                                                <th class="px-6 py-4">Address</th>
                                                <th class="px-6 py-4 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($policy_holders as $policy_holder)
                                                <tr class="group cursor-pointer">
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        <b class="inline-block w-[80px] text-end">Number :</b> {{ $policy_holder->id_number }} <br>
                                                        <b class="inline-block w-[80px] text-end">ID Type :</b> <span class="uppercase">{{ $policy_holder->id_type }}</span>
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        {{ $policy_holder->first_name }} {{ $policy_holder->last_name }}
                                                        {{ $policy_holder->suffix }}
                                                    </td>
                                                    @php
                                                        $birthDate = new DateTime($policy_holder->birthday);
                                                        $currentDate = new DateTime();
                                                        $difference = $currentDate->diff($birthDate);
                                                        $age = $difference->y;
                                                    @endphp
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        {{ $age }}</td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        {{ strtoupper($policy_holder->gender) }}</td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        {{ $policy_holder->address }}</td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        <a href="/authentication/policy_holder/{{ $policy_holder->id }}" class="text-xl mx-auto border border-violet-600 hover:bg-violet-600 text-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded p-2 px-3 text-center inline-flex items-center">
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
                new DataTable("#policy-holders-table", {
                    fixedHeight: true,
                    searchable: true,
                    perPage: 50,
                });
            };
        </script>
    </x-slot:scripts>
</x-layout>
