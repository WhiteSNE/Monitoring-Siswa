<div class="overflow-x-auto bg-white rounded-md shadow">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100 text-left text-sm font-bold text-gray-700">
            <tr>
                @foreach ($headers as $header)
                    <th class="px-4 py-3">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
            @foreach ($rows as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td class="px-4 py-2 bg-white text-md">{!! $cell !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
