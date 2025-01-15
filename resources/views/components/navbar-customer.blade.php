<nav class="bg-violet-700 text-white">
    <div class="max-w-screen-lg flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/logo.png') }}" class="h-8" alt="App Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap">IVIM System</span>
        </a>
        <button data-collapse-toggle="navbar-dropdown" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-300 rounded-lg md:hidden hover:text-violet-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
            <h1>{{ request()->path() }}</h1>
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="/customer"
                        class="{{ (request()->path()=='customer') ? 'text-white bg-violet-700' : 'text-gray-900' }} block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-violet-700 md:p-0">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/customer/insurances"
                        class="{{ (str_starts_with(request()->path(), 'customer/insurances')) ? 'text-white bg-violet-700' : 'text-gray-900' }} block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-violet-700 md:p-0">
                        CTPL Insurances
                    </a>
                </li>
                <li>
                    <a href="/customer/tickets"
                        class="{{ (str_starts_with(request()->path(), 'customer/ticket')) ? 'text-white bg-violet-700' : 'text-gray-900' }} block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-violet-700 md:p-0">
                        Reported Tickets
                    </a>
                </li>
                <li>
                    <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                        class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-violet-700 md:p-0 md:w-auto">
                        Account
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdownNavbar"
                        class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700"
                            aria-labelledby="dropdownLargeButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100">
                                    Edit profile
                                </a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <button onclick="confirmLogout()"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Log out
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
