<x-layout>
    <x-slot:title>Insurance Policies</x-slot:title>
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
        <style>
            html,
            body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar-policy_holder />
    <div class="w-full pt-[70px]">
        <main class="max-w-screen-lg mx-auto flex">
            <div class="w-full overflow-y-scroll min-h-screen">
                <div class="grid grid-cols-4 gap-4">
                    <div class="py-4">
                        <x-policy_holder.sidebar active="CTPL Insurance" />
                    </div>
                    <div class="col-span-3 py-4">
                        @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'CTPL Insurance',
                            ],
                        ];
                        @endphp
                        <x-policy_holder.breadcrumb :$breadcrumbs />
                        <h2 class="text-2xl text-center my-4">My CTPL Insurance</h2>
                        <table id="authentications-table" class="bg-white w-full text-sm text-left rtl:text-right">
                            <thead class="text-xs uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4">Insurance Details</th>
                                    <th class="px-6 py-4">Validity Period</th>
                                    <th class="px-6 py-4">Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authentications as $authentication)
                                    <tr class="cursor-pointer align-top">
                                        <td class="px-6 py-4 border-b">
                                            <b class="inline-block w-16">COC NO.</b>: {{ $authentication->coc_no }} <br>
                                            <b class="inline-block w-16">VEHICLE</b>: {{ $authentication->vehicle }} <br>
                                            <b class="inline-block w-16">PREMIUM</b>: P {{ number_format($authentication->premium, 2) }}
                                        </td>
                                        <td class="px-6 py-4 border-b">
                                            {{ date('M. d, Y', strtotime($authentication->inception_date)) }} &rarr;
                                            {{ date('M. d, Y', strtotime($authentication->expiry_date)) }} <br>
                                            {{ $authentication->validity }} Years Validity<br>

                                            <a href="/u/customer_support/create?coc_no={{ $authentication->coc_no }}" class="mt-2 inline-block text-blue-700 hover:text-blue-500 hover:underline">Create a ticket</a>
                                        </td>
                                        <td class="px-6 py-4 border-b uppercase">
                                            {{ $authentication->agent_name }} <br>
                                            ({{ $authentication->company_code }})
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            window.onload = function() {
                new DataTable("#authentications-table", {
                    fixedHeight: true,
                    searchable: true,
                    perPage: 5,
                });
            };
        </script>
    </x-slot:scripts>
</x-layout>
