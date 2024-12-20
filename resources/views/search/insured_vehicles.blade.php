<x-layout>
    <x-slot:title>Search</x-slot:title>
    <x-slot:head>
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
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar active="Search" activeSub="Insured Vehicles" :$count />
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
                                'title' => 'Insured Vehicles',
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
                                <h2 class="text-2xl text-center">Insured Vehicles</h2>
                            </div>
                            <div class="w-full pb-5">
                                <div class="relative overflow-x-auto w-full">
                                    <table id="insured-vehicles-table"
                                        class="bg-white w-full text-sm text-left rtl:text-right">
                                        <thead class="text-xs uppercase bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-4">Plate No.</th>
                                                <th class="px-6 py-4">Vehicle Name</th>
                                                <th class="px-6 py-4">MV File No.</th>
                                                <th class="px-6 py-4">Engine/Serial</th>
                                                <th class="px-6 py-4 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($insured_vehicles as $insured_vehicle)
                                                <tr class="group cursor-pointer">
                                                    <td class="group-hover:bg-violet-200 px-8 py-6 uppercase">
                                                        {{ $insured_vehicle->plate_no }}
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        {{ $insured_vehicle->make }}
                                                        {{ $insured_vehicle->model }}
                                                        <span class="uppercase">
                                                            ({{ $insured_vehicle->color }})
                                                        </span>
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6 uppercase">
                                                        {{ $insured_vehicle->mv_file_no }}
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        <b class="inline-block w-[80px] text-end">Motor No. :</b> {{ $insured_vehicle->motor_no ?? '--' }} <br>
                                                        <b class="inline-block w-[80px] text-end">Serial No. :</b> {{ $insured_vehicle->serial_no ?? '--' }} <br>
                                                    </td>
                                                    <td class="group-hover:bg-violet-200 px-8 py-6">
                                                        <a href="/authentication/vehicle/{{ $insured_vehicle->id }}" class="text-xl mx-auto border border-violet-600 hover:bg-violet-600 text-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded p-2 px-3 text-center inline-flex items-center">
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
                    perPage: 5,
                });
            };
        </script>
    </x-slot:scripts>
</x-layout>
