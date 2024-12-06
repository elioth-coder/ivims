@props(['items'=>[]])

<div class="block">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">id_type</th>
                    <th scope="col" class="px-6 py-3">id_number</th>
                    <th scope="col" class="px-6 py-3">business</th>
                    <th scope="col" class="px-6 py-3">first_name</th>
                    <th scope="col" class="px-6 py-3">middle_name</th>
                    <th scope="col" class="px-6 py-3">last_name</th>
                    <th scope="col" class="px-6 py-3">suffix</th>
                    <th scope="col" class="px-6 py-3">gender</th>
                    <th scope="col" class="px-6 py-3">birthday</th>
                    <th scope="col" class="px-6 py-3">address</th>
                    <th scope="col" class="px-6 py-3">email</th>
                    <th scope="col" class="px-6 py-3">contact_no</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4 text-nowrap">{{ $item->id_type }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->id_number }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->business }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->first_name }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->middle_name }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->last_name }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->suffix }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->gender }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->birthday }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->address }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->email }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->contact_no }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="block p-3">
        {{ $items->links() }}
    </div>
</div>
