<x-print :title="$title">
    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Spesialisasi</th>
                <th>Jumlah Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mekanik as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->telepon }}</td>
                    <td>{{ $d->spesialisasi }}</td>
                    <td>
                        {{ $d->transactionDetails->count() }} : 
                        @foreach ($d->transactionDetails as $td)
                            {{ $td->service->nama }},
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-print>
