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
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar active="Authenticated" activeSub="List of Authenticated" />
            <div class="scrollable w-full pt-2 overflow-hidden overflow-y-scroll h-screen"
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
                            <h2 class="text-2xl text-center my-5">Policy Holder</h2>
                        </div>
                        <div class="flex">
                            <table>
                                <tr>
                                    <th class="text-start px-4 py-2 border border-r-0">Presented ID: </th>
                                    <td class="border px-4 py-2">
                                        {{ $policy->holder->id_type }}
                                        <b>[ {{ $policy->holder->id_number }} ]</b>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-start px-4 py-2 border border-r-0">Full Name: </th>
                                    <td class="border px-4 py-2">
                                        {{ $policy->holder->first_name }}
                                        {{ ($policy->holder->middle_name=='NULL') ? '' : $policy->holder->middle_name }}
                                        {{ $policy->holder->last_name }}
                                        {{ ($policy->holder->suffix=='NULL') ? '' : $policy->holder->suffix }}
                                    </td>
                                    <th class="text-start px-4 py-2 border border-r-0">Address: </th>
                                    <td class="border px-4 py-2">{{ $policy->holder->address }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-4 py-2 border border-r-0">Gender: </th>
                                    <td class="border px-4 py-2">{{ $policy->holder->gender }}</td>
                                    <th class="text-start px-4 py-2 border border-r-0">Email: </th>
                                    <td class="border px-4 py-2">{{ $policy->holder->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-start px-4 py-2 border border-r-0">Birthday: </th>
                                    <td class="border px-4 py-2">{{ $policy->holder->birthday }}</td>
                                    <th class="text-start px-4 py-2 border border-r-0">Contact No.: </th>
                                    <td class="border px-4 py-2">{{ $policy->holder->contact_no }}</td>
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
                                        <th class="text-start px-4 py-2 border border-r-0">Make: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->make }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border border-r-0">Model: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->model }} ({{ $policy->vehicle->color }})</td>
                                        <th class="text-start px-4 py-2 border border-r-0">MV File No.: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->mv_file_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border border-r-0">Body Type: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->body_type }}</td>
                                        <th class="text-start px-4 py-2 border border-r-0">Plate No.: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->plate_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border border-r-0">Auth. Capacity: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->authorized_cap }}</td>
                                        <th class="text-start px-4 py-2 border border-r-0">Serial/Chassis: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->serial_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border border-r-0">Unladen Weight: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->unladen_weight }}</td>
                                        <th class="text-start px-4 py-2 border border-r-0">Motor/Engine: </th>
                                        <td class="border px-4 py-2">{{ $policy->vehicle->motor_no }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="hidden p-4 rounded-lg" id="styled-policy_detail" role="tabpanel" aria-labelledby="policy_detail-tab">
                                <table class="w-full">
                                    <tr>
                                        <th class="text-start px-4 py-2 border">Company: </th>
                                        <td class="border px-4 py-2 border-r-0">{{ $policy->company->name }}</td>
                                        <th class="text-start px-4 py-2 border">Date Issued: </th>
                                        <td class="border px-4 py-2">{{ date('M. d, Y', strtotime($policy->date_issued)) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border">Agent: </th>
                                        <td class="border px-4 py-2 border-r-0">{{ $policy->processed_by->name }}</td>
                                        <th class="text-start px-4 py-2 border">COC #: </th>
                                        <td class="border px-4 py-2">{{ $policy->coc_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border">Inception Date: </th>
                                        <td class="border px-4 py-2 border-r-0">{{ date('M. d, Y', strtotime($policy->inception_date)) }} - 12:00 NN</td>
                                        <th class="text-start px-4 py-2 border">Policy #: </th>
                                        <td class="border px-4 py-2">{{ $policy->policy_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border">Expiry Date: </th>
                                        <td class="border px-4 py-2 border-r-0">{{ date('M. d, Y', strtotime($policy->expiry_date)) }} - 12:00 NN</td>
                                        <th class="text-start px-4 py-2 border">OR #: </th>
                                        <td class="border px-4 py-2">{{ $policy->or_no }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-start px-4 py-2 border">Classification: </th>
                                        <td class="border px-4 py-2 border-r-0">{{ $policy->type }}</td>
                                        <th class="text-start px-4 py-2 border">Validity: </th>
                                        <td class="border px-4 py-2">
                                            {{ $policy->validity . ' ' . (($policy->validity > 1) ? 'Years' : 'Year') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2"></th>
                                        <th class="text-start px-4 py-2 border">Amount: </th>
                                        <td class="border px-4 py-2">{{ number_format($policy->premium, 2) }}</td>
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
