<x-print :title="$title">
    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Alamat</th>
                <th>Sparepart</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suplier as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->kontak }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td>
                        @foreach ($d->sparepart as $sp)
                            {{ $sp->nama }}, <br>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-print>
