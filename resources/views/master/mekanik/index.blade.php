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
                        <th>Telepon</th>
                        <th>Spesialisasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mekanik as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->telepon }}</td>
                            <td>{{ $d->spesialisasi }}</td>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $d->id }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('mekanik.destroy', $d->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('mekanik.store') }}" method="post">
        @csrf
        <x-modal idModal="add" title="Tambah Suplier">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="mb-3">
                <label for="spesialisasi" class="form-label">Spesialisasi</label>
                <textarea class="form-control" id="spesialisasi" name="spesialisasi" required></textarea>
            </div>
        </x-modal>
    </form>

    @foreach ($mekanik as $d)
        <form action="{{ route('mekanik.update', $d->id) }}" method="post">
            @csrf
            <x-modal idModal="edit{{ $d->id }}" title="Edit Suplier">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $d->nama }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon"
                        value="{{ $d->telepon }}" required>
                </div>
                <div class="mb-3">
                    <label for="spesialisasi" class="form-label">Spesialisasi</label>
                    <textarea class="form-control" id="spesialisasi" name="spesialisasi" required>{{ $d->spesialisasi }}</textarea>
                </div>
            </x-modal>
        </form>
    @endforeach
</x-app-layout>
