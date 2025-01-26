<x-print-nota>
    <div class="container mt-5 mb-5" id="printIt">
        <a href="javascript:window.history.back()" class="m-5 mt-4 noprint btn btn-sm btn-outline-primary"><i class="fa fa-arrow-left"></i>
            Kembali</a>
        <div class="row d-flex justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="logo p-2 px-5">
                            <i style="font-size: 50px" class="fa-solid fa-screwdriver-wrench"></i>
                            <h6>Bengkel Bendot</h6>
                        </div>
                        <p style="font-size: 9px" class="">input by {{ $getTransaksi->admin }}</p>
                    </div>

                    <div class="invoice p-5">

                        <h5>Nota Pembelian</h5>

                        <span class="font-weight-bold d-block mt-4">{{ ucwords($getTransaksi->customer->nama) }}</span>
                        <span>{{ $getTransaksi->customer->telepon }}</span>

                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">Tanggal</span>
                                                <span>{{ tanggal(date('Y-m-d', strtotime($getTransaksi->tanggal))) }}</span>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">No Nota</span>
                                                <span>{{ $getTransaksi->no_nota }}</span>

                                            </div>
                                        </td>

                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">Pembayaran</span>
                                                <span>{{ $getTransaksi->metode_pembayaran }}</span>

                                            </div>
                                        </td>

                                    </tr>
                                </tbody>

                            </table>

                        </div>

                        <div class="product border-bottom table-responsive">

                            <table class="table table-borderless">
                                <tbody>
                                    @foreach ($getTransaksi->detail as $item)
                                        <tr>
                                            <td width="20%">
                                                @if ($item->sparepart && $item->sparepart->foto)
                                                    <img src="{{ Storage::url($item->sparepart->foto) }}"
                                                        width="90">
                                                @elseif($item->service && $item->service->foto)
                                                    <img src="{{ Storage::url($item->service->foto) }}" width="90">
                                                @else
                                                    <span>Image not available</span>
                                                @endif
                                            </td>

                                            <td width="60%">
                                                @if ($item->sparepart && $item->sparepart->nama)
                                                    <span class="font-weight-bold">{{ $item->sparepart->nama }}</span>
                                                    <div class="product-qty">
                                                        <span class="d-block">Jumlah: {{ $item->jumlah }}</span>
                                                        <span>Harga: Rp. {{ number_format($item->harga) }}</span>
                                                    </div>
                                                @elseif($item->service && $item->service->nama)
                                                    <span class="font-weight-bold">{{ $item->service->nama }}</span>
                                                    <div class="product-qty">
                                                        <span class="d-block">Jumlah: {{ $item->jumlah }}</span>
                                                        <span>Harga: Rp. {{ number_format($item->harga) }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td width="20%">
                                                <div class="text-end">
                                                    @if ($item->sparepart && $item->sparepart->nama)
                                                        <span class="font-weight-bold">Rp.
                                                            {{ number_format($item->jumlah * $item->harga) }}</span>
                                                    @elseif($item->service && $item->service->nama)
                                                        <span class="font-weight-bold">Rp.
                                                            {{ number_format($item->jumlah * $item->harga) }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row d-flex justify-content-end">

                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-start">
                                                    <span class="font-weight-bold">Total</span>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-end">
                                                    <span class="font-bold">Rp.
                                                        {{ number_format($getTransaksi->total_harga) }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-start">
                                                    <span class="text-muted">Dibayar</span>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-end">
                                                    <span>Rp. {{ number_format($getTransaksi->jumlah_dibayar) }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-start">
                                                    <span class="text-muted">Kembalian</span>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-end">
                                                    <span>Rp. {{ number_format($getTransaksi->kembalian) }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <p>Terima Kasih Atas Pembelian Anda!</p>
                        <span>Tim Bengkel Bendot</span>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-print-nota>
