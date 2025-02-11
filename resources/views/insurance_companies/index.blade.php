<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Insurance Companies</title>
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
                        <a href="#insurance_companies" class="block py-2 px-3 rounded hover:bg-transparent border-0 hover:text-gray-400 p-0">Companies</a>
                    </li>
                    <li class="hidden sm:list-item">
                        <a href="#partner_agencies" class="block py-2 px-3 rounded hover:bg-transparent border-0 hover:text-gray-400 p-0">Partners</a>
                    </li>
                    <li class="hidden sm:list-item">
                        <a href="#contact_us" class="block py-2 px-3 rounded hover:bg-transparent border-0 hover:text-gray-400 p-0">Contacts</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between w-full py-2 px-3 rounded hover:bg-gray-100 hover:bg-transparent border-0 hover:text-gray-400 p-0 dark:text-white dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:bg-transparent">
                            {{-- <span class="me-2 hidden sm:inline">Account</span> --}}
                            <i class="bi bi-person-circle block sm:text-xl text-3xl"></i>
                            {{-- <i class="bi bi-chevron-down hidden sm:block"></i> --}}
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
        <div class="w-full py-5">
            <h2 class="text-3xl sm:text-5xl font-bold text-white">Licensed Insurance Companies</h2>
            <hr class="mt-12 border-slate-400 opacity-50 h-1 w-full">
        </div>
        <div class="w-full px-5 py-3">
            <ul class="flex flex-wrap font-medium text-center text-gray-500 dark:text-gray-400 text-lg">
                <li class="me-2">
                    <a href="/insurance_companies" class="inline-block px-4 py-3 text-white bg-violet-500 rounded-lg active" aria-current="page">Insurance Companies</a>
                </li>
                <li class="me-2">
                    <a href="/insurance_companies/branches"  class="text-gray-300 inline-block px-4 py-3 rounded-lg hover:text-violet-900 hover:bg-gray-100">Insurance Companies - Branches</a>
                </li>
                <li class="me-2">
                    <a href="/insurance_companies/agents" class="text-gray-300 inline-block px-4 py-3 rounded-lg hover:text-violet-900 hover:bg-gray-100">Insurance Companies - Agents</a>
                </li>
            </ul>
        </div>
        <div class="flex flex-col w-full pb-10">
            <div class="relative overflow-x-auto w-full rounded-lg sm:p-5">
                <table class="w-full text-sm text-left text-white">
                    <thead class="text-xs uppercase">
                        <tr class="bg-violet-900">
                            <th class="sm:px-6 sm:py-4 px-4 py-2">Company</th>
                            <th class="sm:px-6 sm:py-4 px-4 py-2 text-end">Valid Until</th>
                            <th class="sm:px-6 sm:py-4 px-4 py-2 text-end">License</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr class="group cursor-pointer even:bg-violet-800">
                                <td class="sm:px-6 sm:py-4 px-4 py-2">{{ $company->name }}</td>
                                <td class="sm:px-6 sm:py-4 px-4 py-2 text-end text-nowrap">{{ $company->expiry_date ?? '--' }}</td>
                                <td class="sm:px-6 sm:py-4 px-4 py-2 text-end text-nowrap">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr id="contact_us" class="my-24 border-slate-400 opacity-50 h-1 w-full">
        <div class="w-full pt-5">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">Contact Us</h2>
        </div>
        <div class="flex flex-col sm:flex-row w-full pb-8">
            <div class="w-full sm:p-5">
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
            <div class="w-full p-5 hidden sm:block">
                <img src="{{ asset('/images/contact-us-cartoon.png') }}" alt="">
            </div>
        </div>
    </div>

    <footer class="absolute bottom-0 left-0 right-0 py-5 text-white border-t bg-violet-800 border-violet-600">
        <p class="font-thin text-center">Copyright &copy; 2024 IVIM System | v1.0.0</p>
    </footer>
</body>

</html>
