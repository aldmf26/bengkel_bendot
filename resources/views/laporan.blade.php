<x-app-layout :title="$title">
    <section class="row">
        @php

            $menuLaporan = DB::table('menus')->where('parent_id', 14)->orderBy('order')->get();
        @endphp
        <div class="col-12">
            <div class="row">
                @foreach ($menuLaporan as $index => $d)
                <div class="col-6 col-lg-3 col-md-6">
                    <a wire:navigate href="{{ route($d->link) }}" class="card shadow-sm p-3">
                        <div class="d-flex align-items-center">
                            <span class="badge rounded-pill bg-info fs-5 me-2">{{ $index + 1 }}</span>
                            <div class="stats-icon purple me-3">
                                <i class="fas fa-print"></i>
                            </div>
                            <div>
                                <h6 class="text-muted font-semibold mb-0">{{$d->title}}</h6>
                            </div>
                        </div>
                    </a>
                </div>

                @endforeach
            </div>
        </div>

    </section>

</x-app-layout>
