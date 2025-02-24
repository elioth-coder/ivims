<x-layout>
    <x-slot:title>Licenses - Branch Renew</x-slot:title>
    <x-slot:head>
        <style>
            html, body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar active="Licenses" activeSub="Branches"/>
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/license',
                                'title' => 'Licenses',
                            ],
                            [
                                'url' => '/license/branch',
                                'title' => 'Branches',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Renew',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="flex space-x-3 min-h-screen">
                        <div class="w-3/5 pb-6 pt-2">
                            <div class="max-w-xl">
                                @if (session('message'))
                                    <x-alerts.success id="alert-branchs">
                                        {{ session('message') }}
                                    </x-alerts.success>
                                @endif
                            </div>
                            <x-card class="max-w-xl">
                                <x-card-header>Renew Branch License</x-card-header>
                                <x-forms.form method="POST" action="/license/branch/{{ $branch->id }}/renewal" verb="POST" x-data="license">
                                    <div class="flex space-x-2">
                                        @php
                                        if($errors->has('code')) {
                                            $code = old('code');
                                        } else {
                                            $code = (old('code')) ? old('code') : $branch->code;
                                        }
                                        @endphp
                                        <x-forms.input-field class="w-full"
                                            name="code"
                                            type="text"
                                            label="Branch Code"
                                            placeholder="--"
                                            value="{{ $code }}"
                                            required
                                            disabled
                                        />
                                        <div class="w-full"></div>
                                    </div>
                                    @php
                                    if($errors->has('name')) {
                                        $name = old('name');
                                    } else {
                                        $name = (old('name')) ? old('name') : $branch->name;
                                    }
                                    @endphp
                                    <x-forms.input-field class="w-full"
                                        name="name"
                                        type="text"
                                        label="Branch Name"
                                        placeholder="--"
                                        value="{{ $name }}"
                                        required
                                        disabled
                                    />
                                    <x-forms.input-field class="w-full"
                                        name="company"
                                        type="text"
                                        label="Company"
                                        placeholder="--"
                                        value="{{ $branch->company->name }}"
                                        required
                                        disabled
                                    />
                                    <div class="flex space-x-2">
                                        <x-forms.input-field class="w-full"
                                            name="start_date"
                                            type="date"
                                            label="Start Date"
                                            placeholder="--"
                                            value="{{ date('Y-m-d') }}"
                                            required
                                        />
                                        <x-forms.input-field class="w-full"
                                            name="expiry_date"
                                            type="date"
                                            label="Expiry Date"
                                            placeholder="--"
                                            required
                                        />
                                    </div>

                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="license_duration">
                                            License Duration
                                        </label>
                                        <select x-on:change="onChangeDuration" id="license_duration" name="license_duration" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="required">
                                            <option value="">--</option>
                                            <option value="1">1 YEAR LICENSE</option>
                                            <option value="2">2 YEARS LICENSE</option>
                                            <option value="3">3 YEARS LICENSE</option>
                                            <option value="4">4 YEARS LICENSE</option>
                                            <option value="5">5 YEARS LICENSE</option>
                                        </select>
                                    </div>

                                    <hr class="my-1">
                                    <div class="flex space-x-2 justify-end">
                                        <span class="inline-block w-32">
                                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                                        </span>
                                        <a href="/license/branch"
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

    <x-slot:scripts>
        <script>
            document.addEventListener('alpine:init', () => {
                function setExpiryDate() {
                    let license_duration = document.querySelector('#license_duration').value;
                    let start_date = document.querySelector('#start_date').value;
                    let expiry_date = DateFns.add(start_date, { years: license_duration });

                    document.querySelector('#expiry_date').value = expiry_date;
                }

                Alpine.data('license', () => ({
                    onChangeDuration () {
                        setExpiryDate();
                    }
                }));
            });
        </script>
    </x-slot:scripts>
</x-layout>
