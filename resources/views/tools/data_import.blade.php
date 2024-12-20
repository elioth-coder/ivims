<x-layout>
    <x-slot:title>Data Import</x-slot:title>
    <x-slot:head>
        <script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.2/papaparse.min.js"></script>
        <style>
        html, body {
            overflow: hidden;
        }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="max-w-screen-2xl mx-auto flex">
            <x-sidebar active="Tools" activeSub="Data Import"  />
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
                                'title' => 'Data Import',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="flex space-x-3 min-h-screen">
                        <div class="pb-6 mt-2 w-full">
                            <x-card class="">
                                <x-card-header>Data Import</x-card-header>
                                <div class="flex gap-2">
                                    <section class="w-2/5">
                                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input_help" id="file_input" type="file">
                                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">CSV files only *.csv</p>
                                    </section>
                                    <section class="w-2/5">
                                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select data target</label>
                                        <select id="data_target" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full">
                                            <option value="" selected>--</option>
                                            <option value="companies">Insurance Companies</option>
                                            <option value="policy_details">Authenticated Policies</option>
                                            <option value="policy_holders">Policy Holders</option>
                                            <option value="vehicle_details">Vehicles</option>
                                        </select>
                                    </section>
                                    <div class="flex w-1/5 items-center justify-center">
                                        <button onclick="startImport();" type="button" class="block mx-auto text-white bg-violet-700 hover:bg-violet-800 focus:outline-none focus:ring-4 focus:ring-violet-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2">
                                            <i class="bi bi-box-arrow-in-down text-lg -mb-1 me-1"></i>
                                            Start Import
                                        </button>
                                    </div>
                                </div>
                                <div class="block overflow-x-scroll w-full"  id="table_container"></div>
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
            let items = [];

            async function startImport() {
                let dataTarget = document.querySelector(`#data_target`).value;
                let hasTarget  = dataTarget.length;

                if(!items.length || !hasTarget) {
                    await Swal.fire({
                        title: 'Error: No data target or items to import',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                    });

                    return;
                }

                let success_count = 0;
                for(let i=0; i<items.length; i++) {
                    if(await uploadItem(i, dataTarget)) {
                        success_count++;
                    }
                }

                Swal.fire({
                    title: `Imported ${success_count}/${items.length} items`,
                    icon: 'info',
                    showDenyButton: true,
                    confirmButtonText: 'Reload page?',
                    denyButtonText: "No, thanks!",
                }).then(result => {
                    if(result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }

            function parseFile(file) {
                return new Promise((resolve, reject) => {
                    Papa.parse(file, {
                        header: true,
                        skipEmptyLines: true,
                        complete: function(results) {
                            resolve(results.data);
                        },
                        error: function(error) {
                            console.error('Error:', error);
                            resolve([]);
                        },
                    });
                })
            }

            async function uploadItem(index, dataTarget) {
                let $td = document.querySelector(`#status_${index}`);
                let item = items[index];

                $td.innerHTML = `<span>Uploading...</span>`;
                let formData = new FormData();

                let keys = Object.keys(item);
                keys.forEach(key => {
                    formData.set(key, item[key]);
                });

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let response = await fetch(`/tools/process_import/${dataTarget}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                });

                let { status, message } = await response.json();

                if(status == 'success') {
                    $td.innerHTML = `<span class="text-green-500">
                        <i class="bi bi-check-lg"></i>
                        Success
                    </span>`;

                    return true;
                } else {
                    $td.innerHTML = `<span class="text-red-500">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        Error
                    </span>`;

                    return false;
                }
            }

            window.onload = function() {
                document.getElementById('file_input').addEventListener('change', async function(e) {
                    const file = e.target.files[0];

                    if (file) {
                        items = await parseFile(file);

                        let $container = document.querySelector('#table_container')
                        let row_1 = items[0];

                        let keys = Object.keys(row_1);
                        let theadCells = '';
                        let tbodyRows = '';

                        theadCells += `<th class="px-6 py-3">status</th>`;
                        keys.forEach(key => {
                            theadCells += `<th class="px-6 py-3">${key}</th>`;
                        });

                        items.forEach((item, index) => {
                            let rowCells = '';
                            let row = '';

                            rowCells += `<td class="px-6 py-3" id="status_${index}">
                                <button onclick="uploadItem(${index});" class="border rounded px-6 py-2 hover:bg-gray-200 hover:border-gray-700">Upload</button>
                            </td>`;
                            keys.forEach(key => {
                                rowCells += `<td class="px-6 py-3">${item[key]}</td>`;
                            });

                            tbodyRows += `<tr>${rowCells}</tr>`;
                        });

                        let tableHtml = `
                            <table class="w-full text-sm text-left rtl:text-right">
                                <thead class="w-full text-sm text-left rtl:text-right bg-gray-200">
                                    <tr>${theadCells}</tr>
                                </thead>
                                <tbody>${tbodyRows}</tbody>
                            </table>
                        `;

                        $container.innerHTML = tableHtml;
                    }
                });
            }
        </script>
    </x-slot:scripts>
</x-layout>
