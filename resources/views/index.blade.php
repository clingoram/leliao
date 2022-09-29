<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- <style>
    .chat-row {
      margin: 50px;
    }

    ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    ul li {
      padding: 8px;
      background: #928787;
      margin-bottom: 20px;
    }

    ul li:nth-child(2n-2) {
      background: #c3c5c5;
    }

    .chat-input {
      border: 1px soild lightgray;
      border-top-right-radius: 10px;
      border-top-left-radius: 10px;
      padding: 8px 10px;
      color: #fff;
    }
  </style> -->
</head>

<body>
  <div id="app"></div>
  <router-view />

  <!-- <div class="container">
    <div class="row chat-row">
      <div class="chat-content">
        <ul>
        </ul>
      </div>

      <div class="chat-section">
        <div class="chat-box">
          <div class="chat-input bg-primary" id="chatInput" contenteditable="">

          </div>
        </div>
      </div>
    </div>
  </div> -->

</body>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
  // client side
  // $(function() {
  //   let ip_address = "127.0.0.1";
  //   let socket_port = "3000";
  //   let socket = io(ip_address + ":" + socket_port);
  //   socket.on("connection");

  //   let chatInput = $("#chatInput");
  //   chatInput.keypress(function(e) {
  //     let message = $(this).html();
  //     // console.log(message);

  //     if (e.which === 13 && !e.shiftKey) {

  //       // 觸發事件，把訊息傳到server.js
  //       socket.emit("sendChatToServer", message);
  //       chatInput.html("");
  //       return false;
  //     }
  //   });

  //   socket.on("sendChatToClient", function(message) {
  //     $(".chat-content ul").append(`<li>${message}</li>`);
  //   });
  // });



  // var sock = io("{{env('PUBLISHER_URL')}}: {{env('BROADCAST_PORT')}}");
  // sock.on('action - channel - one: App\\ Events\\ ActionEvent', function(data) {
  //   //data.actionId and data.actionData hold the data that was broadcast
  //   //process the data, add needed functionality here
  //   var action = data.actionId;
  //   var actionData = data.actionData;

  //   if (action == "score_update" && actionData.team1_score) {
  //     $("#app").html(actionData.team1_score);
  //   }
  // });
</script>

</html>