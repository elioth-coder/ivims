<x-layout>
    <x-slot:title>Backup & Restore</x-slot:title>
    <x-slot:head>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.2/papaparse.min.js"></script>
        <style>
        html, body {
            overflow: hidden;
        }
        </style>
    </x-slot:head>
    <x-navbar />
    <div class="w-full">
        <main class="mx-auto flex">
            <x-sidebar active="Tools" activeSub="Backup & Restore"  />
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
                                'title' => 'Backup & Restore',
                            ],
                        ];
                    @endphp
                    <x-breadcrumb :$breadcrumbs />

                    <div class="flex space-x-3 min-h-screen">
                        <div class="pb-6 mt-2 w-full">
                            <x-card class="">
                                <x-card-header>Backup & Restore</x-card-header>
                                <div class="flex">
                                    <button type="submit"
                                        class="focus:outline-none text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2"
                                        onclick="confirmGenerate();">
                                        Generate Backup
                                    </button>
                                </div>
                                <div class="block w-full">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left rtl:text-right">
                                            <thead class="text-xsuppercase bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">#</th>
                                                    <th scope="col" class="px-6 py-3">File Name</th>
                                                    <th scope="col" class="px-6 py-3">Size</th>
                                                    <th scope="col" class="px-6 py-3">Modified</th>
                                                    <th scope="col" class="px-6 py-3 text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($files as $file)
                                                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                                                        <td class="px-6 py-4 border-b">{{ $loop->iteration }}</td>
                                                        <td class="px-6 py-4 border-b">{{ $file['name'] }}</td>
                                                        <td class="px-6 py-4 border-b">{{ $file['size'] }}</td>
                                                        <td class="px-6 py-4 border-b">{{ $file['modified'] }}</td>
                                                        <td style="min-width: 220px;" class="px-6 py-4 border-b gap-2 text-center">
                                                            <button title="Delete" type="button"
                                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2"
                                                                onclick="confirmDelete('{{ $file['name'] }}');">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                            <a  title="Download" href="/tools/backup_restore/download/{{ $file['name'] }}"
                                                                class="focus:outline-none inline-block text-white text-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2"
                                                                target="_blank">
                                                                <i class="bi bi-download"></i>
                                                            </a>
                                                            <button title="Restore" type="button"
                                                                class="focus:outline-none text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-4 py-2.5 mb-2"
                                                                onclick="confirmRestore('{{ $file['name'] }}');">
                                                                <i class="bi bi-arrow-repeat"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <h3 class="text-2xl font-bold my-4">Restore from file</h3>
                                    <form action="" id="restore_form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="file">
                                            <input class="border rounded-lg me-2" type="file" id="file" name="file" accept='.sql'>
                                            <button type="submit"
                                                class="focus:outline-none text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:ring-violet-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2">
                                                Restore
                                            </button>
                                        </label>
                                    </form>
                                </div>
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
            function generateBackup() {
                Swal.fire({
                    title: "Generating backup...",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(async () => {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    let response = await fetch('/tools/backup_restore/generate', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                    });

                    let {
                        status,
                        message
                    } = await response.json();

                    await Swal.fire({
                        title: message,
                        icon: status,
                        showConfirmButton: false,
                        timer: 2000,
                    });

                    if (status == 'success') {
                        window.location.reload();
                    }
                });
            }

            function deleteBackup(file_name) {
                Swal.fire({
                    title: "Deleting backup...",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(async () => {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let formData = new FormData();
                    formData.set('file_name', file_name);

                    console.log(formData.get('file_name'))
                    let response = await fetch('/tools/backup_restore/delete', {
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

                    await Swal.fire({
                        title: message,
                        icon: status,
                        showConfirmButton: false,
                        timer: 2000,
                    });

                    if (status == 'success') {
                        window.location.reload();
                    }
                });
            }

            function restoreDatabase(file_name) {
                Swal.fire({
                    title: "Restoring database...",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(async () => {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let formData = new FormData();
                    formData.set('file_name', file_name);

                    let response = await fetch('/tools/backup_restore/restore', {
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

                    await Swal.fire({
                        title: message,
                        icon: status,
                        showConfirmButton: false,
                        timer: 2000,
                    });

                    if (status == 'success') {
                        window.location.reload();
                    }
                });
            }

            function confirmGenerate() {
                Swal.fire({
                    title: 'Generate database backup?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Continue',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        generateBackup();
                    }
                });
            }

            function confirmDelete(file_name) {
                Swal.fire({
                    title: 'Delete this backup file?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Continue',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteBackup(file_name);
                    }
                });
            }

            function confirmRestore(file_name) {
                Swal.fire({
                    title: 'Restore database from this file?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Continue',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        restoreDatabase(file_name);
                    }
                });
            }

            document.getElementById('restore_form').addEventListener('submit', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: "Restoring Database...",
                    showConfirmButton: false,
                    timer: 2000,
                }).then(async () => {
                    let fileInput = document.getElementById('file');
                    let file = fileInput.files[0];
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let formData = new FormData();
                    formData.set('file', file);

                    let response = await fetch('/tools/backup_restore/restore_from_file', {
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

                    await Swal.fire({
                        title: message,
                        icon: status,
                        showConfirmButton: false,
                        timer: 2000,
                    });

                    if (status == 'success') {
                        window.location.reload();
                    }
                });
            })
        </script>
    </x-slot:scripts>
</x-layout>
