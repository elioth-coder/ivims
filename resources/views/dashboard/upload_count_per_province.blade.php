<x-layout>
    <x-slot:title>Dashboard</x-slot:title>
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
            <x-sidebar activeSub="Upload Count - Province" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Upload Count',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Province',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />
                    <div class="flex flex-col my-5">
                        <div id="barchart-per-province" style="height: 300px; with: 100%;"></div>
                        <hr class="my-5">
                        <div class="pb-5">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Province Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Upload Count
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($uploads_per_province as $upload)
                                            <tr class="bg-white border-b hover:bg-gray-50">
                                                <td class="px-6 py-4">{{ $upload->province }}</td>
                                                <td class="px-6 py-4 text-center">{{ $upload->count }}</td>
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
            const uploads_per_province  = {!! json_encode($uploads_per_province) !!};
            const dataPointsPerProvince = uploads_per_province.map(upload => ({
                label: upload.province,
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

                var barchartPerProvince = new CanvasJS.Chart("barchart-per-province", {
                    animationEnabled: true,
                    colorSet: 'bootstrap5',
                    title: {
                        text: "Upload Count per Province"
                    },
                    axisY: {
                        title: "Upload Count"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "Provinces",
                        dataPoints: dataPointsPerProvince,
                    }]
                });
                barchartPerProvince.render();
            }
        </script>
    </x-slot:scripts>
</x-layout>
