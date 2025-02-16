<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            <a class="btn btn-sm btn-primary float-end" href="{{route('service.print')}}"><i class="fas fa-print"></i> Cetak</a>

        </div>
        <div class="col-12">
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
        </div>
    </div>
</x-app-layout>