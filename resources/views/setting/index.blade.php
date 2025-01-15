<x-layout>
    <x-slot:title>Settings</x-slot:title>
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
            <x-sidebar active="Settings" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Settings',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="flex flex-col">
                            <h2 class="text-center font-bold text-2xl">Settings</h2>
                            <br>
                            <div class="grid grid-cols-3 gap-4">
                                @php
                                    $settings = [
                                        [
                                            'title' => 'CTPL Rates',
                                            'link'  => '/setting/ctpl_rate',
                                            'icon'  => 'cash-coin',
                                        ],
                                        [
                                            'title' => 'Vehicle Types',
                                            'link'  => '/setting/vehicle_type',
                                            'icon'  => 'car-front',
                                        ],
                                        [
                                            'title' => 'Valid IDs',
                                            'link'  => '/setting/valid_id',
                                            'icon'  => 'person-vcard',
                                        ],
                                    ];
                                @endphp
                                @foreach($settings as $setting)
                                    <a href="{{ $setting['link'] }}" class="block border p-5 rounded text-center hover:bg-gray-100">
                                        <i class="text-7xl bi bi-{{ $setting['icon'] }} text-violet-700"></i>
                                        <hr class="my-3">
                                        <h3 class="text-lg">{{ $setting['title'] }}</h3>
                                    </a>
                                @endforeach
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

        </script>
    </x-slot:scripts>
</x-layout>
