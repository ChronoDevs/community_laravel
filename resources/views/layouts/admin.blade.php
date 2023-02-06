<html>

<head>
    <title>@yield('title')</title>

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
    {{-- <script src="{{ asset('storage/js/jquery-3.6.0.min.js') }}">
    <script src="{{ asset('storage/js/jquery-ui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('storage/css/jquery-ui.css') }}"> --}}
    {{-- <script type="text/javascript">
        window.onscroll = function() {
            if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight) {
                alert("At the bottom!")
            }
        }
    </script> --}}
    @stack('scripts')
</body>

</html>
