<x-layout>
    <x-slot:title>Authentication</x-slot:title>
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
            <x-sidebar active="Authentication" activeSub="New Authentication" />
            <div class="scrollable w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section x-data="authentication" class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/authentication',
                                'title' => 'Authentications',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Create',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />
                    <br>
                    <div class="flex space-x-3 min-h-screen">
                        <div class="w-3/5 pb-6">
                            <section x-show="step==1">
                                <x-authentication.form-policy-holder :$valid_ids />
                            </section>
                            <section x-show="step==2">
                                <x-authentication.form-vehicle-details :$body_types />
                            </section>
                            <section x-show="step==3">
                                <x-authentication.form-policy-details :$premiums :$companies :$branches />
                            </section>
                        </div>
                        <div class="w-2/5 pb-6">
                            <x-authentication.stepper />
                            <br>
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
            window.onload = function() {
                document.querySelector('#id_number').addEventListener('keydown', function(event) {
                    if(event.key == 'Enter') {
                        autofillPolicyHolder();
                    }
                });

                document.querySelector('#mv_file_no').addEventListener('keydown', function(event) {
                    if(event.key == 'Enter') {
                        autofillVehicleDetail();
                    }
                });

                document.querySelector('#province').addEventListener('blur', function(event) {
                    let province = event.target.value;
                    populateMunicipalities(province);
                })

                populateProvinces();
            }

            async function populateProvinces() {
                let provinces = await getProvinces();
                let $dataListProvince = document.querySelector('#provinces');

                let options =
                    provinces
                        .map(province => {
                            return `<option value="${province.name}"></option>`;
                        })
                        .join("\n");
                $dataListProvince.innerHTML = options;
            }

            async function populateMunicipalities(province_name) {
                let provinces = await getProvinces();
                let matches   = provinces.filter((p) => {
                    return p.name == province_name;
                });
                let province;

                if(matches.length) {
                    province = matches[0];
                }

                if(!province) return;

                let municipalities = await getMunicipalities(province.code);
                let $dataListMunicipality = document.querySelector('#municipalities');

                let options = municipalities
                    .map(municipality => {
                        return `<option value="${municipality.name}"></option>`;
                    })
                    .join("\n");

                $dataListMunicipality.innerHTML = options;
            }

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

            async function autofillPolicyHolder() {
                let id_number = document.querySelector('#id_number').value;
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let response = await fetch(`/autofill/policy_holder/${id_number}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                });

                let { status, message, policy_holder } = await response.json();
                if(status == 'success') {
                    Swal.fire({
                        title: `Found a data for ID No. ${id_number}!`,
                        icon: 'info',
                        showDenyButton: true,
                        confirmButtonText: 'Autofill form?',
                        denyButtonText: "No, thanks!",
                    }).then(result => {
                        if(result.isConfirmed) {
                            console.log(policy_holder);

                            document.querySelector('#id_type').value     = (policy_holder.id_type=='NULL')     ? '' : policy_holder.id_type;
                            document.querySelector('#business').value    = (policy_holder.business=='NULL')    ? '' : policy_holder.business;
                            document.querySelector('#first_name').value  = (policy_holder.first_name=='NULL')  ? '' : policy_holder.first_name;
                            document.querySelector('#middle_name').value = (policy_holder.middle_name=='NULL') ? '' : policy_holder.middle_name;
                            document.querySelector('#last_name').value   = (policy_holder.last_name=='NULL')   ? '' : policy_holder.last_name;
                            document.querySelector('#suffix').value      = (policy_holder.suffix=='NULL')      ? '' : policy_holder.suffix;
                            document.querySelector('#gender').value      = (policy_holder.gender=='NULL')      ? '' : policy_holder.gender;
                            document.querySelector('#birthday').value    = (policy_holder.birthday=='NULL')    ? '' : policy_holder.birthday;
                            document.querySelector('#contact_no').value  = (policy_holder.contact_no=='NULL')  ? '' : policy_holder.contact_no;
                            document.querySelector('#email').value       = (policy_holder.email=='NULL')       ? '' : policy_holder.email;
                            document.querySelector('#address').value     = (policy_holder.address=='NULL')     ? '' : policy_holder.address;
                        }
                    });
                }
            }

            async function autofillVehicleDetail() {
                let mv_file_no = document.querySelector('#mv_file_no').value;
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let response = await fetch(`/autofill/vehicle_detail/${mv_file_no}`, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                });

                let { status, message, vehicle_detail } = await response.json();
                if(status == 'success') {
                    Swal.fire({
                        title: `Found a data for MV File No. ${mv_file_no}!`,
                        icon: 'info',
                        showDenyButton: true,
                        confirmButtonText: 'Autofill form?',
                        denyButtonText: "No, thanks!",
                    }).then(result => {
                        if(result.isConfirmed) {
                            document.querySelector('#plate_no').value       = (vehicle_detail.plate_no=='NULL')       ? '' : vehicle_detail.plate_no;
                            document.querySelector('#serial_no').value      = (vehicle_detail.serial_no=='NULL')      ? '' : vehicle_detail.serial_no;
                            document.querySelector('#motor_no').value       = (vehicle_detail.motor_no=='NULL')       ? '' : vehicle_detail.motor_no;
                            document.querySelector('#make').value           = (vehicle_detail.make=='NULL')           ? '' : vehicle_detail.make;
                            document.querySelector('#model').value          = (vehicle_detail.model=='NULL')          ? '' : vehicle_detail.model;
                            document.querySelector('#color').value          = (vehicle_detail.color=='NULL')          ? '' : vehicle_detail.color;
                            document.querySelector('#body_type').value      = (vehicle_detail.body_type=='NULL')      ? '' : vehicle_detail.body_type;
                            document.querySelector('#authorized_cap').value = (vehicle_detail.authorized_cap=='NULL') ? '' : vehicle_detail.authorized_cap;
                            document.querySelector('#unladen_weight').value = (vehicle_detail.unladen_weight=='NULL') ? '' : vehicle_detail.unladen_weight;
                        }
                    });
                }
            }

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
                    async submitPolicyHolder() {
                        this.step = 2;
                        await Swal.fire({
                            title: "Processing..",
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            $scrollable.scrollTo({ top: 0, behavior: 'smooth' });
                            document.querySelector('[name="mv_file_no"]').focus();
                        });
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
                            allowOutsideClick: false,
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
