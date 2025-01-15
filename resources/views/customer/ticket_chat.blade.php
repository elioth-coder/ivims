<x-layout>
    <x-slot:title>Customer - Ticket Chats</x-slot:title>
    <x-slot:head>

    </x-slot:head>
    <div class="relative w-full pb-[70px] overflow-y-scroll">
        <x-navbar-customer />
        <main class="w-full max-w-screen-lg mx-auto p-4 min-h-screen">
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

            <h2>
                Ticket No. {{ $ticket->id }}
                <span class="mx-1 inline-block text-white w-fit rounded-lg px-2 py-1 {{ $color }}">
                    {{ $ticket->status }}
                </span>
            </h2>
            <h1 class="text-2xl font-bold">{{ $ticket->title }}</h1>
            <br>
            <div class="flex font-normal items-center text-nowrap">
                <img class="w-9 h-9 me-1 rounded-full sm:inline-block" src="{{ asset('images/profile.png') }}"
                    alt="user photo">
                {{ $created_by->name }}
                <span class="bg-slate-200 px-2 rounded-xl mx-3">
                    <b class="font-bold">COC #:</b>
                    <a class="text-violet-900 hover:text-violet-800 hover:underline"
                        href="/verify_qr/{{ $ticket->coc_no }}">
                        {{ $ticket->coc_no }}
                    </a>
                </span>
            </div>

            <br>
            <div class="flex flex-col">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-1">
                    <x-chat.box :$ticket :$created_by :$chats />
                </div>
            </div>
        </main>

        <x-footer-customer />
    </div>
    <x-slot:scripts>
        <script>
            window.onload = function() {
                let chatForm = document.getElementById('chat-form');
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (chatForm) {
                    chatForm.onsubmit = async (event) => {
                        event.preventDefault();
                        let form = event.target;
                        let formData = new FormData(form);

                        Swal.fire({
                            title: 'Sending...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });

                        let response = await fetch('/customer/store_chat', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                        });
                        let {
                            status,
                            message
                        } = await response.json();

                        Swal.fire({
                            title: message,
                            icon: status,
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 3000,
                        });

                        if (status == 'success') {
                            window.location.reload();
                        }

                        return false;
                    }

                }
            }
        </script>
    </x-slot:scripts>
</x-layout>
