<x-card x-data="policy('{{ date('Y-m-d') }}')" class="max-w-xl">
    <x-card-header>Policy Details</x-card-header>
    <form id="form-policy-details" x-on:submit.prevent="submitPolicyDetails" method="POST" class="space-y-4 md:space-y-6">
        @php
            $company_id = Auth::user()->company_id;
            $branch_id  = Auth::user()->branch_id;
        @endphp
        <x-forms.select-field class="w-full"
            label="Company"
            disabled="disabled"
            name=""
            placeholder="--" required>
            @foreach ($companies as $company)
                <option {{ ($company->id==$company_id) ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </x-forms.select-field>

        <x-forms.select-field class="w-full"
            label="Branch"
            disabled="disabled"
            name=""
            placeholder="--" required>
            @foreach ($branches as $branch)
                <option {{ ($branch->id==$branch_id) ? 'selected' : '' }} value="{{ $branch->id }}">{{ $branch->name }}</option>
            @endforeach
        </x-forms.select-field>

        <div class="flex space-x-2">
            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_issued">
                    Date Issued
                </label>
                <input id="date_issued" name="date_issued"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="date"
                    x-model="date_issued"
                    required
                />
            </div>
            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="validity">
                    Validity
                </label>
                <select x-on:change="onChangeValidity" id="validity" name="validity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="required">
                    <option value="">--</option>
                    <option value="1">One (1) Year</option>
                    <option value="3">Three (3) Years</option>
                </select>
            </div>
        </div>
        <x-forms.select-field class="w-full" name="premium_code" label="Premium" placeholder="--" required>
            @foreach ($premiums as $premium)
                <option value="{{ $premium->code }}">
                    {{ $premium->code }} - {{ $premium->type }}
                    P ({{ number_format($premium->one_year) }} | P {{ number_format($premium->three_years) }})
                </option>
            @endforeach
        </x-forms.select-field>

        <h3 class="text-xl font-bold">Period of Insurance</h3>
        <div class="flex space-x-2">
            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_issued">
                    From
                </label>
                <input id="inception_date" name="inception_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="date"
                    x-model="date_issued"
                    required
                />
            </div>
            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="date_issued">
                    To
                </label>
                <input id="expiry_date" name="expiry_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    type="date"
                    required
                />
            </div>
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
