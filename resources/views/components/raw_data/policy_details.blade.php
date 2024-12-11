@props(['items'=>[]])

<div class="block">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">coc_no</th>
                    <th scope="col" class="px-6 py-3">policy_no</th>
                    <th scope="col" class="px-6 py-3">or_no</th>
                    <th scope="col" class="px-6 py-3">date_issued</th>
                    <th scope="col" class="px-6 py-3">validity</th>
                    <th scope="col" class="px-6 py-3">premium</th>
                    <th scope="col" class="px-6 py-3">premium_code</th>
                    <th scope="col" class="px-6 py-3">inception_date</th>
                    <th scope="col" class="px-6 py-3">expiry_date</th>
                    <th scope="col" class="px-6 py-3">policy_holder_id</th>
                    <th scope="col" class="px-6 py-3">vehicle_detail_id</th>
                    <th scope="col" class="px-6 py-3">company_id</th>
                    <th scope="col" class="px-6 py-3">user_id</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4 text-nowrap">{{ $item->coc_no }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->policy_no }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->or_no }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->date_issued }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->validity }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->premium }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->premium_code }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->inception_date }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->expiry_date }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->policy_holder_id }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->vehicle_detail_id }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->company_id }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->user_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="block p-3">
        {{ $items->links() }}
    </div>
</div>
