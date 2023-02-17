<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf_token" id="tokenId" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Chronoknowledge') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('storage/css/app.css') }}">
    <script src="{{ asset('storage/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('storage/js/jquery-ui.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('storage/css/trumbowyg.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
</head>

<body>
    @section('navbar')
        @include('layouts.navbar')
    @show
    @section('sidebar')
        @include('layouts.admin_sidebar')
    @show
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            @include('flash_message')
            @yield('content')
        </div>
    </main>
    <script src="{{ asset('storage/js/jquery-3.6.3.min.js') }}">
    <script src="{{ asset('storage/js/jquery-ui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('storage/css/jquery-ui.css') }}">

    <!-- https://alex-d.github.io/Trumbowyg/documentation/ -->
    <script src="{{ asset('storage/js/trumbowyg.min.js') }}"></script>
    <!-- https://www.chartjs.org/docs/ -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <!-- https://datatables.net/ -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(function() {
            $.trumbowyg.svgPath = '{{ asset("storage/assets/icons.svg") }}';
            $('.description').trumbowyg();
        })
    </script>
    {{-- <script type="text/javascript">
        window.onscroll = function() {
            if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight) {
                alert("At the bottom!")
            }
        }
    </script> --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#tokenId').attr('content')
            }
        });
    </script>
    <script src="{{ asset('storage/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
