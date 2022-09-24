<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
  <div id="app"></div>
  <router-view />
</body>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script>
  // $(function() {
  //   let ip_address = '127.0.0.1';
  //   let socket_port = '3000';
  //   let socket = io(ip_address + ':' + socket_port);
  //   socket.on('connection');
  // });
</script>

</html>