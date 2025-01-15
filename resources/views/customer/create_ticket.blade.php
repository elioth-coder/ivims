<x-layout>
    <x-slot:title>Customer - Create Ticket</x-slot:title>
    <x-slot:head>

    </x-slot:head>
    <div class="relative w-full pb-[70px] overflow-y-scroll">
        <x-navbar-customer />
        <main class="w-full max-w-screen-lg mx-auto p-4 min-h-screen">
            {{-- <h1 class="text-2xl font-bold">Create Ticket</h1>
            <br> --}}

            <div class="flex flex-col">
                <div class="pb-6 pt-2">
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
                        <x-forms.form method="POST" action="/customer/store_ticket">
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
                                <a href="/customer/insurances"
                                    class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                                    Back
                                </a>
                            </div>
                        </x-forms.form>
                    </x-card>
                </div>
            </div>
        </main>

        <x-footer-customer />
    </div>
    <x-slot:scripts>
        <script></script>
    </x-slot:scripts>
</x-layout>
