<x-layout>
    <x-slot:title>Customer - Home</x-slot:title>
    <x-slot:head>

    </x-slot:head>
    <div class="relative w-full pb-[70px] overflow-y-scroll">
        <x-navbar-customer />
        <main class="w-full max-w-screen-lg mx-auto p-4 min-h-screen">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <br>
            <img class="w-32 mx-auto sm:w-[300px] block rounded-full" src="{{ asset('images/ic-logo.png')}}" alt="Insurance Commission">
            <br>

            <div class="flex flex-col gap-5">
                <div class="max-w-sm p-6 border rounded-lg">
                    <a href="/customer/insurances">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight">CTPL Insurances</h5>
                    </a>
                    <a href="/customer/insurances" class="inline-flex font-medium items-center text-blue-600 hover:underline">
                        Go to insurances
                        <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                        </svg>
                    </a>
                </div>

                <div class="max-w-sm p-6 border rounded-lg shadow">
                    <a href="/customer/tickets">
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight">Reported Tickets</h5>
                    </a>
                    <a href="/customer/tickets" class="inline-flex font-medium items-center text-blue-600 hover:underline">
                        Go to tickets
                        <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                        </svg>
                    </a>
                </div>
            </div>
        </main>

        <x-footer-customer />
    </div>
    <x-slot:scripts>
        <script></script>
    </x-slot:scripts>
</x-layout>
