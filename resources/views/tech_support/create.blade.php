<x-layout>
    <x-slot:title>Tech Support</x-slot:title>
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
            <x-sidebar active="Users" activeSub="Tech Supports" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/user',
                                'title' => 'Users',
                            ],
                            [
                                'url' => '/user/tech_support',
                                'title' => 'Tech Supports',
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
                            <x-card class="max-w-xl">
                                <x-card-header>New Tech Support</x-card-header>
                                <x-forms.form method="POST" action="/user/tech_support">
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

                                    <hr class="my-1">
                                    <div class="flex space-x-2 justify-end">
                                        <span class="inline-block w-32">
                                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                                        </span>
                                        <a href="/user/tech_support"
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
