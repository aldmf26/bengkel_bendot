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
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Mekanik</th>
                        <th>Aksi</th>
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
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $d->id }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('service.destroy', $d->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-modal idModal="add" title="Tambah Suplier">
            <div class="mb-3">
                <label for="foto" class="form-label">Upload Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
                <label for="mekanik" class="form-label">Pilih Mekanik</label>
                <select class="form-control" id="mekanik" name="id_mekanik" required>
                    <option value="">Pilih Mekanik</option>
                    @foreach ($mekaniks as $mekanik)
                        <option value="{{ $mekanik->id }}">{{ $mekanik->nama }}</option>
                    @endforeach
                </select>
            </div>
        </x-modal>
    </form>

    @foreach ($service as $d)
        <form action="{{ route('service.update', $d->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-modal idModal="edit{{ $d->id }}" title="Edit Suplier">
                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    <img src="{{ Storage::url($d->foto) }}" width="100" height="100" class="mt-2">
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="{{ $d->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $d->deskripsi }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga"
                        value="{{ $d->harga }}" required>
                </div>
                <div class="mb-3">
                    <label for="mekanik" class="form-label">Pilih Mekanik</label>
                    <select class="form-control" id="mekanik" name="id_mekanik" required>
                        <option value="">Pilih Mekanik</option>
                        @foreach ($mekaniks as $mekanik)
                            <option value="{{ $mekanik->id }}" {{ $d->id_mekanik == $mekanik->id ? 'selected' : '' }}>
                                {{ $mekanik->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </x-modal>
        </form>
    @endforeach
</x-app-layout>
