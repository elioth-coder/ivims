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
        <main class="mx-auto flex">
            <x-sidebar />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    <x-breadcrumb />
                    <div class="w-1/2">
                        <div id="barchart" style="height: 250px; with: 100%;"></div>
                    </div>
                    <div class="flex flex-column my-5 space-x-5">
                        <div class="w-full">
                            <h3 id="announcement" class="pt-1 text-xl mb-2">Announcements</h3>
                            @forelse ($announcements as $announcement)
                                <div id="alert-announcement-content-{{ $announcement->id }}" {{-- text-gray-800 text-red-800 text-yellow-800 text-green-800 text-blue-800 text-indigo-800 text-purple-800 text-pink-800 --}}
                                    {{-- border-gray-300 border-red-300 border-yellow-300 border-green-300 border-blue-300 border-indigo-300 border-purple-300 border-pink-300 --}}
                                    class="p-4 mb-4 text-{{ $announcement->color }}-800 border border-{{ $announcement->color }}-300 rounded-lg bg-white"
                                    role="alert">
                                    <div class="flex flex-col">
                                        <h3 class="text-2xl font-semibold">{{ $announcement->title }}</h3>
                                        <p class="text-xs">{{ date('M d, Y h:i:a', strtotime($announcement->created_at)) }}</p>
                                    </div>
                                    {{-- bg-gray-200 bg-red-200 bg-yellow-200 bg-green-200 bg-blue-200 bg-indigo-200 bg-purple-200 bg-pink-200 --}}
                                    <hr class="h-px my-2 bg-{{ $announcement->color }}-200 border-0">
                                    <div class="mt-2 mb-4 text-sm text-justify text-black">
                                        {{ $announcement->content }}
                                    </div>
                                </div>
                            @empty
                                <h1 class="text-center my-5 text-3xl">No announcements so far.</h1>
                            @endforelse
                        </div>
                        <div class="min-w-[350px]">
                            <h3 id="recent" class="pt-1 text-xl mb-2">Recent Uploads</h3>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 rounded-s-lg">
                                                Policy Holder
                                            </th>
                                            <th scope="col" class="px-6 py-3 rounded-e-lg">
                                                Vehicle Details
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recent_uploads as $upload)
                                            <tr>
                                                <th scope="row"
                                                    class="text-nowrap text-ellipsis overflow-hidden px-6 py-1 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $upload->first_name }} {{ $upload->last_name }}
                                                </th>
                                                <td class="text-nowrap text-ellipsis overflow-hidden px-6 py-1">{{ $upload->make }} {{ $upload->model }}</td>
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
            const uploads = {!! json_encode($uploads) !!};
            const dataPoints = uploads.map(upload => ({ label: upload.code, y: upload.count }));
            window.onload = function() {
                CanvasJS.addColorSet("bootstrap5",
                    [
                        '#0d6efd',
                        '#198754',
                        '#dc3545',
                        '#ffc107',
                        '#0dcaf0',
                        '#cfe2ff',
                        '#d1e7dd',
                        '#f8d7da',
                        '#fff3cd',
                        '#cff4fc',
                    ]);

                var barchart = new CanvasJS.Chart("barchart", {
                    animationEnabled: true,
                    colorSet: 'bootstrap5',
                    title: {
                        text: "Upload Count per Company"
                    },
                    axisY: {
                        title: "Upload Count"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "Insurance Companies",
                        dataPoints: dataPoints,
                    }]
                });
                barchart.render();
            }

        </script>
    </x-slot:scripts>
</x-layout>
