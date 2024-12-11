<x-layout>
    <x-slot:title>Raw Data</x-slot:title>
    <x-slot:head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <x-sidebar active="Tools" activeSub="Raw Data" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/tools',
                                'title' => 'Tools',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Raw Data',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="flex space-x-3 min-h-screen">
                        <div class="pb-6 mt-2 w-full">
                            <x-card class="">
                                <x-card-header>Raw Data</x-card-header>
                                <form class="flex gap-2" action="/tools/raw_data" method="GET">
                                    @csrf
                                    @method('GET')
                                    <section class="w-2/5">
                                        <label for="data_limit"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                            data limit</label>
                                        @php
                                            $data_limits = [
                                                ['label' => 10, 'value' => 10],
                                                ['label' => 15, 'value' => 15],
                                                ['label' => 25, 'value' => 25],
                                                ['label' => 50, 'value' => 50],
                                            ];
                                        @endphp
                                        <select required id="data_limit" name="data_limit"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                                            <option value="">--</option>
                                            @foreach ($data_limits as $data_limit)
                                                <option
                                                    {{ request('data_limit') == $data_limit['value'] ? 'selected' : '' }}
                                                    value="{{ $data_limit['value'] }}">
                                                    {{ $data_limit['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </section>
                                    <section required class="w-2/5">
                                        <label for="data_target"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                            data target</label>
                                        @php
                                            $data_targets = [
                                                ['label' => 'Insurance Companies', 'value' => 'companies'],
                                                ['label' => 'Authenticated Policies', 'value' => 'policy_details'],
                                                ['label' => 'Policy Holders', 'value' => 'policy_holders'],
                                                ['label' => 'Vehicles', 'value' => 'vehicle_details'],
                                            ];
                                        @endphp
                                        <select id="data_target" name="data_target"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                                            <option value="">--</option>
                                            @foreach ($data_targets as $data_target)
                                                <option
                                                    {{ request('data_target') == $data_target['value'] ? 'selected' : '' }}
                                                    value="{{ $data_target['value'] }}">
                                                    {{ $data_target['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </section>
                                    <div class="flex w-1/5 items-center justify-center">
                                        <button type="submit"
                                            class="block mx-auto text-white bg-violet-700 hover:bg-violet-800 focus:outline-none focus:ring-4 focus:ring-violet-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2">
                                            <i class="bi bi-box-arrow-in-down text-lg -mb-1 me-1"></i>
                                            Show Data
                                        </button>
                                    </div>
                                </form>
                                <div class="block overflow-x-scroll w-full" id="table_container">
                                    @if (request('data_target') == 'companies')
                                        <x-raw_data.companies :$items />
                                    @endif
                                    @if (request('data_target') == 'vehicle_details')
                                        <x-raw_data.vehicle_details :$items />
                                    @endif
                                    @if (request('data_target') == 'policy_details')
                                        <x-raw_data.policy_details :$items />
                                    @endif
                                    @if (request('data_target') == 'policy_holders')
                                        <x-raw_data.policy_holders :$items />
                                    @endif
                                </div>
                            </x-card>
                        </div>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
</x-layout>
