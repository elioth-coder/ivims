@php
use Illuminate\Support\Facades\Storage;

@endphp
@props(['ticket','created_by','chats'=>[]])

<div style="height: calc(100vh - 160px); {{ ($ticket->status!='CLOSED') ? 'padding-bottom: 70px;' : ''}}"
    class="relative mt-2 border rounded-lg w-full">
    <section class="hidden absolute top-0 left-0 right-0 p-3 bg-white border-b rounded-t-lg font-bold h-[80px]">
        <div class="font-normal items-center hidden">
            <img class="w-9 h-9 me-1 rounded-full hidden sm:inline-block" src="{{ asset('images/profile.png') }}" alt="user photo">
            {{ $created_by->name }}
            <span class="bg-slate-200 px-2 rounded-xl mx-3">
                <b class="font-bold">COC #:</b>
                <a class="text-violet-900 hover:text-violet-800 hover:underline"
                    href="/search/authenticated_policies?query={{ $ticket->coc_no }}">
                    {{ $ticket->coc_no }}
                </a>
            </span>
        </div>
        <div class="text-lg sm:flex items-center hidden">
            <h3 class="">{{ $ticket->title }}</h3> &nbsp;
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
        </div>

        <div class="border-l absolute right-0 top-0 w-32 h-full flex items-center justify-center">
            @if ($ticket->status != 'CLOSED' && Auth::user()->role != 'POLICY_HOLDER')
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
                @if($chat->file)
                    <section class="w-full p-1 flex flex-row-reverse">
                        <div class="text-violet-700 shadow bg-gray-200 mx-2 p-3 rounded-xl max-w-[80%] flex items-center gap-2">
                            <i class="bi bi-file-earmark text-2xl"></i>
                            <a class="sm:hidden hover:underline hover:text-violet-500" href="{{ Storage::url('uploads/' . $chat->file); }}">{{ $chat->file }}</a>
                            <a class="hidden sm:inline hover:underline hover:text-violet-500" href="{{ Storage::url('uploads/' . $chat->file); }}" target="_blank">{{ $chat->file }}</a>
                        </div>
                    </section>
                @endif
                <section class="w-full p-1 flex flex-row-reverse">
                    <div class="bg-violet-500 mx-2 p-3 shadow rounded-xl text-white max-w-[80%]">
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
                            <div class="bg-white p-3 rounded-xl shadow w-fit">
                                {{ $chat->message }}
                            </div>
                            @if($chat->file)
                                <div class="text-violet-700 shadow bg-gray-200 p-3 rounded-xl max-w-[80%] flex items-center gap-2">
                                    <i class="bi bi-file-earmark text-2xl"></i>
                                    <a class="sm:hidden hover:underline hover:text-violet-500" href="{{ Storage::url('uploads/' . $chat->file); }}">{{ $chat->file }}</a>
                                    <a class="hidden sm:inline hover:underline hover:text-violet-500" href="{{ Storage::url('uploads/' . $chat->file); }}" target="_blank">{{ $chat->file }}</a>
                                </div>
                            @endif
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
