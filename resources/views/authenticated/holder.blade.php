<x-layout>
    <x-slot:title>Policy Holder</x-slot:title>
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
        <main class="flex mx-auto max-w-screen-2xl">
            <x-sidebar active="Authentication" activeSub="Authentications" />
            <div class="w-full h-screen pt-2 overflow-hidden overflow-y-scroll scrollable"
                style="height: calc(100vh - 80px)">
                <section x-data="authentication" class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '/authentication',
                                'title' => 'Authentication',
                            ],
                            [
                                'url' => '#',
                                'title' => 'Policy Holder',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />
                    <div class="min-h-screen">
                        <div class="w-full">
                            <h2 class="my-5 text-2xl text-center">Policy Holder</h2>
                        </div>
                        <div class="flex">
                            <table>
                                <tr>
                                    <th class="px-4 py-2 border border-r-0 text-start">Presented ID: </th>
                                    <td class="px-4 py-2 border">
                                        {{ $policy->holder->id_type }}
                                        <b>[ {{ $policy->holder->id_number }} ]</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 border border-r-0 text-start">Full Name: </th>
                                    <td class="px-4 py-2 border">
                                        {{ $policy->holder->first_name }}
                                        {{ ($policy->holder->middle_name=='NULL') ? '' : $policy->holder->middle_name }}
                                        {{ $policy->holder->last_name }}
                                        {{ ($policy->holder->suffix=='NULL') ? '' : $policy->holder->suffix }}
                                    </td>
                                    <th class="px-4 py-2 border border-r-0 text-start">Address: </th>
                                    <td class="px-4 py-2 border">{{ $policy->holder->address }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 border border-r-0 text-start">Gender: </th>
                                    <td class="px-4 py-2 border">{{ $policy->holder->gender }}</td>
                                    <th class="px-4 py-2 border border-r-0 text-start">Email: </th>
                                    <td class="px-4 py-2 border">{{ $policy->holder->email }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 border border-r-0 text-start">Birthday: </th>
                                    <td class="px-4 py-2 border">{{ $policy->holder->birthday }}</td>
                                    <th class="px-4 py-2 border border-r-0 text-start">Contact No.: </th>
                                    <td class="px-4 py-2 border">{{ $policy->holder->contact_no }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="my-4 border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center"
                                id="default-styled-tab"
                                data-tabs-toggle="#default-styled-tab-content"
                                data-tabs-active-classes="text-purple-600 hover:text-purple-600 border-purple-600"
                                data-tabs-inactive-classes="text-gray-500 hover:text-gray-600 border-gray-100 hover:border-gray-300"
                                role="tablist">
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="policy_detail-styled-tab" data-tabs-target="#styled-policy_detail" type="button" role="tab" aria-controls="policy_detail" aria-selected="false">
                                        <i class="bi bi-file-earmark-medical me-1"></i>
                                        Policy Details
                                    </button>
                                </li>
                                <li class="me-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="vehicle_detail-styled-tab" data-tabs-target="#styled-vehicle_detail" type="button" role="tab" aria-controls="vehicle_detail" aria-selected="false">
                                        <i class="bi bi-car me-1"></i>
                                        Insured Vehicle
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div id="default-styled-tab-content">
                            <div class="hidden p-4 rounded-lg" id="styled-vehicle_detail" role="tabpanel" aria-labelledby="vehicle_detail-tab">
                                <table>
                                    <tr>
                                        <th class="px-4 py-2 border border-r-0 text-start">Make: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->make }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border border-r-0 text-start">Model: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->model }} ({{ $policy->vehicle->color }})</td>
                                        <th class="px-4 py-2 border border-r-0 text-start">MV File No.: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->mv_file_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border border-r-0 text-start">Body Type: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->body_type }}</td>
                                        <th class="px-4 py-2 border border-r-0 text-start">Plate No.: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->plate_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border border-r-0 text-start">Auth. Capacity: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->authorized_cap }}</td>
                                        <th class="px-4 py-2 border border-r-0 text-start">Serial/Chassis: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->serial_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border border-r-0 text-start">Unladen Weight: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->unladen_weight }}</td>
                                        <th class="px-4 py-2 border border-r-0 text-start">Motor/Engine: </th>
                                        <td class="px-4 py-2 border">{{ $policy->vehicle->motor_no }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="hidden p-4 rounded-lg" id="styled-policy_detail" role="tabpanel" aria-labelledby="policy_detail-tab">
                                <table class="w-full">
                                    <tr>
                                        <th class="px-4 py-2 border text-start">Company: </th>
                                        <td class="px-4 py-2 border border-r-0">{{ $policy->company->name }}</td>
                                        <th class="px-4 py-2 border text-start">Date Issued: </th>
                                        <td class="px-4 py-2 border">{{ date('M. d, Y', strtotime($policy->date_issued)) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border text-start">Agent: </th>
                                        <td class="px-4 py-2 border border-r-0">{{ $policy->processed_by->name }}</td>
                                        <th class="px-4 py-2 border text-start">COC #: </th>
                                        <td class="px-4 py-2 border">{{ $policy->coc_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border text-start">Inception Date: </th>
                                        <td class="px-4 py-2 border border-r-0">{{ date('M. d, Y', strtotime($policy->inception_date)) }} - 12:00 NN</td>
                                        <th class="px-4 py-2 border text-start">Policy #: </th>
                                        <td class="px-4 py-2 border">{{ $policy->policy_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border text-start">Expiry Date: </th>
                                        <td class="px-4 py-2 border border-r-0">{{ date('M. d, Y', strtotime($policy->expiry_date)) }} - 12:00 NN</td>
                                        <th class="px-4 py-2 border text-start">OR #: </th>
                                        <td class="px-4 py-2 border">{{ $policy->or_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="px-4 py-2 border text-start">Classification: </th>
                                        <td class="px-4 py-2 border border-r-0">{{ $policy->type }}</td>
                                        <th class="px-4 py-2 border text-start">Validity: </th>
                                        <td class="px-4 py-2 border">
                                            {{ $policy->validity . ' ' . (($policy->validity > 1) ? 'Years' : 'Year') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" class="py-5 text-end">
                                            <a target="_blank" href="/authentication/{{ $policy->id }}/print" class="text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                                                Print
                                                <i class="ms-1 bi bi-printer-fill"></i>
                                            </a>
                                        </th>
                                        <th class="px-4 py-2 border text-start">Amount: </th>
                                        <td class="px-4 py-2 border">{{ number_format($policy->premium, 2) }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <x-copyright />
            </div>
        </main>
    </div>
    <x-slot:scripts>
        <script></script>
    </x-slot:scripts>
</x-layout>
