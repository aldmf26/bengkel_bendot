<x-print :title="$title">
    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Suplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sparepart as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ Storage::url($d->foto) }}" class="img-thumbnail" width="100"
                            height="100" style="object-fit: cover;">
                    </td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->deskripsi }}</td>
                    <td>{{ number_format($d->harga, 0) }}</td>
                    <td>{{ number_format($d->stok, 0) }}</td>
                    <td>{{ $d->kategori->nama }}</td>
                    <td>{{ $d->suplier->nama }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</x-print>