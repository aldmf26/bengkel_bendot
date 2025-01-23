<x-app-layout :title="$title">
@php
    $spareparts = \App\Models\Sparepart::all();
@endphp

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach($spareparts as $sparepart)
        <div class="col">
            <div class="card h-100">
                <img src="{{ Storage::url($sparepart->foto) }}" alt="{{ $sparepart->nama }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $sparepart->nama }}</h5>
                    <p class="card-text">{{ $sparepart->deskripsi }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

</x-app-layout>
