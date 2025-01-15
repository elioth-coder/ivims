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

<body class="relative min-h-screen text-white font-hanken-grotesk bg-violet-700">
    <nav class="sticky top-0 left-0 right-0 flex border-b bg-violet-800 border-violet-600">
        <div class="flex items-center justify-between w-full max-w-screen-xl mx-auto">
            <x-logo-brand class="p-3 text-white" />
            <div class="flex flex-wrap items-center justify-between p-4">
                <ul class="p-0 space-x-4 flex flex-row mt-0 border-0 text-white">
                    <li class="hidden sm:list-item">
                        <a href="#about_ivim" class="block py-2 px-3 rounded hover:bg-transparent border-0 hover:text-gray-400 p-0">About IVIM</a>
                    </li>
                    <li class="hidden sm:list-item">
                        <a href="#ctpl_rates" class="block py-2 px-3 rounded hover:bg-transparent border-0 hover:text-gray-400 p-0">CTPL Rates</a>
                    </li>
                    <li class="hidden sm:list-item">
                        <a href="#partner_agencies" class="block py-2 px-3 rounded hover:bg-transparent border-0 hover:text-gray-400 p-0">Partner Agencies</a>
                    </li>
                    <li class="hidden sm:list-item">
                        <a href="#contact_us" class="block py-2 px-3 rounded hover:bg-transparent border-0 hover:text-gray-400 p-0">Contact Us</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 rounded hover:bg-gray-100 hover:bg-transparent border-0 hover:text-gray-400 p-0 dark:text-white dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-transparent">
                            <span class="hidden">Account</span>
                            <i class="bi bi-person-circle sm:hidden block text-3xl"></i>
                            <i class="bi bi-chevron-down hidden sm:block"></i>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownLargeButton">
                                <li>
                                <a href="/login" class="block px-4 py-2 hover:bg-gray-300">Log In</a>
                                </li>
                                <li>
                                <a href="/register" class="block px-4 py-2 hover:bg-gray-300">Register</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="flex flex-col items-center px-5 sm:px-20 sm:py-10 w-full max-w-screen-xl mx-auto space-y-6 pb-[65px]">
        <div class="flex flex-col-reverse sm:flex-row items-center gap-4 pb-10">
            <div class="w-full mx-auto space-y-5">
                <h1 class="text-4xl sm:text-6xl font-bold">Welcome to IVIM <span class="hidden sm:inline">System v1.0.0</span></h1>
                <p>
                    Your trusted platform for verifying the authenticity of CTPL insurance
                </p>
                <a href="/qr_verifier"
                    class="block mx-auto sm:inline-flex bg-violet-800 my-5 px-6 py-3.5 text-base text-white hover:text-violet-700 font-bold items-center hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-violet-300 rounded-full text-center">
                    QR Verifier Tool
                    <i class="mx-2 text-xxl bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="w-full p-8">
                <img class="w-11/12" src="{{ asset('images/car-insurance-cartoon.png') }}" alt="">
            </div>
        </div>
        <hr id="about_ivim" class="my-24 border-slate-400 opacity-50 h-1 w-full">
        <div class="w-full py-5">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">About IVIM</h2>
            <p class="text-justify indent-8">The IVIM (Integrated Vehicle Insurance Management) System is an innovative web-based platform designed to streamline the management of Compulsory Third Party Liability (CTPL) insurance policies. Developed to enhance transparency, efficiency, and compliance within the insurance industry, IVIM serves as a centralized system connecting the Insurance Commission (IC), insurance companies, and policyholders.</p>
            <h3 class="text-4xl font-bold my-4">Mission</h3>
            <p class="text-justify indent-8">
                To modernize the CTPL insurance process by providing a secure, efficient, and transparent platform that benefits all stakeholders.
            </p>
            <h3 class="text-4xl font-bold my-4">Vision</h3>
            <p class="text-justify indent-8">
                To become the leading system for vehicle insurance management, setting the standard for regulatory compliance and customer trust within the industry.
                The IVIM System is designed to adapt to the evolving needs of the Insurance Commission and the insurance sector, ensuring continuous improvement and reliable service delivery.
            </p>
        </div>
        <hr id="ctpl_rates" class="my-28 border-slate-400 opacity-50 h-1 w-full">
        <div class="w-full py-5">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">CTPL Rates</h2>
        </div>
        <div class="flex w-full pb-10">
            <div class="relative overflow-x-auto w-full rounded-lg p-5">
                <table class="w-full text-sm text-left text-white">
                    <thead class="text-xs uppercase">
                        <tr class="bg-violet-900">
                            <th class="sm:px-6 sm:py-4 px-4 py-2">Type</th>
                            <th class="sm:px-6 sm:py-4 px-4 py-2 text-end">1 Year</th>
                            <th class="sm:px-6 sm:py-4 px-4 py-2 text-end">3 Years</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ctpl_rates as $ctpl_rate)
                            <tr class="group cursor-pointer even:bg-violet-800">
                                <td class="sm:px-6 sm:py-4 px-4 py-2">{{ $ctpl_rate->type }}</td>
                                <td class="sm:px-6 sm:py-4 px-4 py-2 text-end text-nowrap">P {{ number_format($ctpl_rate->one_year, 2) }}</td>
                                <td class="sm:px-6 sm:py-4 px-4 py-2 text-end text-nowrap">P {{ number_format($ctpl_rate->three_years, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr id="partner_agencies" class="my-24 border-slate-400 opacity-50 h-1 w-full">
        <div class="w-full py-5">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">Our Partner Agencies</h2>
        </div>
        <div class="flex flex-col sm:flex-row gap-8 justify-between w-full px-20 pb-8 sm:pb-20">
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
        <hr id="contact_us" class="my-24 border-slate-400 opacity-50 h-1 w-full">
        <div class="w-full pt-5">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">Contact Us</h2>
        </div>
        <div class="flex flex-col sm:flex-row w-full pb-8">
            <div class="w-full">
                <p class="mb-4 font-light indent-8 text-justify">Got a technical issue? Want to send feedback about our service? Need details about this platform? Let us know.</p>
                <form action="#" class="space-y-6">
                    <div class=>
                        <label for="email" class="block mb-2 text-sm font-medium">Your email</label>
                        <input type="email" id="email" class="text-black shadow-sm bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-violet-500 focus:border-violet-500 block w-full p-2.5" placeholder="name@gmail.com" required>
                    </div>
                    <div>
                        <label for="subject" class="block mb-2 text-sm font-medium dark:text-gray-300">Subject</label>
                        <input type="text" id="subject" class="text-black block p-3 w-full text-sm bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-violet-500 dark:focus:border-violet-500 dark:shadow-sm-light" placeholder="Let us know how we can help you" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium dark:text-gray-400">Your message</label>
                        <textarea id="message" rows="6" class="text-black block p-2.5 w-full text-sm bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-violet-500 dark:focus:border-violet-500" placeholder="Leave a comment..."></textarea>
                    </div>
                    <button type="submit" class="block w-full sm:inline-block sm:w-fit rounded-full py-3.5 px-6 text-base font-medium text-center text-white p-5 bg-violet-800 hover:bg-white hover:text-violet-700 focus:ring-4 focus:outline-none focus:ring-violet-300 dark:bg-violet-600 dark:hover:bg-violet-700 dark:focus:ring-violet-800">
                        Send message
                        <i class="ms-2 bi bi-send"></i>
                    </button>
                </form>
            </div>
            <div class="w-full px-5 hidden sm:block">
                <img src="{{ asset('/images/contact-us-cartoon.png') }}" alt="">
            </div>
        </div>
    </div>

    <footer class="absolute bottom-0 left-0 right-0 py-5 text-white border-t bg-violet-800 border-violet-600">
        <p class="font-thin text-center">Copyright &copy; 2024 IVIM System | v1.0.0</p>
    </footer>
</body>

</html>
