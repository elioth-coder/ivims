@props([
    'body_types'=>[]
])

<x-card class="max-w-xl">
    <x-card-header>Vehicle Details</x-card-header>
    <form id="form-vehicle-details" x-on:submit.prevent="submitVehicleDetails" method="POST" class="space-y-4 md:space-y-6">
        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="mv_file_no"
                type="text"
                autofocus="on"
                label="MV File No."
                placeholder="--"
                required
            />
            <x-forms.input-field class="w-full"
                name="plate_no"
                type="text"
                label="Plate No."
                placeholder="--"
                required
            />
        </div>
        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="serial_no"
                type="text"
                label="Serial No."
                placeholder="--"
                required
            />
            <x-forms.input-field class="w-full"
                name="motor_no"
                type="text"
                label="Motor No."
                placeholder="--"
                required
            />
        </div>

        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="make"
                type="text"
                label="Make"
                placeholder="--"
                required
            />
            <x-forms.input-field class="w-full"
                name="model"
                type="text"
                label="Model"
                placeholder="--"
            />
        </div>

        <div class="flex space-x-2">
            @php
            $colors = [
                'RED',
                'ORANGE',
                'YELLOW',
                'GREEN',
                'BLUE',
                'INDIGO',
                'VIOLET',
                'BLACK',
                'WHITE',
            ];
            @endphp
            <x-forms.select-field class="w-full"
                name="color"
                label="Color"
                placeholder="--"
                required>
                @foreach($colors as $color)
                    <option value="{{ $color }}">{{ strtoupper($color) }}</option>
                @endforeach
            </x-forms.select-field>
            <x-forms.select-field class="w-full"
                name="body_type"
                label="Body Type"
                placeholder="--"
                required>
                @foreach($body_types as $body_type)
                    <option value="{{ $body_type->type }}">{{ strtoupper($body_type->type) }}</option>
                @endforeach
            </x-forms.select-field>
        </div>

        <div class="flex space-x-2">
            <x-forms.input-field class="w-full"
                name="authorized_cap"
                type="number"
                label="Authorized Capacity"
                placeholder="--"
                required
            />
            <x-forms.input-field class="w-full"
                name="unladen_weight"
                type="number"
                label="Unladen Weight"
                placeholder="--"
                required
            />
        </div>
        <hr class="my-1">
        <div class="flex space-x-2 justify-end">
            <button x-on:click="previous()" type="button"
                class="text-center flex items-center justify-center w-auto px-10 border border-gray-500 rounded-lg bg-white hover:bg-gray-500 hover:text-white">
                Previous
            </button>
            <span class="inline-block w-32">
                <x-forms.button type="submit" color="violet">Next</x-forms.button>
            </span>
        </div>
    </form>
</x-card>
