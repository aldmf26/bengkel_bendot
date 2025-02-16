<x-app-layout :title="$title">
    <form action="{{ route('transaksi.printStokKeluar') }}" method="get" target="_blank">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="">Dari</label>
                    <input type="date" value="{{ date('Y-m-d', strtotime('first day of this month')) }}" name="tgl1" class="form-control">
                </div>

            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">Dari</label>
                    <input type="date" value="{{ date('Y-m-t') }}" name="tgl2" class="form-control">
                </div>
            </div>
            <div class="col-4">
                <label for="">Aksi</label><br>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-print"></i> Cetak</button>
            </div>
        </div>
    </form>
</x-app-layout>
