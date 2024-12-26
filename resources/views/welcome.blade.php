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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html,
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="font-hanken-grotesk bg-violet-700 text-white relative min-h-screen">
    <nav class="flex sticky top-0 left-0 right-0 bg-violet-800 border-b border-violet-600">
        <div class="mx-auto w-full max-w-screen-lg flex justify-between">
            <x-logo-brand class="text-white p-3" />
            <div class="flex items-center p-3">
                <a href="/login"
                    class="text-white me-2 bg-purple-700 hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                    Login
                    <i class="bi bi-box-arrow-in-right"></i>
                </a>
                <a href="/register"
                    class="text-white bg-purple-700 hover:bg-gray-100 hover:text-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                    Sign Up
                </a>
            </div>
        </div>

    </nav>

    <div class="w-full max-w-screen-lg mx-auto flex flex-col justify-center items-center space-y-12">
        <div class="text-center mx-auto space-y-5 p-3">
            <a target="_blank" title="Insurance Commission Official Website" href="https://www.insurance.gov.ph/"
                class="block sm:hidden">
                <img style="height: 160px; width: 160px;" class="mx-auto" src="{{ asset('images/ic-logo.png') }}"
                    alt="">
            </a>
            <h1 class="text-7xl">Welcome! to IVIM <span class="hidden sm:inline">System v1.0.0</span></h1>
            <p>
                Your trusted platform for verifying the authenticity of CTPL insurance, ensuring peace of mind and
                protection for vehicle owners.
                <span class="hidden sm:inline">
                    IVIM offers a seamless, secure, and efficient way to validate insurance policies, combat fraud, and
                    promote transparency in the motor insurance industry.
                </span>
            </p>
        </div>
        <div class="space-x-2 justify-center hidden sm:flex">
            <a target="_blank" title="LTO Official Website" href="https://lto.gov.ph" class="block">
                <img style="height: 150px;" src="{{ asset('images/lto-logo.png') }}" alt="">
            </a>
            <a target="_blank" title="Insurance Commission Official Website" href="https://www.insurance.gov.ph/"
                class="block">
                <img style="height: 150px;" class="w-full" src="{{ asset('images/ic-logo.png') }}" alt="">
            </a>
            <a target="_blank" title="HPG Official Website" href="https://hpg.pnp.gov.ph/" class="block">
                <img style="height: 150px;" class="w-full" src="{{ asset('images/hpg-logo.png') }}" alt="">
            </a>
            <a target="_blank" title="Bureau of Customs Official Website" href="https://www.customs.gov.ph/"
                class="block">
                <img style="height: 150px;" class="w-full" src="{{ asset('images/boc-logo.png') }}" alt="">
            </a>
            <a target="_blank" title="LTFRB Official Website" href="https://www.ltfrb.gov.ph/" class="block">
                <img style="height: 150px;" class="w-full" src="{{ asset('images/ltfrb-logo.png') }}" alt="">
            </a>
        </div>
        <div class="w-full text-center">
            <a href="/qr_verifier"
                class="mb-5 px-6 py-3.5 text-base text-black font-bold inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-violet-300 rounded-lg text-center">
                <i class="bi bi-qr-code-scan me-2 text-2xl"></i>
                QR Verifier Tool
            </a>
        </div>
    </div>

    <footer class="bg-violet-800 border-t border-violet-600 text-white py-5 relative bottom-0 left-0 right-0">
        <p class="text-center font-thin">Copyright &copy; 2024 IVIM System | v1.0.0</p>
    </footer>
</body>
</html>
