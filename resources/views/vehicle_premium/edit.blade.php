<x-layout>
    <x-slot:title>Vehicle Premium</x-slot:title>
    <x-slot:head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            html, body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar active="Settings" activeSub="Vehicle Premium"  />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/setting',
                                'title' => 'Settings',
                            ],
                            [
                                'url' => '/setting/vehicle_premium',
                                'title' => 'Vehicle Premium',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Edit',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="flex space-x-3 min-h-screen">
                        <div class="w-3/5 pb-6 pt-2">
                            <div class="max-w-xl">
                                @if (session('message'))
                                    <x-alerts.success id="alert-announcements">
                                        {{ session('message') }}
                                    </x-alerts.success>
                                @endif
                            </div>
                            <x-card class="max-w-xl">
                                <x-card-header>Edit Vehicle Premium</x-card-header>
                                <x-forms.form method="POST" action="/setting/vehicle_premium/{{ $vehicle_premium->id }}" verb="PATCH">
                                    <div class="flex space-x-2">
                                        @php
                                        if($errors->has('code')) {
                                            $code = old('code');
                                        } else {
                                            $code = (old('code')) ? old('code') : $vehicle_premium->code;
                                        }
                                        @endphp
                                        <x-forms.input-field class="w-full"
                                            name="code"
                                            type="text"
                                            label="Code"
                                            placeholder="--"
                                            value="{{ $code }}"
                                            required
                                        />
                                        <div class="w-full"></div>
                                    </div>
                                    @php
                                    if($errors->has('type')) {
                                        $type = old('type');
                                    } else {
                                        $type = (old('type')) ? old('type') : $vehicle_premium->type;
                                    }
                                    @endphp
                                    <x-forms.input-field class="w-full"
                                        name="type"
                                        type="text"
                                        label="Type"
                                        placeholder="--"
                                        value="{{ $type }}"
                                        required
                                    />

                                    <div class="flex space-x-2">
                                        @php
                                        if($errors->has('one_year')) {
                                            $one_year = old('one_year');
                                        } else {
                                            $one_year = (old('one_year')) ? old('one_year') : $vehicle_premium->one_year;
                                        }
                                        @endphp
                                        <x-forms.input-field class="w-full"
                                            name="one_year"
                                            type="text"
                                            label="1 Year (Amount)"
                                            placeholder="--"
                                            value="{{ $one_year }}"
                                            required
                                        />
                                        @php
                                        if($errors->has('three_years')) {
                                            $three_years = old('three_years');
                                        } else {
                                            $three_years = (old('three_years')) ? old('three_years') : $vehicle_premium->three_years;
                                        }
                                        @endphp
                                        <x-forms.input-field class="w-full"
                                            name="three_years"
                                            type="text"
                                            label="3 Years (Amount)"
                                            placeholder="--"
                                            value="{{ $three_years }}"
                                            required
                                        />
                                    </div>

                                    <hr class="my-1">
                                    <div class="flex space-x-2 justify-end">
                                        <span class="inline-block w-32">
                                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                                        </span>
                                        <a href="/setting/vehicle_premium"
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
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
</x-layout>
