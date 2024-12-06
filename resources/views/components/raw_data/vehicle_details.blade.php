@props(['items'=>[]])

<div class="block">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">mv_file_no</th>
                    <th scope="col" class="px-6 py-3">plate_no</th>
                    <th scope="col" class="px-6 py-3">serial_no</th>
                    <th scope="col" class="px-6 py-3">motor_no</th>
                    <th scope="col" class="px-6 py-3">make</th>
                    <th scope="col" class="px-6 py-3">model</th>
                    <th scope="col" class="px-6 py-3">color</th>
                    <th scope="col" class="px-6 py-3">body_type</th>
                    <th scope="col" class="px-6 py-3">authorized_cap</th>
                    <th scope="col" class="px-6 py-3">unladen_weight</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4 text-nowrap">{{ $item->mv_file_no }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->plate_no }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->serial_no }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->motor_no }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->make }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->model }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->color }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->body_type }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->authorized_cap }}</td>
                        <td class="px-6 py-4 text-nowrap">{{ $item->unladen_weight }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="block p-3">
        {{ $items->links() }}
    </div>
</div>
