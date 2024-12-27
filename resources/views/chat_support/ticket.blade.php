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
                                    'url' => '/u/chat_support',
                                    'title' => 'Chat Support',
                                ],
                                [
                                    'url' => '#',
                                    'title' => 'Ticket #' . $ticket->id,
                                ],
                            ];
                        @endphp
                        <x-policy_holder.breadcrumb :$breadcrumbs />
                        <x-chat.box :$ticket :$chats />
                    </div>
                </div>
                <x-copyright />
            </div>
        </main>
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

                        let response = await fetch('/u/chat_support/chat/', {
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
