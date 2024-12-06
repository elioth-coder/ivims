@props(['items'=>[]])

<div class="block">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">code</th>
                    <th scope="col" class="px-6 py-3">name</th>
                    <th scope="col" class="px-6 py-3">origin</th>
                    <th scope="col" class="px-6 py-3">email</th>
                    <th scope="col" class="px-6 py-3">phone</th>
                    <th scope="col" class="px-6 py-3">address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4 text-nowrap">{{ $item->code }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->origin }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->email }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->phone }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="block p-3">
        {{ $items->links() }}
    </div>
</div>
