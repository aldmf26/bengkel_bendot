<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            <a href="#" data-bs-toggle="modal" data-bs-target="#add" class="float-end btn btn-primary btn-sm"><i
                    class="fas fa-plus"></i> Data</a>
        </div>
        <div class="col-12">
            <table class="table table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $d->id }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('kategori.destroy', $d->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('kategori.store') }}" method="post">
        @csrf
        <x-modal idModal="add" title="Tambah Kategori Sparepart">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
        </x-modal>
    </form>

    @foreach ($kategori as $d)
        <form action="{{ route('kategori.update', $d->id) }}" method="post">
            @csrf
            <x-modal idModal="edit{{ $d->id }}" title="Edit Kategori Sparepart">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $d->nama }}" required>
                </div>
            </x-modal>
        </form>
    @endforeach
</x-app-layout>
