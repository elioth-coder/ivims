<x-layout>
    <x-slot:title>Customer Support</x-slot:title>
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
                        <x-policy_holder.sidebar active="Customer Support" />
                    </div>
                    <div class="col-span-3 py-4">
                        @php
                            $breadcrumbs = [
                                [
                                    'url' => '/u/customer_support',
                                    'title' => 'Customer Support',
                                ],
                                [
                                    'url' => '#',
                                    'title' => 'Ticket #' . $ticket->id,
                                ],
                            ];
                        @endphp
                        <x-policy_holder.breadcrumb :$breadcrumbs />
                        <div style="height: calc(100vh - 160px); padding-top: 50px; padding-bottom: 70px;"
                            class="relative mt-2 border rounded-lg w-full">
                            <section class="absolute top-0 left-0 right-0 p-3 bg-white border-b rounded-t-lg font-bold h-[50px]">
                                {{ $ticket->title }}
                            </section>
                            <div class="w-full h-full bg-gray-100 overflow-y-scroll flex flex-col-reverse">
                                @foreach($chats as $chat)
                                    <section class="w-full p-1 flex flex-row-reverse">
                                        <div class="bg-violet-500 p-3 rounded-xl text-white max-w-[80%]">
                                            {{ $chat->message }}
                                        </div>
                                    </section>
                                @endforeach
                            </div>
                            <section
                                class="absolute bottom-0 left-0 right-0 p-3 bg-white text-white rounded-b-lg border-t h-[70px]">
                                <x-chat.form :$ticket />
                            </section>
                        </div>
                    </div>
                </div>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            window.onload = function() {
                let chatForm  = document.getElementById('chat-form');
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                chatForm.onsubmit = async (event) => {
                    event.preventDefault();
                    let form = event.target;
                    let formData = new FormData(form);

                    Swal.fire({
                        title: 'Sending...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });

                    let response = await fetch('/u/customer_support/chat/', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                    });
                    let { status, message } = await response.json();

                    Swal.fire({
                        title: message,
                        icon: status,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        timer: 3000,
                    });

                    if(status=='success') {
                        window.location.reload();
                    }

                    return false;
                }
            }
        </script>
    </x-slot:scripts>
</x-layout>
