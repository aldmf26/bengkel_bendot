<x-print :title="$title">
    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th class="text-start">Sparepart</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>
                        @foreach ($d->sparepart as $sp)
                            <li class="text-start">{{ $sp->nama }} ({{ $sp->stok }})</li>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-print>