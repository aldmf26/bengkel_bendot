<x-print :title="$title">
    <table class="table table-bordered data-table" id="example">
<thead>
    <tr>
        <th>No</th>
        <th>Nama Customer</th>
        <th>Total Sparepart</th>
        <th>Total Service</th>
        <th>Total Rp</th>
    </tr>
</thead>
<tbody>
    @foreach ($datas as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama_pelanggan }}</td>
            <td align="right">{{ number_format($d->total_sparepart,0) }}</td>
            <td align="right">{{ number_format($d->total_service,0) }}</td>
            <td align="right">{{ number_format($d->total_harga,0) }}</td>
        </tr>
    @endforeach
</tbody>


        
    </table>
</x-print>