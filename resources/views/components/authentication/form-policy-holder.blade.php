@props([
    'valid_ids'=>[]
])

<x-card class="max-w-xl">
    <x-card-header>Policy Holder</x-card-header>
    <form id="form-policy-holder" x-on:submit.prevent="submitPolicyHolder" method="POST" class="space-y-4 md:space-y-6">
        <div class="flex space-x-2">
            <x-forms.select-field class="w-full"
                name="id_type"
                label="ID Type"
                placeholder="--"
                required>
                @foreach ($valid_ids as $valid_id)
                    <option value="{{ $valid_id->code }}">{{ $valid_id->code }}</option>
                @endforeach
            </x-forms.select-field>
            <x-forms.input-field class="w-full"
                name="id_number"
                type="text"
                label="ID No."
                placeholder="--"
                required
            />
        </div>

        <x-forms.input-field class="w-full"
            name="business"
            type="text"
            label="Business / Profession"
            placeholder="--"
            required
        />

        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="first_name"
                type="text"
                label="First name"
                placeholder="--"
                required
            />
            <x-forms.input-field class="w-1/2"
                name="suffix"
                type="text"
                label="Suffix"
                placeholder="--"
            />
        </div>

        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="last_name"
                type="text"
                label="Last name"
                placeholder="--"
                required
            />
            <x-forms.input-field class="w-full"
                name="middle_name"
                type="text"
                label="Middle name"
                placeholder="--"
            />
        </div>

        <div class="flex space-x-2">
            <x-forms.select-field class="w-full"
                name="gender"
                label="Gender"
                placeholder="--"
                required>
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
            </x-forms.select-field>
            <x-forms.input-field class="w-full"
                name="birthday"
                type="date"
                label="Birthday"
                placeholder="--"
                required
            />
        </div>

        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="contact_no"
                type="text"
                label="Contact No."
                placeholder="--"
                required
            />
            <x-forms.input-field class="w-full"
                name="email"
                type="email"
                label="Email"
                placeholder="--"
                required
            />
        </div>
        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="province"
                type="text"
                label="Province"
                list="provinces"
                placeholder="--"
                required
            />
            <datalist id="provinces"></datalist>
            <x-forms.input-field class="w-full"
                name="municipality"
                type="text"
                label="Municipality"
                list="municipalities"
                placeholder="--"
                required
            />
            <datalist id="municipalities"></datalist>
        </div>
        <x-forms.input-field class="w-full"
            name="address"
            type="text"
            label="Address"
            placeholder="--"
            required
        />
        <hr class="my-1">
        <div class="flex space-x-2 justify-end">
            <a href="/authentication"
                class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                Back
            </a>
            <span class="inline-block w-32">
                <x-forms.button type="submit" color="violet">Next</x-forms.button>
            </span>
        </div>
    </form>
</x-card>
