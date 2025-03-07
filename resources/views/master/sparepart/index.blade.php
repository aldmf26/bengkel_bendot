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
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Suplier</th>
                        <th>Aksi</th>
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
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit{{ $d->id }}"
                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                <a href="{{ route('sparepart.destroy', $d->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('sparepart.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-modal idModal="add" title="Tambah Sparepart">
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
                <label for="kategori" class="form-label">Pilih Kategori</label>
                <select class="form-control" id="kategori" name="id_kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="suplier" class="form-label">Pilih Suplier</label>
                <select class="form-control" id="suplier" name="id_supplier" required>
                    <option value="">Pilih Suplier</option>
                    @foreach ($supliers as $suplier)
                        <option value="{{ $suplier->id }}">{{ $suplier->nama }}</option>
                    @endforeach
                </select>
            </div>
        </x-modal>
    </form>

    @foreach ($sparepart as $d)
        <form action="{{ route('sparepart.update', $d->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <x-modal idModal="edit{{ $d->id }}" title="Edit Suplier">
                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" class="form-control" id="foto" name="foto" >
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $d->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $d->deskripsi }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $d->harga }}" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Pilih Kategori</label>
                    <select class="form-control" id="kategori" name="id_kategori" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ $kategori->id == $d->id_kategori ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="suplier" class="form-label">Pilih Suplier</label>
                    <select class="form-control" id="suplier" name="id_supplier" required>
                        <option value="">Pilih Suplier</option>
                        @foreach ($supliers as $suplier)
                            <option value="{{ $suplier->id }}" {{ $suplier->id == $d->id_supplier ? 'selected' : '' }}>{{ $suplier->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </x-modal>
        </form>
    @endforeach
</x-app-layout>
