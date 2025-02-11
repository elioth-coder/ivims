<x-layout>
    <x-slot:title>Licenses - Agents</x-slot:title>
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
            <x-sidebar active="Licenses" activeSub="* Agents" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/license',
                                'title' => 'Licenses',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Agents',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="mx-auto max-w-full">
                            @if (session('message'))
                                <x-alerts.success id="alert-agent">
                                    {{ session('message') }}
                                </x-alerts.success>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <div class="w-full pb-5 flex gap-3 items-center justify-start">
                                <a href="/agent/create"
                                    class="min-w-fit ps-5 text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center inline-flex items-center">
                                    New Agent
                                    <svg class="w-4 h-4 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-7 7V5" />
                                    </svg>
                                </a>
                                <h3 class="block bg-violet-600 text-center w-full text-3xl font-bold p-2 text-white">Agents with License</h3>
                            </div>
                            <div class="relative overflow-x-auto w-full">
                                <table id="agents-table" class="bg-white w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4">Agent</th>
                                            <th class="px-6 py-4">Branch</th>
                                            <th class="px-6 py-4">Company</th>
                                            <th class="px-6 py-4">Valid Until</th>
                                            <th class="px-6 py-4">License</th>
                                            <th class="px-6 py-4 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($agents as $agent)
                                            <tr class="group cursor-pointer">
                                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $agent->first_name }} {{ $agent->last_name }} {{ $agent->suffix }}</td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ ($agent->branch) ? $agent->branch->name : '--' }}</td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $agent->company->name }}</td>
                                                <td class="min-w-[120px] group-hover:bg-violet-200 px-8 py-6">{{ $agent->expiry_date ?? '--' }}</td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6 font-bold">
                                                    @php
                                                        $today  = strtotime(date('Y-m-d'));
                                                        $expiry = strtotime($agent->expiry_date);

                                                        $expired = ($today >= $expiry);
                                                    @endphp

                                                    @if($expired)
                                                        @if($agent->status=='revoked')
                                                            <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-yellow-600">REVOKED</span>
                                                        @else
                                                            <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-red-600">EXPIRED</span>
                                                        @endif
                                                    @else
                                                        <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-green-600">ACTIVE</span>
                                                    @endif
                                                </td>
                                                <td class="min-w-[150px] group-hover:bg-violet-200 px-8 py-6">
                                                    @if($expired)
                                                        <a href="/license/agent/{{ $agent->id }}/renew" title="Renew License"
                                                            class="text-green-600 mx-auto border border-green-600 hover:bg-green-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                            <i class="bi bi-plus-square w-5 h-5 inline-block"></i>
                                                        </a>
                                                        <button title="Revoke License"
                                                            type="button"
                                                            disabled
                                                            class="bg-gray-200 cursor-not-allowed text-gray-600 mx-auto border border-gray-600 hover:bg-gray-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                            <i class="bi bi-file-x w-5 h-5 inline-block"></i>
                                                        </button>
                                                    @else
                                                        <button title="Renew License"
                                                            type="button"
                                                            disabled
                                                            class="bg-gray-200 cursor-not-allowed text-gray-600 mx-auto border border-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                            <i class="bi bi-plus-square w-5 h-5 inline-block"></i>
                                                        </button>
                                                        <a href="/license/agent/{{ $agent->id }}/revoke" title="Revoke License"
                                                            class="text-yellow-600 mx-auto border border-yellow-600 hover:bg-yellow-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                            <i class="bi bi-file-x w-5 h-5 inline-block"></i>
                                                        </a>
                                                    @endif
                                                </td>
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
            const confirmDelete = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this agent?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if (result.isConfirmed) {
                    document.querySelector(`#delete-agent-${id}-form button`).click();
                }
            }

            (function() {
                setTimeout(() => {
                    if (document.getElementById("agents-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#agents-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 5,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot:scripts>
</x-layout>
