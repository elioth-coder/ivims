<x-layout>
    <x-slot:title>Agent</x-slot:title>
    <x-slot:head>
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
            <x-sidebar active="Agents" activeSub="New Agent" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/agent',
                                'title' => 'Agents',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Create',
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
                            <x-card class="max-w-xl" x-data="license">
                                <x-card-header>New Agent</x-card-header>
                                <x-forms.form method="POST" action="/agent">
                                    <div class="flex space-x-2">
                                        <x-forms.input-field autofocus="on"
                                            class="w-full" name="first_name" type="text"
                                            label="First name" placeholder="--" required />
                                        <x-forms.input-field class="w-full" name="last_name" type="text"
                                            label="Last name" placeholder="--" />
                                    </div>

                                    <div class="flex space-x-2">
                                        <x-forms.select-field class="w-full" name="gender" label="Gender"
                                            placeholder="--" required>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </x-forms.select-field>
                                        <x-forms.input-field class="w-full" name="birthday" type="date"
                                            label="Birthday" placeholder="--" required />
                                    </div>

                                    <x-forms.input-field class="w-full" name="contact_no" type="text"
                                        label="Contact No." placeholder="--" required />

                                    <x-forms.input-field class="w-full" name="email" type="email" label="Email"
                                        placeholder="--" required />

                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            for="license_duration">
                                            Company
                                        </label>
                                        <select x-on:change="onChangeCompany" id="company_id"
                                            name="company_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            required="required">
                                            <option value="">--</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="flex space-x-2">
                                        <div class="w-full">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                for="branch_id">
                                                Branch
                                            </label>
                                            <select id="branch_id"
                                                name="branch_id"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                                required="required">
                                                <option value="">--</option>
                                                <template x-for="branch in branches">
                                                    <option x-bind:value="branch.id" x-text="branch.name"></option>
                                                </template>
                                            </select>
                                        </div>

                                        <x-forms.select-field class="w-full" name="role" label="Role"
                                            placeholder="--" required>
                                            <option value="AGENT">AGENT</option>
                                            <option value="SUBAGENT">SUBAGENT</option>
                                        </x-forms.select-field>
                                    </div>

                                    <div class="flex space-x-2">
                                        <x-forms.input-field
                                            class="w-full"
                                            name="start_date"
                                            type="date"
                                            label="Start Date"
                                            placeholder="--"
                                            value="{{ date('Y-m-d') }}"
                                            required
                                        />
                                        <x-forms.input-field class="w-full" name="expiry_date" type="date"
                                            label="Expiry Date" placeholder="--" required />
                                    </div>

                                    <div class="w-full">
                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                            for="license_duration">
                                            License Duration
                                        </label>
                                        <select x-on:change="onChangeDuration" id="license_duration"
                                            name="license_duration"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                            required="required">
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
                                        <a href="/dashboard/announcement"
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
            const branches = @json($branches);

            document.addEventListener('alpine:init', () => {
                function setExpiryDate() {
                    let license_duration = document.querySelector('#license_duration').value;
                    let start_date = document.querySelector('#start_date').value;
                    let expiry_date = DateFns.add(start_date, { years: license_duration });

                    document.querySelector('#expiry_date').value = expiry_date;
                }

                Alpine.data('license', () => ({
                    branches: [],
                    onChangeCompany(e) {
                        this.branches = branches.filter(b => b.company_id == e.target.value);
                    },
                    onChangeDuration (e) {
                        setExpiryDate();
                    }
                }));
            });
        </script>
    </x-slot:scripts>
</x-layout>
