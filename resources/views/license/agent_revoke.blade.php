<x-layout>
    <x-slot:title>Licenses - Agents</x-slot:title>
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
            <x-sidebar active="Licenses" activeSub="Agents"/>
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/license',
                                'title' => 'Licenses',
                            ],
                            [
                                'url' => '/agent',
                                'title' => 'Agents',
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
                                    <x-alerts.success id="alert-agents">
                                        {{ session('message') }}
                                    </x-alerts.success>
                                @endif
                            </div>
                            <x-card class="max-w-xl">
                                <x-card-header>Revoke Agent License</x-card-header>
                                <x-forms.form method="POST" action="/license/agent/{{ $agent->id }}/revokal" verb="POST">
                                    <div class="flex space-x-2">
                                        <x-forms.input-field class="w-full"
                                            name="name"
                                            type="text"
                                            label="Agent Name"
                                            placeholder="--"
                                            value="{{ $agent->name }}"
                                            required
                                            disabled
                                        />
                                        <div class="w-full"></div>
                                    </div>
                                    <x-forms.input-field class="w-full"
                                        name="company"
                                        type="text"
                                        label="Company"
                                        placeholder="--"
                                        value="{{ $agent->company->name }}"
                                        required
                                        disabled
                                    />
                                    <x-forms.input-field class="w-full"
                                        name="branch"
                                        type="text"
                                        label="Branch"
                                        placeholder="--"
                                        value="{{ ($agent->branch) ? $agent->branch->name : '--' }}"
                                        required
                                        disabled
                                    />

                                    <x-forms.textarea-field
                                        name="remarks"
                                        label="Reason for revoking license"
                                        placeholder="--"
                                        rows="5"
                                        required
                                    />

                                    <hr class="my-1">
                                    <div class="flex space-x-2 justify-end">
                                        <span class="inline-block w-32">
                                            <x-forms.button type="submit" color="violet">Submit</x-forms.button>
                                        </span>
                                        <a href="/license/agent"
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
