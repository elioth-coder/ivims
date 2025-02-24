<x-layout>
    <x-slot:title>Licenses</x-slot:title>
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
            <x-sidebar active="Licenses" activeSub="Licenses" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Licenses',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="flex flex-col">
                            <h2 class="text-center font-bold text-2xl">Licenses</h2>
                            <br>
                            <div class="grid grid-cols-3 gap-4">
                                @php
                                    $items = [
                                        [
                                            'title' => 'Companies with License',
                                            'link'  => '/license/company',
                                            'icon'  => 'buildings',
                                        ],
                                        [
                                            'title' => 'Branches with License',
                                            'link'  => '/license/branch',
                                            'icon'  => 'building',
                                        ],
                                        [
                                            'title' => 'Agents with License',
                                            'link'  => '/license/agent',
                                            'icon'  => 'people',
                                        ],
                                    ];
                                @endphp
                                @foreach($items as $item)
                                    <a href="{{ $item['link'] }}" class="block border p-5 rounded text-center hover:bg-gray-100">
                                        <i class="text-7xl bi bi-{{ $item['icon'] }} text-violet-700"></i>
                                        <hr class="my-3">
                                        <h3 class="text-lg">{{ $item['title'] }}</h3>
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
