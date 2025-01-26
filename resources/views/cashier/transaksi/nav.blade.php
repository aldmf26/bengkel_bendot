@php
    $currentRoute = Route::currentRouteName();
@endphp
<div class="d-flex justify-content-between">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a wire:navigate class="nav-link {{ $currentRoute == 'transaksi.index' ? 'active' : '' }}" id="penjualan-tab"
                href="{{ route('transaksi.index') }}" role="tab" aria-controls="penjualan">Penjualan</a>
        </li>
        <li class="nav-item" role="presentation">
            <a wire:navigate class="nav-link {{ $currentRoute == 'stok_keluar.index' ? 'active' : '' }}"
                id="stok-masuk-tab" href="{{ route('stok_keluar.index') }}" role="tab"
                aria-controls="stok-masuk">Stok keluar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a wire:navigate class="nav-link {{ $currentRoute == 'stok_masuk.index' ? 'active' : '' }}"
                id="stok-masuk-tab" href="{{ route('stok_masuk.index') }}" role="tab"
                aria-controls="stok-masuk">Stok masuk</a>
        </li>
    </ul>
    <div>
        <a href="{{ route($currentRoute == 'transaksi.index' || $currentRoute == 'stok_keluar.index' ? 'order.index' : 'stok_masuk.add') }}"
            class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Data</a>
    </div>
</div>
