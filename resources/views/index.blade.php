<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- <link href="/css/app.css" rel="stylesheet"> -->

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
  <div id="app">
    <!-- <p>Hello</p> -->
  </div>
  <router-view />
</body>

</html>