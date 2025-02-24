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
            <x-sidebar />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    <x-breadcrumb />
                    <div class="flex gap-5 my-5">
                        <div class="w-full">
                            <div class="flex gap-4">
                                <section class="border rounded p-5 w-1/2">
                                    <h3 class="text-xl">Total Policies</h3>
                                    <h1 class="text-3xl text-center font-extrabold">{{ $total_uploads }}</h1>
                                </section>
                                <section class="border rounded p-5 w-1/2">
                                    <h3 class="text-xl">Transactions Today</h3>
                                    <h1 class="text-3xl text-center font-extrabold">{{ $todays_uploads }}</h1>
                                </section>
                            </div>
                            <br>
                            <div id="barchart-per-company" class="cursor-pointer"
                                onclick="window.location.href='/dashboard/report/upload_count_per_company';"
                                style="height: 250px; with: 100%;">
                            </div>
                        </div>
                        <div class="w-full">
                            <section class="p-5 border rounded">
                                <h3 id="todays_date" class="text-xl">Date: {{ date('l') }}</h3>
                                <h1 class="text-center text-3xl font-extrabold">{{ date('F d, Y') }}</h1>
                            </section>
                            <br>
                            <div id="linechart" class="cursor-pointer"
                                onclick="window.location.href='/dashboard/report/upload_count_per_month';"
                                style="height: 250px; with: 100%;">
                            </div>
                        </div>
                    </div>
                    <div id="barchart-per-province" class="cursor-pointer"
                        onclick="window.location.href='/dashboard/report/upload_count_per_province';"
                        style="height: 250px; with: 100%;">
                    </div>
                    <br>
                    <div class="flex gap-5">
                        <div class="w-1/2">
                            <h3 id="announcement" class="pt-1 text-2xl font-bold mb-2">Announcements</h3>
                            <div class="h-[500px] overflow-hidden hover:overflow-y-scroll">
                                @forelse ($announcements as $announcement)
                                    <div id="alert-announcement-content-{{ $announcement->id }}" {{-- text-gray-800 text-red-800 text-yellow-800 text-green-800 text-blue-800 text-indigo-800 text-purple-800 text-pink-800 --}}
                                        {{-- border-gray-300 border-red-300 border-yellow-300 border-green-300 border-blue-300 border-indigo-300 border-purple-300 border-pink-300 --}}
                                        class="p-4 mb-4 text-{{ $announcement->color }}-800 border border-{{ $announcement->color }}-300 rounded-lg bg-white"
                                        role="alert">
                                        <div class="flex flex-col">
                                            <h3 class="text-2xl font-semibold">{{ $announcement->title }}</h3>
                                            <p class="text-xs">
                                                {{ date('M d, Y h:i:a', strtotime($announcement->created_at)) }}</p>
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
                        </div>
                        <div class="w-1/2">
                            <h3 id="recent" class="pt-1 text-2xl font-bold mb-2">Top 15 Companies</h3>
                            <div class="relative overflow-x-scroll border rounded-lg">
                                <table class="w-full text-sm text-left rtl:te rounded-lgxt-right">
                                    <thead
                                        class="text-xs uppercase bg-gray-100">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 rounded-s-lg">
                                                Rank
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Company Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 font-bold rounded-e-lg">
                                                Policies
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($top_companies as $company)
                                            <tr class="even:bg-gray-100">
                                                <td class="text-nowrap text-center px-6 py-1 font-bold">
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="text-nowrap text-ellipsis uppercase overflow-hidden px-6 py-1 whitespace-nowrap">
                                                    {{ $company->name }}
                                                </td>
                                                <td class="text-nowrap text-center px-6 py-1 font-bold">
                                                    {{ $company->count }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="flex flex-col">
                        <h3 id="recent" class="pt-1 text-2xl font-bold mb-2 text-center">Recent Transactions</h3>
                        <table class="w-full text-sm text-left rtl:text-right">
                            <thead
                                class="text-xs uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                                        Date Issued
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        COC Number
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-s-lg">
                                        Agent
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Vehicle
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-e-lg">
                                        Company
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_uploads as $upload)
                                    <tr>
                                        <td class="text-nowrap text-ellipsis overflow-hidden px-6 py-1">
                                            {{ $upload->date_issued }}
                                        </td>
                                        <td class="text-nowrap font-bold text-ellipsis overflow-hidden px-6 py-1">
                                            <a class="text-violet-800 hover:text-violet-700 hover:underline"
                                                href="/authentication/policy/{{ $upload->id }}">
                                                {{ $upload->coc_no }}
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-ellipsis overflow-hidden px-6 py-1 whitespace-nowrap">
                                            {{ substr($upload->first_name, 0, 1) }}. {{ $upload->last_name }}
                                        </td>
                                        <td class="text-nowrap text-ellipsis overflow-hidden px-6 py-1">
                                            {{ $upload->make }}
                                            {{ $upload->model }}
                                        </td>
                                        <td class="text-nowrap text-ellipsis overflow-hidden px-6 py-1">
                                            {{ $upload->code }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            const uploads_per_company  = {!! json_encode($uploads_per_company) !!};
            const dataPointsPerCompany = uploads_per_company.map(upload => ({
                label: upload.code,
                y: upload.count
            }));
            const uploads_per_month  = {!! json_encode($uploads_per_month) !!};
            const dataPointsPerMonth = uploads_per_month.map(upload => ({
                label: `${upload.year}-${upload.month.substring(0,3)}`,
                y: upload.count
            }));
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

                var barchartPerCompany = new CanvasJS.Chart("barchart-per-company", {
                    animationEnabled: true,
                    colorSet: 'bootstrap5',
                    title: {
                        text: "Policy Count per Company"
                    },
                    axisY: {
                        title: "Policy Count"
                    },
                    data: [{
                        type: "column",
                        showInLegend: true,
                        legendMarkerColor: "grey",
                        legendText: "Insurance Companies",
                        dataPoints: dataPointsPerCompany,
                    }]
                });
                barchartPerCompany.render();

                var linechart = new CanvasJS.Chart("linechart", {
                    title: {
                        text: `Policy Count last 12 Months`
                    },
                    data: [{
                        type: "line",
                        dataPoints: dataPointsPerMonth,
                    }]
                });
                linechart.render();

                var barchartPerProvince = new CanvasJS.Chart("barchart-per-province", {
                    animationEnabled: true,
                    colorSet: 'bootstrap5',
                    title: {
                        text: "Policy Count per Province"
                    },
                    axisY: {
                        title: "Policy Count"
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
