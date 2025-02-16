<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-sm btn-primary float-end" href="{{ route('customer.print') }}"><i class="fas fa-print"></i>
                Cetak</a>

        </div>
        <div class="col-12">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->telepon }}</td>
                            <td>{{ $d->alamat }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
