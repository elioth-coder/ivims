<x-layout>
    <x-slot:title>Licenses - Branch Revoke</x-slot:title>
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
                                'title' => 'Revoke',
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
                                <x-card-header>Revoke Branch License</x-card-header>
                                <x-forms.form method="POST" action="/license/branch/{{ $branch->id }}/revokal" verb="POST">
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
</x-layout>
