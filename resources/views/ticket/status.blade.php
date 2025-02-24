<x-layout>
    <x-slot:title>Chat Support - Tickets</x-slot:title>
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
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
            <x-sidebar active="Chat Support" activeSub="{{ $status }}" :$count />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Chat Support',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="mx-auto max-w-full">
                            @if (session('message'))
                                <x-alerts.success id="alert-user">
                                    {{ session('message') }}
                                </x-alerts.success>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <div class="flex items-end">
                                <div class="w-full">
                                    <x-forms.form method="GET" action="/ticket" verb="GET">
                                        <div class="flex items-end">
                                            <x-forms.select-field class="w-1/2"
                                                name="category_id"
                                                label=""
                                                placeholder="SHOW ALL TICKETS">
                                                @foreach($ticket_categories as $ticket_category)
                                                    <option {{ (request('category_id')==$ticket_category->id) ? 'selected' : '' }}
                                                        value="{{ $ticket_category->id }}">
                                                        {{ strtoupper($ticket_category->name) }}
                                                    </option>
                                                @endforeach
                                            </x-forms.select-field>
                                            <span class="inline-block w-32 mx-2 mb-[2px]">
                                                <x-forms.button type="submit" color="violet">Filter</x-forms.button>
                                            </span>
                                        </div>
                                    </x-forms.form>
                                </div>
                                <div class="w-[180px] text-end">
                                    <a href="/ticket/create"
                                        class="ps-5 text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center inline-flex items-end">
                                        New Ticket
                                        <svg class="w-4 h-4 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 12h14m-7 7V5" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <hr class="my-5">


                            <div class="relative overflow-x-auto w-full">
                                <table id="tickets-table" class="bg-white w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4">Category</th>
                                            <th class="px-6 py-4">Reported Issue</th>
                                            <th class="px-6 py-4 text-center">Status</th>
                                            <th class="px-6 py-4 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            <tr class="cursor-pointer align-top">
                                                <td class="px-6 py-4 border-b">{{ $ticket->category->name ?? '--' }}</td>
                                                <td class="px-6 py-4 border-b">{{ $ticket->title }}</td>
                                                <td class="px-6 py-4 border-b">
                                                    @php
                                                        $color = '';
                                                        if ($ticket->status == 'CREATED') {
                                                            $color = 'bg-blue-600';
                                                        }
                                                        if ($ticket->status == 'OPEN') {
                                                            $color = 'bg-orange-600';
                                                        }
                                                        if ($ticket->status == 'IN PROGRESS') {
                                                            $color = 'bg-yellow-600';
                                                        }
                                                        if ($ticket->status == 'RESOLVED') {
                                                            $color = 'bg-green-600';
                                                        }
                                                        if ($ticket->status == 'CLOSED') {
                                                            $color = 'bg-violet-600';
                                                        }
                                                    @endphp
                                                    <span
                                                        class="text-xs text-white font-bold inline-block px-2 py-1 rounded-lg {{ $color }}">
                                                        {{ $ticket->status }}
                                                    </span>
                                                </td>
                                                <td class="px-6 border-b text-center" style="min-width: 160px;">
                                                    @if ($ticket->status == 'CREATED')
                                                        <x-forms.form class="hidden" method="POST" verb="DELETE"
                                                            action="/ticket/{{ $ticket->id }}"
                                                            id="delete-ticket-{{ $ticket->id }}-form">
                                                            <button type="submit">
                                                                Delete
                                                            </button>
                                                        </x-forms.form>
                                                    @endif

                                                    <a href="/ticket/{{ $ticket->id }}"
                                                        title="View" type="button"
                                                        class="focus:outline-none text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-4 py-2.5 m-1">
                                                        <i class="bi bi-eye"></i>
                                                    </a>

                                                    @if ($ticket->status == 'CREATED')
                                                        <button title="Delete" type="button"
                                                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 m-1"
                                                            onclick="confirmDelete('{{ $ticket->id }}');">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button title="Delete" type="button" disabled
                                                            class="focus:outline-none text-white bg-red-300 cursor-not-allowed focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 m-1">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
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
            window.onload = function() {
                new DataTable("#tickets-table", {
                    fixedHeight: true,
                    searchable: true,
                    perPage: 5,
                });
            };

            const confirmDelete = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this ticket?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if (result.isConfirmed) {
                    document.querySelector(`#delete-ticket-${id}-form button`).click();
                }
            }
        </script>
    </x-slot:scripts>
</x-layout>
