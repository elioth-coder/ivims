<x-layout>
    <x-slot:title>Companies</x-slot:title>
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('css/data-table.css') }}">
        <style>
            html, body {
                overflow: hidden;
            }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar active="Companies" activeSub="Companies" />
            <div class="w-full pt-2 overflow-hidden overflow-y-scroll h-screen" style="height: calc(100vh - 80px)">
                <section class="px-8">
                    @php
                        $breadcrumbs = [
                            [
                                'url' => '#',
                                'title' => 'Companies',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="py-3 min-h-screen">
                        <div class="mx-auto max-w-full">
                            @if (session('message'))
                                <x-alerts.success id="alert-company">
                                    {{ session('message') }}
                                </x-alerts.success>
                            @endif
                        </div>

                        <div class="flex flex-col">
                            <div class="w-full pb-5">
                                <a href="/company/create"
                                    class="ps-5 text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm p-3 text-center inline-flex items-center">
                                    New Company
                                    <svg class="w-4 h-4 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 12h14m-7 7V5" />
                                    </svg>
                                </a>
                            </div>
                            <div class="relative overflow-x-auto w-full">
                                <table id="companies-table" class="bg-white w-full text-sm text-left rtl:text-right">
                                    <thead class="text-xs uppercase bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-4">Name</th>
                                            <th class="px-6 py-4">Valid Until</th>
                                            <th class="px-6 py-4">License</th>
                                            <th class="px-6 py-4 text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $company)
                                            <tr class="group cursor-pointer">
                                                <td class="group-hover:bg-violet-200 px-8 py-6">{{ $company->name }}</td>
                                                <td class="min-w-[120px] group-hover:bg-violet-200 px-8 py-6">{{ $company->expiry_date }}</td>
                                                <td class="group-hover:bg-violet-200 px-8 py-6 font-bold">
                                                    @php
                                                        $today  = strtotime(date('Y-m-d'));
                                                        $expiry = strtotime($company->expiry_date);

                                                        $expired = ($today >= $expiry);
                                                    @endphp

                                                    @if($expired)
                                                        @if($company->status=='revoked')
                                                            <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-yellow-600">REVOKED</span>
                                                        @else
                                                            <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-red-600">EXPIRED</span>
                                                        @endif
                                                    @else
                                                        <span class="text-xs inline-block text-white px-2 py-1 rounded-full bg-green-600">ACTIVE</span>
                                                    @endif
                                                </td>
                                                <td class="min-w-[150px] group-hover:bg-violet-200 px-8 py-6">
                                                    <x-forms.form class="hidden" method="POST" verb="DELETE"
                                                        action="/company/{{ $company->id }}"
                                                        id="delete-company-{{ $company->id }}-form">
                                                        <button type="submit">
                                                            Delete
                                                        </button>
                                                    </x-forms.form>

                                                    <a href="/company/{{ $company->id }}/edit" title="Edit"
                                                        class="text-violet-600 mx-auto border border-violet-600 hover:bg-violet-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                        <i class="bi bi-pencil-square w-5 h-5 inline-block"></i>
                                                    </a>

                                                    <button onclick="confirmDelete({{ $company->id }})" title="Delete"
                                                        type="button"
                                                        class="text-red-600 mx-auto border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded text-sm p-2 text-center inline-flex items-center">
                                                        <i class="bi bi-trash w-5 h-5 inline-block"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
        <script>
            const confirmDelete = async (id) => {
                let result = await Swal.fire({
                    title: "Delete this company?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Continue"
                });

                if (result.isConfirmed) {
                    document.querySelector(`#delete-company-${id}-form button`).click();
                }
            }

            (function() {
                setTimeout(() => {
                    if (document.getElementById("companies-table") && typeof DataTable !==
                        'undefined') {
                        const dataTable = new DataTable("#companies-table", {
                            fixedHeight: true,
                            searchable: true,
                            perPage: 5,
                        });
                    }
                }, 1000);
            })();
        </script>
    </x-slot:scripts>
</x-layout>
