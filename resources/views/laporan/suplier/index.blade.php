<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-sm btn-primary float-end" href="{{ route('suplier.print') }}"><i class="fas fa-print"></i>
                Cetak</a>

        </div>
        <div class="col-12">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suplier as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->kontak }}</td>
                            <td>{{ $d->alamat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
