<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Laravel Broadcast Redis Socket.IO con Cursosdesarrolloweb</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="container" id="app">
    <h1 class="text-muted">Laravel Broadcast Redis Socket.IO con Cursosdesarrolloweb</h1>
    <div id="chat-notification"></div>
</div>

<script>
    window.laravelEchoPort = '{{ env("LARAVEL_ECHO_PORT") }}';
</script>
<script src="//{{ request()->getHost() }}:{{ env('LARAVEL_ECHO_PORT') }}/socket.io/socket.io.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    const userId = '{{ auth()->id() }}';
    window.Echo.channel('public-message-channel')
        .listen('.MessageEvent', (data) => {
            $("#chat-notification").append('<div class="alert alert-warning">' + data.message + '</div>');
        });

    window.Echo.private('message-channel.' + userId)
        .listen('.MessageEvent', (data) => {
            $("#chat-notification").append('<div class="alert alert-danger">' + data.message + '</div>');
        });
</script>
</body>
</html>
