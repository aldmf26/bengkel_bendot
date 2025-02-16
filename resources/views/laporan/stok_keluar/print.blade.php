<x-print :title="$title">
    <table class="table table-bordered data-table" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Nota</th>
                <th>Sparepart</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ tanggal(date('y-m-d', strtotime($d->tanggal))) }}</td>
                    <td>{{ $d->transaksi->no_nota }}</td>
                    <td>{{ $d->sparepart->nama }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>{{ $d->keterangan }}</td>
                    <td>{{ $d->admin }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" align="center"><strong>Total</strong></td>
                <td><strong>{{ $datas->sum('jumlah') }}</strong></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>
</x-print>