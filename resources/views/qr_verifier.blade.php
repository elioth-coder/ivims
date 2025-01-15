<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="{{ @asset('js/instascan.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html,
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="font-hanken-grotesk relative min-h-screen">
    <nav class="flex justify-between sticky top-0 left-0 right-0 bg-violet-800 border-b border-violet-600">
        <x-logo-brand class="text-white p-3" />
        <div class="hidden sm:flex items-center p-3">
            <a href="/login"
                class="text-white bg-purple-700 hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                Login &rarr;
            </a>
        </div>
    </nav>
    <div class="w-screen flex flex-col items-center">
        <h2 class="text-center my-8 text-2xl font-bold">QR Verifier Tool</h2>
        <section id="qr-scanner" style="width: 300px; height: 300px; overflow: hidden;" class="bg-black border flex justify-center mx-auto m-2">
            <video id="preview" style="width: 100%;"></video>
        </section>
    </div>
    <div class="p-5 text-center">
        <a href="/"
            class="border px-6 py-3.5 text-base text-black font-bold inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-violet-300 rounded-lg text-center">
            Go back
        </a>
    </div>
    <footer class="bg-violet-800 border-t border-violet-600 text-white py-5 absolute sm:relative bottom-0 left-0 right-0">
        <p class="text-center font-thin">Copyright &copy; 2024 IVIM System | v1.0.0</p>
    </footer>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        scanner.addListener('scan', function(content) {
            window.location.href = `/verify_qr/${content}`;
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });
    </script>
</body>

</html>
