@props(['ticket','chats'=>[]])

<div style="height: calc(100vh - 160px); padding-top: 50px; {{ ($ticket->status!='CLOSED') ? 'padding-bottom: 70px;' : ''}}"
    class="relative mt-2 border rounded-lg w-full">
    <section
        class="absolute top-0 left-0 right-0 p-3 bg-white border-b rounded-t-lg font-bold h-[50px]">
        {{ $ticket->title }} &nbsp;
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

        <div class="absolute right-0 top-0 w-32 h-12 flex items-center justify-center">
            @if ($ticket->status != 'CLOSED')
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-status"
                    class="text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                    type="button">
                    Status
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown-status"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownDefaultButton">
                        @if (in_array(Auth::user()->role, ['AGENT', 'SUBAGENT']))
                            <li>
                                <span onclick="setTicketStatus({{ $ticket->id }}, 'IN PROGRESS')"
                                    class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    In Progress
                                </span>
                            </li>
                            <li>
                                <span onclick="setTicketStatus({{ $ticket->id }}, 'RESOLVED')"
                                    class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Resolved
                                </span>
                            </li>
                        @endif
                        @if (in_array(Auth::user()->role, ['ADMIN']))
                            <li>
                                <span onclick="setTicketStatus({{ $ticket->id }}, 'CLOSED')"
                                    class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Closed
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </section>
    <div class="w-full h-full bg-gray-100 overflow-y-scroll flex flex-col-reverse">
        @php
            $background_colors = [
                'bg-red-500',
                'bg-blue-500',
                'bg-green-500',
                'bg-yellow-500',
                'bg-orange-500',
                'bg-pink-500',
            ];
            $colors = [];

            $user_ids = collect($chats)
                ->map(function ($chat) {
                    return $chat->user_id;
                })
                ->unique()
                ->values();

            $index = 0;

            foreach ($user_ids as $id) {
                $colors[$id] = $background_colors[$index];
                $index++;
            }
        @endphp
        @foreach ($chats as $chat)
            @if ($chat->user_id == Auth::user()->id)
                <section class="w-full p-1 flex flex-row-reverse">
                    <div class="bg-violet-500 mx-2 p-3 rounded-xl text-white max-w-[80%]">
                        {{ $chat->message }}
                    </div>
                </section>
            @else
                <section class="w-full p-1">
                    <div class="max-w-[80%] flex flex-row">
                        <div class="!min-w-[56px] px-2 flex flex-col-reverse">
                            <div title="{{ $chat->first_name }} {{ $chat->last_name }}"
                                style="width: 40px; height: 40px;"
                                class="{{ $colors[$chat->user_id] }} flex items-center justify-center mx-auto rounded-full">
                                <span
                                    class="block uppercase text-white">{{ $chat->first_name[0] }}{{ $chat->last_name[0] }}</span>
                            </div>
                        </div>
                        <div class="block">
                            <p class="ms-2 text-xs text-gray-400 capitalize">
                                {{ strtolower($chat->first_name) }}
                                {{ strtolower($chat->last_name) }}
                            </p>
                            <div class="bg-white p-3 rounded-xl">
                                {{ $chat->message }}
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    </div>
    @if($ticket->status !='CLOSED')
        <section
            class="absolute bottom-0 left-0 right-0 p-3 bg-white text-white rounded-b-lg border-t h-[70px]">
                <x-chat.form :$ticket />
        </section>
    @endif
</div>
