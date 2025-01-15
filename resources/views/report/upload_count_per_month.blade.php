<x-layout>
    <x-slot:title>Upload Count per Month</x-slot:title>
    <x-slot:head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
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
            <x-sidebar activeSub="Charts & Reports" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/dashboard/report',
                                'title' => 'Charts & Reports',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Upload Count per Month',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />
                    <div class="flex flex-col my-5">
                        <div id="linechart" style="height: 300px; with: 100%;"></div>
                        <hr class="my-5">
                        <div class="pb-5">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Month Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Upload Count
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_uploads = 0;
                                        @endphp
                                        @foreach($uploads_per_month as $upload)
                                            @php $total_uploads += $upload->count; @endphp
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="px-6 py-4">{{ $upload->year }} - {{ substr($upload->month, 0, 3) }}</td>
                                                <td class="px-6 py-4 text-center">{{ $upload->count }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-4 font-bold text-2xl">Total</td>
                                            <td class="px-6 py-4 text-center font-bold text-2xl">{{ $total_uploads }}</td>
                                        </tr>
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
            const uploads_per_month  = {!! json_encode($uploads_per_month) !!};
            const dataPointsPerMonth = uploads_per_month.map(upload => ({
                label: `${upload.year}-${upload.month.substring(0,3)}`,
                y: upload.count
            }));
            window.onload = function() {
                CanvasJS.addColorSet("bootstrap5",
                    [
                        '#0d6efd',
                        '#198754',
                        '#dc3545',
                        '#ffc107',
                        '#0dcaf0',
                    ]);

                    var linechart = new CanvasJS.Chart("linechart", {
                    title: {
                        text: `Upload Count last 12 Months`
                    },
                    data: [{
                        type: "line",
                        dataPoints: dataPointsPerMonth,
                    }]
                });
                linechart.render();
            }
        </script>
    </x-slot:scripts>
</x-layout>
