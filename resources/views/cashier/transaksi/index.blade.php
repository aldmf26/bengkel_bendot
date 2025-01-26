<x-app-layout title="Transaksi">
    <div class="row">
        <div class="col-lg-12">
            @include('cashier.transaksi.nav')
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No Nota</th>
                        <th>Total Harga</th>
                        <th>Metode</th>
                        <th>Dibayar</th>
                        <th>Kembalian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    @section('scripts')
        <script>
            $(function () {
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('transaksi.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'no_nota', name: 'no_nota'},
                {data: 'total_harga', name: 'total_harga'},
                {data: 'metode_pembayaran', name: 'metode_pembayaran'},
                {data: 'jumlah_dibayar', name: 'jumlah_dibayar'},
                {data: 'kembalian', name: 'kembalian'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
            
      });
        </script>
    @endsection
</x-app-layout>
