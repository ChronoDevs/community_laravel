@extends('layouts.auth')
@section('sidebar')
    @include('layouts.guest_sidebar')
@endsection
@section('right_sidebar')
    @include('layouts.right_sidebar')
@endsection
@section('content')
<script>
    window.laravel_echo_port = '{{ env('LARAVEL_ECHO_PORT') }}';
</script>
    <div id="notification" class="info"></div>
    @include('posts.index')
    <h1 class="text-primary">{{ request()->getHost() }}</h1>
    <script src="//{{ request()->getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var i = 0;
        console.log(window.Echo)
        window.Echo.channel('laravel_database_user-channel')
            .listen('.UserEvent', (data) => {
                i++;
                console.log(data)
                $("#notification").append('<div class="alert alert-success">' + i + '.' + data.title + '</div>');
            });
    </script>
@endsection
