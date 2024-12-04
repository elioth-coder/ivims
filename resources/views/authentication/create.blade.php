<x-layout>
    <x-slot:title>Authentication</x-slot:title>
    <x-slot:head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            html,
            body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="mx-auto flex">
            <x-sidebar active="Authenticated" activeSub="New Authentication" />
            <div class="scrollable w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section x-data="authentication" class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/authentication',
                                'title' => 'Authentication',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Create',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />
                    {{--
                    <div class="flex justify-center my-5">
                        <h1 class="text-center text-3xl font-bold">New Authenticated Policy</h1>
                    </div>
                    <hr class="my-3">
                    --}}
                    <div class="flex items-center mt-3 py-3">
                        <x-authentication.stepper />
                    </div>
                    <br>
                    <div class="flex space-x-3 min-h-screen">
                        <div class="w-3/5 pb-6">
                            <section x-show="step==1">
                                <x-authentication.form-policy-holder :$valid_ids />
                            </section>
                            <section x-show="step==2">
                                <x-authentication.form-vehicle-details />
                            </section>
                            <section x-show="step==3">
                                <x-authentication.form-policy-details :$premiums />
                            </section>
                        </div>
                        <div class="w-2/5 pb-6 pt-2">
                            <section class="bg-violet-500 text-white p-8 rounded-lg">
                                <h2 class="mb-2 text-lg font-semibold dark:text-white">IMPORTANT NOTES:</h2>
                                <ul class="max-w-md space-y-1 list-disc list-inside dark:text-gray-400">
                                    <li>
                                        Kindly fill-up all of the required fields.
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
                $scrollable = document.querySelector('.scrollable');

                function setExpiryDate() {
                    let validity = document.querySelector('#validity').value;
                    let inception_date = document.querySelector('#inception_date').value;
                    let expiry_date = DateFns.add(inception_date, { years: validity });

                    document.querySelector('#expiry_date').value = expiry_date;
                }

                Alpine.data('authentication', () => ({
                    step: 1,
                    previous() {
                        this.step--;
                        $scrollable.scrollTo({ top: 0, behavior: 'smooth' });
                    },
                    submitPolicyHolder() {
                        Swal.fire({
                            title: "Processing..",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            document.querySelector('[name="mv_file_no"]').focus();
                        });

                        this.step = 2;
                        $scrollable.scrollTo({ top: 0, behavior: 'smooth' });
                    },
                    submitVehicleDetails() {
                        Swal.fire({
                            title: "Processing..",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            document.querySelector('[name="date_issued"]').focus();
                        });

                        this.step = 3;
                        $scrollable.scrollTo({ top: 0, behavior: 'smooth' });
                    },
                    async submitPolicyDetails() {
                        let policyHolderData   = new FormData(document.querySelector('#form-policy-holder'));
                        let vehicleDetailsData = new FormData(document.querySelector('#form-vehicle-details'));
                        let policyDetailsData  = new FormData(document.querySelector('#form-policy-details'));
                        let mergedFormData = new FormData();

                        [policyHolderData, vehicleDetailsData, policyDetailsData].forEach((formData) => {
                            for (const [key, value] of formData.entries()) {
                                mergedFormData.append(key, value);
                            }
                        });

                        Swal.fire({
                            title: "Processing authentication..",
                            showConfirmButton: false,
                        });

                        let csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        let response = await fetch('/authentication', {
                            method: 'POST',
                            body: mergedFormData,
                            headers: {
                                'X-CSRF-TOKEN': csrf_token
                            },
                        });

                        let {
                            status,
                            message,
                            policy,
                        } = await response.json();

                        await Swal.fire({
                            title: message,
                            icon: status,
                            showConfirmButton: false,
                            timer: 3000,
                        });

                        if(status=='success') {
                            window.location.href = "/authentication/";
                        }
                    }
                }));

                Alpine.data('policy', (date_issued='0000-00-00') => ({
                    date_issued,
                    onChangeValidity () {
                        setExpiryDate();
                    }
                }));
            });
        </script>
    </x-slot:scripts>
</x-layout>
