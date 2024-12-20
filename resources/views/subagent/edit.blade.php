<x-layout>
    <x-slot:title>User</x-slot:title>
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
            <x-sidebar active="Users" activeSub="List of Users" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/user',
                                'title' => 'User',
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
                                    <x-alerts.success id="alert-users">
                                        {{ session('message') }}
                                    </x-alerts.success>
                                @endif
                            </div>
                            <x-card class="max-w-xl">
                                <x-card-header>Edit User</x-card-header>
                                <x-forms.form method="POST" action="/user/{{ $user->id }}" verb="PATCH">
                                    <div class="flex space-x-2">
                                        @php
                                        if($errors->has('first_name')) {
                                            $first_name = old('first_name');
                                        } else {
                                            $first_name = (old('first_name')) ? old('first_name') : $user->first_name;
                                        }
                                        @endphp
                                        <x-forms.input-field class="w-full"
                                            name="first_name"
                                            type="text"
                                            label="First name"
                                            placeholder="--"
                                            value="{{ $first_name }}"
                                            required
                                        />
                                        @php
                                        if($errors->has('last_name')) {
                                            $last_name = old('last_name');
                                        } else {
                                            $last_name = (old('last_name')) ? old('last_name') : $user->last_name;
                                        }
                                        @endphp
                                        <x-forms.input-field class="w-full"
                                            name="last_name"
                                            type="text"
                                            label="Last name"
                                            placeholder="--"
                                            value="{{ $last_name }}"
                                            required
                                        />
                                    </div>

                                    <div class="flex space-x-2">
                                        @php
                                        if($errors->has('gender')) {
                                            $gender = old('gender');
                                        } else {
                                            $gender = (old('gender')) ? old('gender') : $user->gender;
                                        }
                                        @endphp
                                        <x-forms.select-field class="w-full"
                                            name="gender"
                                            label="Gender"
                                            placeholder="--"
                                            required>
                                            <option {{ ($gender=='MALE') ? 'selected' : '' }} value="MALE">MALE</option>
                                            <option {{ ($gender=='FEMALE') ? 'selected' : '' }} value="FEMALE">FEMALE</option>
                                        </x-forms.select-field>
                                        @php
                                        if($errors->has('birthday')) {
                                            $birthday = old('birthday');
                                        } else {
                                            $birthday = (old('birthday')) ? old('birthday') : $user->birthday;
                                        }
                                        @endphp
                                        <x-forms.input-field class="w-full"
                                            name="birthday"
                                            type="date"
                                            label="Birthday"
                                            placeholder="--"
                                            value="{{ $birthday }}"
                                            required
                                        />
                                    </div>
                                    @php
                                    if($errors->has('contact_no')) {
                                        $contact_no = old('contact_no');
                                    } else {
                                        $contact_no = (old('contact_no')) ? old('contact_no') : $user->contact_no;
                                    }
                                    @endphp
                                    <x-forms.input-field class="w-full"
                                        name="contact_no"
                                        type="text"
                                        label="Contact No."
                                        placeholder="--"
                                        value="{{ $contact_no }}"
                                        required
                                    />
                                    @php
                                    if($errors->has('company_id')) {
                                        $company_id = old('company_id');
                                    } else {
                                        $company_id = (old('company_id')) ? old('company_id') : $user->company->id;
                                    }
                                    @endphp
                                    <x-forms.select-field class="w-full"
                                        name="company_id"
                                        label="Company"
                                        placeholder="--"
                                        required>
                                        @foreach($companies as $company)
                                            <option {{ ($company_id==$company->id) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </x-forms.select-field>
                                    @php
                                    if($errors->has('email')) {
                                        $email = old('email');
                                    } else {
                                        $email = (old('email')) ? old('email') : $user->email;
                                    }
                                    @endphp
                                    <x-forms.input-field class="w-full"
                                        name="email"
                                        type="email"
                                        label="Email"
                                        placeholder="--"
                                        value="{{ $email }}"
                                        required
                                    />
                                    <div class="flex space-x-2">
                                        @php
                                        if($errors->has('role')) {
                                            $role = old('role');
                                        } else {
                                            $role = (old('role')) ? old('role') : $user->role;
                                        }
                                        @endphp
                                        <x-forms.select-field class="w-full" name="role" label="Role" placeholder="--">
                                            <option {{ ($role=='agent') ? 'selected' : '' }} value="agent">Agent</option>
                                            <option {{ ($role=='subagent') ? 'selected' : '' }} value="subagent">Subagent</option>
                                        </x-forms.select-field>
                                        <div class="w-full"></div>
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
</x-layout>
