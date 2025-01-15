<x-layout>
    <x-slot:title>Customer - Reported Tickets</x-slot:title>
    <x-slot:head>

    </x-slot:head>
    <div class="relative w-full pb-[70px] overflow-y-scroll">
        <x-navbar-customer />
        <main class="w-full max-w-screen-lg mx-auto p-4 min-h-screen">
            <h1 class="text-2xl font-bold">Tickets</h1>
            <br>
            <img class="w-32 mx-auto sm:w-[300px] block rounded-full" src="{{ asset('images/ic-logo.png')}}"
                alt="Insurance Commission">
            <br>

            <div class="flex flex-col">


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs uppercase bg-gray-50">
                            <tr>
                                <th></th>
                                <th scope="col" class="p-4">
                                    Reported Issues
                                </th>
                                <th class="p-4">COC No.</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($tickets as $ticket)
                                @php
                                $color = '';
                                if ($ticket->status == 'CREATED') {
                                    $color = 'bg-violet-600';
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

                            <tr class="bg-white border-b">
                                <td>
                                    <a href="/customer/ticket_chat/{{ $ticket->id }}"
                                        class="px-3 py-2 text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm text-center inline-flex items-center">
                                        <i class="bi bi-list-ul"></i>
                                    </a>
                                </td>
                                <td scope="row" class="p-4 whitespace-nowrap">
                                    <b class="font-bold">[ Ticket No. {{ $ticket->id }} ]</b> |
                                    <span class="inline-block text-white w-fit rounded-lg px-2 py-1 {{ $color }}">{{
                                        $ticket->status }}</span>
                                    <br>
                                    <a href="/customer/ticket_chat/{{ $ticket->id }}"
                                        class="text-violet-800 hover:text-violet-600 underline">{{ $ticket->title }}</a>
                                </td>
                                <td class="p-4">{{ $ticket->coc_no }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <x-footer-customer />
    </div>
    <x-slot:scripts>
        <script></script>
    </x-slot:scripts>
</x-layout>
