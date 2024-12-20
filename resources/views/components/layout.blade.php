<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '--' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $head ?? '' }}
    <style>
        html,
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="font-hanken-grotesk">
    {{ $slot }}
</body>
{{ $scripts ?? '' }}
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Do you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No!',
        }).then(async (result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Logging out...",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    timer: 2000,
                });
                let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                let response = await fetch('/logout', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                });
                let {
                    status
                } = await response.json();

                if (status == 'success') {
                    window.location.reload();
                } else {
                    Swal.fire({
                        title: 'Failed to logout try again!',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                }
            }
        });
    }
</script>

</html>
