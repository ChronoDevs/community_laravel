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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.min.css
        " rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
</head>
</head>

<body>
    @section('navbar')
        @include('layouts.navbar')
    @show
    @section('sidebar')
        @include('layouts.user_sidebar')
    @show
      <!--Main layout-->
  <main style="margin-top: 58px;">
    <div class="container pt-4">
        @include('flash_message')
        @yield('content')
    </div>
  </main>
  <!--Main layout-->

    {{-- <script type="text/javascript">
        window.onscroll = function() {
            if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight) {
                alert("At the bottom!")
            }
        }
    </script> --}}

    <!--
        Elastic Search
        https://madewithlove.com/blog/software-engineering/how-to-integrate-elasticsearch-in-your-laravel-app-2022/
    -->
    <script src="{{ asset('storage/js/jquery-3.6.3.min.js') }}"></script>
    {{-- <script src="{{ asset('storage/js/jquery-ui.js') }}"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js
    "></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#tokenId').attr('content')
            }
        });
    </script>
    <script type="text/javascript" src="{{ asset('storage/js/app.js') }}"></script>
    <script>
        //prevent form to submit on page reload
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    @stack('scripts')
</body>

</html>
