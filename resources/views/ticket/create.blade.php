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
        <main class="flex mx-auto max-w-screen-2xl">
            <x-sidebar active="Chat Support" activeSub="Tickets" />
            <div class="w-full h-screen pt-2 overflow-hidden overflow-y-scroll" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/ticket',
                                'title' => 'Chat Support',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Create Ticket',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />
                    <div class="flex  space-x-4 min-h-screen pt-2">
                        <div class="w-3/5 pt-2 pb-6">
                            <div class="max-w-xl">
                                @if(session('message'))
                                    <x-alerts.success id="alert-tickets">
                                        {{ session('message') }}
                                    </x-alerts.success>
                                @endif
                            </div>
                            @php
                                $coc_number = request('coc_no') ?? '';

                                if(old('coc_no')) {
                                    $coc_number = old('coc_no');
                                }
                            @endphp
                            <x-card class="max-w-xl">
                                <x-card-header>Create a Ticket</x-card-header>
                                <x-forms.form method="POST" action="/ticket">
                                    <x-forms.input-field class="w-full"
                                        name="coc_no"
                                        label="COC Number"
                                        list="coc_numbers"
                                        placeholder="--"
                                        required
                                    />
                                    <datalist id="coc_numbers">
                                        @foreach ($policy_details as $policy_detail)
                                            <option value="{{ $policy_detail->coc_no }}">
                                        @endforeach
                                    </datalist>

                                    <x-forms.input-field class="w-full"
                                        name="title"
                                        type="text"
                                        label="Title"
                                        placeholder="--"
                                        required
                                    />

                                    <x-forms.textarea-field
                                        name="description"
                                        label="Description"
                                        placeholder="--"
                                        rows="5"
                                    />

                                    <hr class="my-1">
                                    <div class="flex justify-end space-x-2">
                                        <span class="inline-block w-32">
                                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                                        </span>
                                        <a href="/u/chat_support"
                                            class="flex items-center justify-center w-auto px-10 text-center bg-white border border-gray-500 rounded-lg hover:bg-gray-500 hover:text-white">
                                            Back
                                        </a>
                                    </div>
                                </x-forms.form>
                            </x-card>
                        </div>
                        <div class="w-2/5 pt-2 pb-6">
                            <section class="p-8 text-white rounded-lg bg-violet-500">
                                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES:</h2>
                                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                                    <li>
                                        Kindly fill-out all of the required fields.
                                    </li>
                                </ul>
                            </section>
                        </div>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>


        </script>
    </x-slot:scripts>
</x-layout>
