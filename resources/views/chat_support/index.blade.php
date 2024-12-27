<x-layout>
    <x-slot:title>Chat Support</x-slot:title>
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
            <div class="w-full min-h-screen">
                <div class="grid grid-cols-4 gap-4">
                    <div class="py-4">
                        <x-policy_holder.sidebar active="Chat Support" />
                    </div>
                    <div class="col-span-3 py-4">
                        @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Chat Support',
                            ],
                        ];
                        @endphp
                        <x-policy_holder.breadcrumb :$breadcrumbs />
                        <div class="w-full py-5">
                            <a href="/u/chat_support/create"
                                class="ps-5 text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center inline-flex items-center">
                                New Ticket
                                <svg class="w-4 h-4 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h14m-7 7V5" />
                                </svg>
                            </a>
                        </div>
                        <div class="mx-auto max-w-full">
                            @if (session('message'))
                                <x-alerts.success id="alert-ticket">
                                    {{ session('message') }}
                                </x-alerts.success>
                            @endif
                        </div>
                        <table id="tickets-table" class="bg-white w-full text-sm text-left rtl:text-right">
                            <thead class="text-xs uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4">COC Number</th>
                                    <th class="px-6 py-4">Title</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr class="cursor-pointer align-top">
                                        <td class="px-6 py-4 border-b">{{ $ticket->coc_no }}</td>
                                        <td class="px-6 py-4 border-b">{{ $ticket->title }}</td>
                                        <td class="px-6 py-4 border-b">
                                            @php
                                                $color = '';
                                                if($ticket->status=='CREATED')     $color = 'bg-blue-600';
                                                if($ticket->status=='OPEN')        $color = 'bg-orange-600';
                                                if($ticket->status=='IN PROGRESS') $color = 'bg-yellow-600';
                                                if($ticket->status=='RESOLVED')    $color = 'bg-green-600';
                                                if($ticket->status=='CLOSED')      $color = 'bg-violet-600';
                                            @endphp
                                            <span class="text-xs text-white font-bold inline-block px-2 py-1 rounded-lg {{ $color }}">
                                                {{ $ticket->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 border-b text-center" style="min-width: 160px;">
                                            @if($ticket->status == 'CREATED')
                                                <x-forms.form class="hidden" method="POST" verb="DELETE"
                                                    action="/u/chat_support/{{ $ticket->id }}"
                                                    id="delete-ticket-{{ $ticket->id }}-form">
                                                    <button type="submit">
                                                        Delete
                                                    </button>
                                                </x-forms.form>
                                            @endif

                                            <a href="/u/chat_support/ticket/{{ $ticket->id }}" title="View" type="button"
                                                class="focus:outline-none text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-4 py-2.5 m-1">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            @if($ticket->status == 'CREATED')
                                                <button title="Delete" type="button"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 m-1"
                                                    onclick="confirmDelete('{{ $ticket->id }}');">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @else
                                                <button title="Delete" type="button"
                                                    disabled
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
