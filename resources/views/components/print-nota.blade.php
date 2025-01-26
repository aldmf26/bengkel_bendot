@props(['title', 'dok'])
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.template.head')
    <style>
        @media print {
            body {
                border: 1px solid black;
                border-radius: 10px;
            }
            .noprint {
                display: none;
            }
        }
    </style>
    <title>{{ $title ?? '' }}</title>
    
</head>

<body>
    {{$slot}}
    
    <script>
        window.print();
    </script>

</body>

</html>
