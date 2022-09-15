<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- <link href="css/app.css" rel="stylesheet"> -->
  <!-- <link href="../font-awesome/css/all.min.css" rel="stylesheet">
  <link href="../font-awesome/css/regular.css" rel="stylesheet"> -->

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
  <div id="app">
  </div>
  <router-view />
</body>
<!-- <script src="js/app.js"></script> -->
<!-- <script src="../font-awesome/js/all.min.js"></script>
<script src="../font-awesome/js/regular.min.js"></script>
<script src="../font-awesome/webfonts/regular/fa-brands-400.woff2"></script> -->


</html>