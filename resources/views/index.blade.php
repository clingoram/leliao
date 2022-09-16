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
  <style>
    * {
      color: #000;
      font-size: 14pt;
      text-align: left;
      text-decoration: none;
      font-family: Franklin Gothic Medium, Arial Narrow, Arial, sans-serif
    }

    a:href {
      text-decoration: none
    }

    ul,
    li {
      list-style: none
    }

    .navbar {
      background-color: #2c6a94
    }

    .dropdown {
      right: 128px;
      width: 50px
    }

    .mainarea {
      padding-top: 10px
    }

    .forums {
      list-style: none;
      width: 20%
    }

    .forumsButton {
      border-style: none;
      margin-bottom: 8px;
      background-color: transparent
    }

    .card {
      width: 100%;
      background-color: #fff;
      margin-bottom: 10px
    }

    .replyer {
      font-size: smaller
    }

    .fa-heart:hover {
      color: red
    }

    .replyButton {
      margin: 5px
    }

    hr {
      -moz-border-bottom-colors: none;
      -moz-border-image: none;
      -moz-border-left-colors: none;
      -moz-border-right-colors: none;
      -moz-border-top-colors: none;
      border-color: #EEEEEE -moz-use-text-color #FFFFFF;
      border-style: solid none;
      border-width: 1px 0;
      margin: 18px 0
    }

    .ellipsis {
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      white-space: normal
    }

    .warning {
      color: red
    }
  </style>
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