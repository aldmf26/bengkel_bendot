@props(['title', 'dok'])
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $title }}</title>
    <style>
        @media print {
            body {
                border: 1px solid black;
                border-radius: 10px;
            }
        }

        body {
            font-family: 'Poppins';
        }

        .cop_judul {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 15px;
        }

        .shapes {
            border: 1px solid black;
            border-radius: 10px;
        }

        .cop_text {
            font-size: 12px;
            text-align: left;
            font-weight: normal;
            margin-top: 100px;

        }

        .dhead {
            background-color: #C0C0C0 !important;
        }

        .bg-black {
            background-color: black !important;
        }

        .border_atas {
            border-top: 1px solid black;
        }

        .border_bawah {
            border-bottom: 1px solid black;
        }

        .border_kanan {
            border-right: 1px solid black;
            padding-right: 6px;
        }

        .border_kiri {
            border-left: 1px solid black;
            padding-left: 6px;
        }

        .head {
            background-color: #D9D9D9 !important;
        }
        thead {
            background-color: var(--bs-primary);
            color: white;
        }
        table {
            text-align: center;
        }
        td {
            vertical-align: middle;

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 mt-4">

                <img style="width: 100px" src="{{ asset('assets/img/maskot.png') }}" alt="">
            </div>
            <div class="col-6 mt-4">
                <div class="shapes">
                    <p class="cop_judul">
                        <h3 class="text-center">Bengkel Bendot</h3>
                        <h6 class="text-center">alamat Jl. Hksn Komp.Surya Gemilang No.10, Kota Banjarmasin, Kalimantan Selatan
                            70124</h6>
                        <h6 class="text-center">0896-4531-2902</h6>
                    </p>
                </div>
            </div>
            <div class="col-3">
                <p style="font-size: 12px; font-style: italic" class="text-end ">{{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}</p>
            </div>
        </div>
        <hr style="border: 1px solid black !important; color:black">
        <center>
        <h5>{{ $title }}</h5>
        {{ $slot }}
    </center>
        <br>
        <br>
        <div style="display: flex; justify-content: space-between">
            <div style="width: 50%">
                <p class="text-center">Yang Menerima</p>
                <br>
                <br>
                <p class="text-center">_________________________</p>
            </div>
            <div style="width: 50%">
                <p class="text-center">Yang Menyerahkan</p>
                <br>
                <br>
                <p class="text-center">_________________________</p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- <script>
        window.print();
    </script> --}}

</body>

</html>
