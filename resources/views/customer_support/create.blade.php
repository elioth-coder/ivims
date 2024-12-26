<x-layout>
    <x-slot:title>Customer Support</x-slot:title>
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
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
                                'title' => 'Create Ticket',
                            ],
                        ];
                        @endphp
                        <x-policy_holder.breadcrumb :$breadcrumbs />
                        <div class="flex space-x-3 min-h-screen pt-2">
                            <div class="w-3/5 pb-6 pt-2">
                                <div class="max-w-xl">
                                    @if (session('message'))
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
                                    <x-forms.form method="POST" action="/u/customer_support">
                                        <x-forms.select-field class="w-full"
                                            name="coc_no"
                                            label="COC Number"
                                            placeholder="--"
                                            required>
                                            @foreach ($policy_details as $policy_detail)
                                                <option {{ ($coc_number==$policy_detail->coc_no) ? 'selected' : '' }} value="{{ $policy_detail->coc_no }}">{{ $policy_detail->coc_no }}</option>
                                            @endforeach
                                        </x-forms.select-field>

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
                                        <div class="flex space-x-2 justify-end">
                                            <span class="inline-block w-32">
                                                <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                                            </span>
                                            <a href="/u/customer_support"
                                                class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                                                Back
                                            </a>
                                        </div>
                                    </x-forms.form>
                                </x-card>
                            </div>
                            <div class="w-2/5 pb-6 pt-2">
                                <section class="bg-violet-500 text-white p-8 rounded-lg">
                                    <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES:</h2>
                                    <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                                        <li>
                                            Kindly fill-out all of the required fields.
                                        </li>
                                    </ul>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script></script>
    </x-slot:scripts>
</x-layout>
