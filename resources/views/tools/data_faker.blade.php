@use(App\Models\PolicyHolder)

<x-layout>
    <x-slot:title>Data Faker</x-slot:title>
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
            <x-sidebar active="Tools" activeSub="Data Faker" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/tools',
                                'title' => 'Tools',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Data Faker',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="flex space-x-3 min-h-screen">
                        <div class="pb-6 mt-2 w-full">
                            <x-card class="">
                                <x-card-header>Data Faker</x-card-header>
                                <div class="flex">
                                    <button onclick="startFaker();" type="button"
                                        class="block mx-auto text-white bg-violet-700 hover:bg-violet-800 focus:outline-none focus:ring-4 focus:ring-violet-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2">
                                        <i class="bi bi-box-arrow-in-down text-lg -mb-1 me-1"></i>
                                        Start Faker
                                    </button>
                                </div>
                                <p id="status-text"></p>
                            </x-card>
                        </div>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script>
            const policy_holders = @json(PolicyHolder::all());

            async function getProvinces() {
                let response = await fetch('https://psgc.gitlab.io/api/provinces/');
                let items    = await response.json();

                return items;
            }

            async function getMunicipalities(province_code) {
                let response = await fetch(`https://psgc.gitlab.io/api/provinces/${province_code}/cities-municipalities`);
                let items    = await response.json();

                return items;
            }

            function generateRandomNumber(min, max) {
                if (typeof min !== "number" || typeof max !== "number") {
                    throw new Error("Min and max values must be numbers.");
                }
                if (min > max) {
                    throw new Error("Min cannot be greater than max.");
                }

                return Math.floor(Math.random() * (max - min + 1)) + min;
            }

            async function sleep(seconds=1) {
                return new Promise((resolve, reject) => { setTimeout(() => resolve(), seconds * 1000) });
            }

            async function startFaker() {
                $statusText = document.querySelector('#status-text');

                $statusText.innerHTML = "Fetching provinces...";
                let provinces = await getProvinces();

                for(let i=0; i<policy_holders.length; i++) {
                    let policy_holder = policy_holders[i];
                    let index = generateRandomNumber(0, provinces.length - 1);
                    let province = provinces[index];
                    $statusText.innerHTML = `Fetching municipalities of ${province.name}...`;
                    let municipalities = await getMunicipalities(province.code);
                        index = generateRandomNumber(0, municipalities.length - 1);
                    let municipality = municipalities[index];
                    $statusText.innerHTML = `Setting province to ${province.name} and municipality to ${municipality.name} for policy holder ${policy_holder.first_name} ${policy_holder.last_name}...`;

                    let formData = new FormData();
                    formData.set('id', policy_holder.id);
                    formData.set('municipality', municipality.name);
                    formData.set('province', province.name);

                    let { status, message } = await updateMunicipality(formData);

                    if(status=='success') {
                        $statusText.innerHTML = `Successfully set province to ${province.name} and municipality to ${municipality.name} for policy holder ${policy_holder.first_name} ${policy_holder.last_name}...`;
                    } else {
                        $statusText.innerHTML = `Failed to set province to ${province.name} and municipality to ${municipality.name} for policy holder ${policy_holder.first_name} ${policy_holder.last_name}...`;
                    }

                    await sleep(2);
                }
            }


            async function updateMunicipality(formData) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let response = await fetch(`/tools/update_municipality`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                });

                let {
                    status,
                    message
                } = await response.json();

                return { status, message };
            }

            window.onload = function() {

            }
        </script>
    </x-slot:scripts>
</x-layout>
