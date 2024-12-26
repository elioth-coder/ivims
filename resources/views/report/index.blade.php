<x-layout>
    <x-slot:title>Charts & Reports</x-slot:title>
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
            <x-sidebar active="Dashboard" activeSub="Charts & Reports" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Charts & Reports',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="flex flex-col">
                            <h2 class="text-center font-bold text-2xl">Charts & Reports</h2>
                            <br>
                            <div class="grid grid-cols-3 gap-4">
                                @php
                                    $reports = [
                                        [
                                            'title' => 'Upload Count per Company',
                                            'link'  => '/dashboard/report/upload_count_per_company',
                                            'icon'  => 'bar-chart',
                                        ],
                                        [
                                            'title' => 'Upload Count per Month',
                                            'link'  => '/dashboard/report/upload_count_per_month',
                                            'icon'  => 'graph-up',
                                        ],
                                        [
                                            'title' => 'Upload Count per Province',
                                            'link'  => '/dashboard/report/upload_count_per_province',
                                            'icon'  => 'bar-chart',
                                        ],
                                    ];
                                @endphp
                                @foreach($reports as $report)
                                    <a href="{{ $report['link'] }}" class="block border p-5 rounded text-center hover:bg-gray-100">
                                        <i class="text-7xl bi bi-{{ $report['icon'] }} text-violet-700"></i>
                                        <hr class="my-3">
                                        <h3 class="text-lg">{{ $report['title'] }}</h3>
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
