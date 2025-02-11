<x-app-layout :title="$title">
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('stok_masuk.store') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Stok Masuk</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="sparepart" class="form-label">Pilih Sparepart</label>
                            <select class="form-control" id="sparepart" name="id_sparepart" required>
                                <option value="">Pilih Sparepart</option>
                                @foreach ($spareparts as $sparepart)
                                    <option value="{{ $sparepart->id }}">{{ $sparepart->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sparepart" class="form-label">Pilih Suplier</label>
                            <select class="form-control" id="suplier" name="id_suplier" required>
                                <option value="">Pilih Suplier</option>
                                @foreach ($supliers as $suplier)
                                    <option value="{{ $suplier->id }}">{{ $suplier->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</x-app-layout>
