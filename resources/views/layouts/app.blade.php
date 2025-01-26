@props(['title'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Bengkel Bendot</title>

    @include('layouts.template.head')
    @livewireStyles
</head>

<body>
    {{-- <script src="{{asset('assets')}}/static/js/initTheme.js"></script> --}}
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('layouts.template.header')

            <div class="content-wrapper container">

                <div class="page-heading" style="margin-top: -30px">

                    @if (count(request()->segments()) != 1)
                        <nav aria-label="breadcrumb " style="margin-top: -25px; font-size: 15px;">
                            <ol class="breadcrumb">
                                @foreach (request()->segments() as $i => $d)
                                    @php
                                        $urlSegments = array_slice(request()->segments(), 0, $i + 1);
                                        $url = implode('/', $urlSegments);
                                    @endphp
                                    <li class="breadcrumb-item"><a
                                            href="/{{ $url }}">{{ ucwords(str_replace('_', ' ', $d)) }}</a>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    @endif

                    <h5>{{ ucwords(strtolower($title)) }}</h5>
                </div>
                <div class="page-content" style="margin-top: -30px">
                    <x-alert />
                    {{ $slot }}
                </div>
            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2025 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                    href="https://ptagrikagatyaarum.com/">Agrika Gatya Arum</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @include('layouts.template.scripts')
    @include('layouts.template.signatureJS')
</body>

</html>
