<x-print :title="$title">
    <table class="table table-bordered data-table" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Sparepart</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Rp</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->sparepart->nama ?? '' }}</td>
                    <td align="right">{{ number_format($d->harga, 0) }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td align="right">{{ number_format($d->harga * $d->jumlah, 0) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" align="center"><strong>Total</strong></td>
                <td ><strong>{{ number_format($datas->sum('jumlah'), 0) }}</strong></td>
                <td align="right"><strong>{{ number_format($datas->sum(fn($d) => $d->harga * $d->jumlah), 0) }}</strong></td>
            </tr>
        </tfoot>
        
    </table>
</x-print>