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
            <x-sidebar active="Chat Support" activeSub="Tickets" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/ticket',
                                'title' => 'Chat Support',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Ticket #' . $ticket->id,
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />
                    <x-chat.box :$ticket :$chats />
                </section>
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            async function setTicketStatus(ticket_id, ticket_status) {
                Swal.fire({
                    title: 'Updating status...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });

                let formData = new FormData();
                formData.set('ticket_id', ticket_id);
                formData.set('ticket_status', ticket_status);

                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let response = await fetch('/ticket/status_update', {
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
            }

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

                        let response = await fetch('/ticket/chat/', {
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
