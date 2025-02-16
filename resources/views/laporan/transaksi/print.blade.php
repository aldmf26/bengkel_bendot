<x-print :title="$title">
    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Nota</th>
                <th>Total Harga</th>
                <th>Metode</th>
                <th>Dibayar</th>
                <th>Kembalian</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ tanggal(date('Y-m-d', strtotime($d->tanggal))) }}</td>
                    <td>{{ $d->no_nota }}</td>
                    <td align="right">{{ number_format($d->total_harga, 0) }}</td>
                    <td>{{ $d->metode_pembayaran }}</td>
                    <td align="right">{{ number_format($d->jumlah_dibayar, 0) }}</td>
                    <td align="right">{{ number_format($d->kembalian, 0) }}</td>
                    <td>{{ $d->admin }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="center"><strong>Total</strong></td>
                <td align="right"><strong>{{ number_format($transaksi->sum('total_harga'), 0) }}</strong></td>
                <td colspan="4"></td>
            </tr>
        </tfoot>
    </table>
</x-print>