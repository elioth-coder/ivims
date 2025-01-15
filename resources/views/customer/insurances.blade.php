<x-layout>
    <x-slot:title>Customer - CTPL Insurance</x-slot:title>
    <x-slot:head>

    </x-slot:head>
    <div class="relative w-full pb-[70px] overflow-y-scroll">
        <x-navbar-customer />
        <main class="w-full max-w-screen-lg mx-auto p-4 min-h-screen">
            <h1 class="text-2xl font-bold">CTPL Insurance</h1>
            <br>
            <img class="w-32 mx-auto sm:w-[300px] block rounded-full" src="{{ asset('images/ic-logo.png')}}"
                alt="Insurance Commission">
            <br>

            <div class="flex flex-col">


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right">
                        <thead class="text-xs uppercase bg-gray-50">
                            <tr>
                                <th></th>
                                <th scope="col" class="p-4">
                                    CTPL Insurance
                                </th>
                                <th class="p-4">Agent</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($insurances as $insurance)
                                @php
                                $color = '';
                                $status = '';
                                if (strtotime($insurance->expiry_date) < strtotime(date('Y-m-d'))) {
                                    $color  = 'bg-red-600';
                                    $status = 'EXPIRED';
                                } else {
                                    $color  = 'bg-green-600';
                                    $status = 'VERIFIED';
                                }
                                @endphp

                            <tr class="bg-white border-b">
                                <td>
                                    <a href="/customer/create_ticket#{{ $insurance->id }}"
                                        class="px-3 py-2 text-white bg-violet-700 hover:bg-violet-800 focus:ring-4 focus:outline-none focus:ring-violet-300 font-medium rounded-lg text-sm text-center inline-flex items-center">
                                        <i class="bi bi-exclamation-diamond"></i>
                                    </a>
                                </td>
                                <td scope="row" class="p-4 whitespace-nowrap">
                                    <b class="font-bold">[ COC #<a href="/verify_qr/{{ $insurance->coc_no }}"
                                        class="text-violet-800 hover:text-violet-600 underline">
                                        {{ $insurance->coc_no }}
                                    </a> ]</b>
                                    <span class="inline-block text-white w-fit rounded-lg px-2 py-1 {{ $color }}">
                                        {{ $status }}
                                    </span>
                                    <br>
                                    <span>{{ $insurance->vehicle }}</span>
                                </td>
                                <td class="text-nowrap align-middle">{{ $insurance->company_code }} - {{ $insurance->agent_name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <x-footer-customer />
    </div>
    <x-slot:scripts>
        <script></script>
    </x-slot:scripts>
</x-layout>
