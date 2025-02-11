<x-app-layout :title="$title">
    <div class="row">
        <div class="col-12">
            @include('cashier.transaksi.nav')
        </div>
        <div class="col-12">
            <table class="table table-bordered data-table" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Sparepart</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ tanggal(date('y-m-d', strtotime($d->tanggal))) }}</td>
                            <td>{{ $d->sparepart->nama }}</td>
                            <td>{{ $d->jumlah }}</td>
                            <td>
                                @role('presiden')
                                    <a href="{{ route('stok_masuk.void_masuk', $d->id) }}"
                                        class="edit btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus stok keluar ini?')">Void</a>
                                @endrole
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
