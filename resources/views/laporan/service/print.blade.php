<x-print :title="$title">
    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Mekanik</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ Storage::url($d->foto) }}" class="img-thumbnail" width="100"
                        height="100" style="object-fit: cover;">
                </td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->deskripsi }}</td>
                <td>{{ number_format($d->harga, 0) }}</td>
                <td>{{ $d->mekanik->nama }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-print>