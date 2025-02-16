<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-sm btn-primary float-end" href="{{route('kategori-sparepart.print')}}"><i class="fas fa-print"></i> Cetak</a>

        </div>
        <div class="col-12">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>